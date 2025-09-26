<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogsManagementController extends Controller
{
    // public function blogsIndex(Request $request)
    // {
    //     if (\Auth::user()->is_superadmin == "superadmin") {

    //         $query = Blog::query();
    //         $blog_category_id = $request->input('blog_category_id');
    //         $title = $request->input('title');
    //         $blog_status = $request->input('blog_status');

    //         if ($request->filled('blog_category_id')) {
    //             $query->whereHas('blogCategories', function ($q) use ($blog_category_id) {
    //                 $q->where('blog_category_id', $blog_category_id);
    //             });
    //         }

    //         if ($request->filled('title')) {
    //             $query->where('title', 'like', '%' . $title . '%');
    //         }

    //         if ($request->filled('blog_status')) {
    //             $query->where('blog_status', $blog_status);
    //         }

    //         $blogs = $query->with('blogCategories')->paginate(10)->appends($request->all());
    //         $allCategory = BlogCategory::all();

    //         return view('admin.blogs-management.list', compact(
    //             'blogs',
    //             'blog_category_id',
    //             'title',
    //             'blog_status',
    //             'allCategory'
    //         ));
    //     } else {
    //         return redirect()->back()->with('error', 'Permission denied.');
    //     }

    //     if ($request->filled('title')) {
    //         $query->where('title', 'like', '%' . $title . '%');
    //     }

    //     if ($request->filled('blog_status')) {
    //         $query->where('blog_status', $blog_status);
    //     }

    //     $blogs = $query->with('blogCategories')->orderBy('id','desc')->paginate(10)->appends($request->all());
    //     $allCategory = BlogCategory::all();

    //     return view('admin.blogs-management.list', compact(
    //         'blogs',
    //         'blog_category_id',
    //         'title',
    //         'blog_status',
    //         'allCategory'
    //     ));
    // }

    public function blogsIndex(Request $request)
{
    $query = Blog::query();
    $blog_category_id = $request->input('blog_category_id');
    $title = $request->input('title');
    $blog_status = $request->input('blog_status');

    if ($request->filled('blog_category_id')) {
        $query->whereHas('blogCategories', function ($q) use ($blog_category_id) {
            $q->where('blog_category_id', $blog_category_id);
        });
    }

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $title . '%');
    }

    if ($request->filled('blog_status')) {
        $query->where('blog_status', $blog_status);
    }

    $blogs = $query->with('blogCategories')
                   ->orderBy('id', 'desc')
                   ->paginate(10)
                   ->appends($request->all());

    $allCategory = BlogCategory::all();

    return view('admin.blogs-management.list', compact(
        'blogs',
        'blog_category_id',
        'title',
        'blog_status',
        'allCategory'
    ));
}


    public function createBlogs()
    {
        $allBlogs = Blog::all();
        $allCategory = BlogCategory::all();
        return view('admin.blogs-management.create', compact('allCategory', 'allBlogs'));
    }

    // public function storeBlogs(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'blog_category_id' => 'required|array',
    //         'blog_category_id.*' => 'exists:blog_categories,id',
    //         'title' => 'required|string|max:255|unique:blogs,title',
    //         'tags' => 'nullable|array',
    //         'tags.*' => 'string',
    //         'related_blogs' => 'nullable',
    //         // 'related_blogs.*' => 'exists:blogs,id',
    //         'author_name' => 'required|string|max:100',
    //         'blog_status' => 'required|boolean',
    //         'description' => 'required|string',
    //         'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp',
    //         'banner_image' => 'required|image|mimes:jpeg,png,jpg,webp',
    //         'meta_title' => 'required|string',
    //         'meta_description' => 'required|string'
    //     ]);

    //     dd($validatedData);

    //     $uploadPath = 'admin/uploads/blogs/';
    //     if ($request->hasFile('cover_image')) {
    //         if (!file_exists(public_path($uploadPath))) {
    //             mkdir(public_path($uploadPath), 0777, true);
    //         }
    //         $uploadData = parent::uploadImage2($uploadPath, $request->file('cover_image'));
    //         $validatedData['cover_image'] = $uploadData['image_name'];
    //         $validatedData['cover_image_url'] = $uploadData['uploaded_path'];
    //     }

    //     if ($request->hasFile('banner_image')) {
    //         if (!file_exists(public_path($uploadPath))) {
    //             mkdir(public_path($uploadPath), 0777, true);
    //         }
    //         $uploadData = parent::uploadImage2($uploadPath, $request->file('banner_image'));
    //         $validatedData['banner_image'] = $uploadData['image_name'];
    //         $validatedData['banner_image_url'] = $uploadData['uploaded_path'];
    //     }

    //     if ($request->has('tags')) {
    //         $validatedData['tags'] = json_encode($request->tags);
    //     }
    //     if ($request->has('related_blogs')) {
    //         $validatedData['related_blogs'] = json_encode($request->related_blogs);
    //     }

    //     $validatedData['slug'] = Str::slug($validatedData['title']);
    //     $blog = Blog::create($validatedData);
    //     $blog->blogCategories()->attach($request->blog_category_id);

    //     if ($blog) {
    //         return redirect()->back()->with('success', 'Blog stored successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to store blog.');
    //     }
    // }

//     public function storeBlogs(Request $request)
// {
//     $validatedData = $request->validate([
//         'blog_category_id' => 'required|array',
//         'blog_category_id.*' => 'exists:blog_categories,id',
//         'title' => 'required|string|max:255|unique:blogs,title',
//         'tags' => 'nullable|array',
//         'tags.*' => 'string',
//         'related_blogs' => 'nullable|array',
//         'author_name' => 'required|string|max:100',
//         'blog_status' => 'required|boolean',
//         'description' => 'required|string',
//         'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp',
//         'banner_image' => 'required|image|mimes:jpeg,png,jpg,webp',
//         'meta_title' => 'required|string',
//         'meta_description' => 'required|string'
//     ]);

//     $uploadPath = 'admin/uploads/blogs/';

//     // Cover Image
//     if ($request->hasFile('cover_image')) {
//         if (!file_exists(public_path($uploadPath))) {
//             mkdir(public_path($uploadPath), 0777, true);
//         }
//         $uploadData = parent::uploadImage2($uploadPath, $request->file('cover_image'));
//         $validatedData['cover_image'] = $uploadData['image_name'];
//         $validatedData['cover_image_url'] = $uploadData['uploaded_path'];
//     }

//     // Banner Image
//     if ($request->hasFile('banner_image')) {
//         if (!file_exists(public_path($uploadPath))) {
//             mkdir(public_path($uploadPath), 0777, true);
//         }
//         $uploadData = parent::uploadImage2($uploadPath, $request->file('banner_image'));
//         $validatedData['banner_image'] = $uploadData['image_name'];
//         $validatedData['banner_image_url'] = $uploadData['uploaded_path'];
//     }

//     // JSON fields
//     $validatedData['tags'] = $request->has('tags') ? json_encode($request->tags) : null;
//     $validatedData['related_blogs'] = $request->has('related_blogs') ? json_encode($request->related_blogs) : null;

//     // Slug
//     $validatedData['slug'] = Str::slug($validatedData['title']);

//     // Remove blog_category_id because it's pivot, not in blogs table
//     $categoryIds = $validatedData['blog_category_id'];
//     unset($validatedData['blog_category_id']);

//     // Save blog
//     $blog = Blog::create($validatedData);

//     // Attach categories
//     if ($blog) {
//         $blog->blogCategories()->attach($categoryIds);
//         return redirect()->back()->with('success', 'Blog stored successfully.');
//     } else {
//         return redirect()->back()->with('error', 'Failed to store blog.');
//     }
// }

public function storeBlogs(Request $request)
{
    $validatedData = $request->validate([
        'blog_category_id' => 'required|array',
        'blog_category_id.*' => 'exists:blog_categories,id',
        'title' => 'required|string|max:255|unique:blogs,title',
        'tags' => 'nullable|array',
        'tags.*' => 'string',
        'related_blogs' => 'nullable',
        'author_name' => 'required|string|max:100',
        'blog_status' => 'required|boolean',
        'description' => 'required|string',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp',
        'banner_image' => 'required|image|mimes:jpeg,png,jpg,webp',
        'meta_title' => 'required|string',
        'meta_description' => 'required|string'
    ]);

    $uploadPath = 'admin/uploads/blogs/';

    // ✅ Cover Image Upload
    if ($request->hasFile('cover_image')) {
        $cover = $request->file('cover_image');
        $coverName = time() . '_cover.' . $cover->getClientOriginalExtension();
        $cover->move(public_path($uploadPath), $coverName);
        $validatedData['cover_image'] = $coverName;
        $validatedData['cover_image_url'] = $uploadPath . $coverName;
    }

    // ✅ Banner Image Upload
    if ($request->hasFile('banner_image')) {
        $banner = $request->file('banner_image');
        $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
        $banner->move(public_path($uploadPath), $bannerName);
        $validatedData['banner_image'] = $bannerName;
        $validatedData['banner_image_url'] = $uploadPath . $bannerName;
    }

    if ($request->has('tags')) {
        $validatedData['tags'] = json_encode($request->tags);
    }
    if ($request->has('related_blogs')) {
        $validatedData['related_blogs'] = json_encode($request->related_blogs);
    }

    $validatedData['slug'] = Str::slug($validatedData['title']);

    $blog = Blog::create($validatedData);

    // attach categories
    $blog->blogCategories()->attach($request->blog_category_id);

    if ($blog) {
        return redirect()->back()->with('success', 'Blog stored successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to store blog.');
    }
}


    // public function importBlogsFromJson()
    // {
    //     // Step 1: Load the JSON file
    //     $jsonPath = public_path('blog.json');
    //     if (!File::exists($jsonPath)) {
    //         return redirect()->back()->with('error', 'blog.json file not found.');
    //     }

    //     // Step 2: Get the JSON content
    //     $jsonContent = File::get($jsonPath);
    //     $blogs = json_decode($jsonContent, true);
    //     if (!$blogs) {
    //         return redirect()->back()->with('error', 'Invalid JSON format.');
    //     }

    //     $uploadPath = 'admin/uploads/blogs/';

    //     // Ensure the upload path exists
    //     if (!file_exists(public_path($uploadPath))) {
    //         mkdir(public_path($uploadPath), 0777, true);
    //     }

    //     // Step 3: Loop through each blog and store it in the Blog table
    //     foreach ($blogs as $blogData) {
    //         // Fetch and upload cover image from URL
    //         $coverImage = $this->downloadImage($blogData['cover_image'], $uploadPath);
    //         $bannerImage = $this->downloadImage($blogData['banner_image'], $uploadPath);

    //         // Prepare validated data
    //         $validatedData = [
    //             'title' => $blogData['title'],
    //             'slug' => Str::slug($blogData['title']),
    //             'description' => $blogData['description'],
    //             'tags' => isset($blogData['tags']) ? json_encode($blogData['tags']) : null,
    //             'cover_image' => $coverImage['image_name'],
    //             'cover_image_url' => $coverImage['uploaded_path'],
    //             'banner_image' => $bannerImage['image_name'],
    //             'banner_image_url' => $bannerImage['uploaded_path'],
    //             'author_name' => $blogData['author_name'],
    //             'blog_status' => $blogData['blog_status'],
    //         ];

    //         // Step 4: Insert the blog into the Blog table
    //         $blog = Blog::create($validatedData);

    //         // Step 5: Attach categories if available
    //         if (isset($blogData['blog_category_id'])) {
    //             $blog->blogCategories()->attach($blogData['blog_category_id']);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'All blogs imported successfully.');
    // }

    // /**
    //  * Download image from the provided URL.
    //  */
    // private function downloadImage($url, $uploadPath)
    // {
    //     $imageContents = Http::get($url)->body();
    //     $imageName = basename($url);
    //     $imagePath = public_path($uploadPath . $imageName);

    //     // Save image to local storage
    //     File::put($imagePath, $imageContents);

    //     return [
    //         'image_name' => $imageName,
    //         'uploaded_path' => asset($uploadPath . $imageName),
    //     ];
    // }

    public function importBlogsFromJson()
    {
        // Step 1: Load the JSON file
        $jsonPath = public_path('blog.json');
        if (!File::exists($jsonPath)) {
            return redirect()->back()->with('error', 'blog.json file not found.');
        }

        // Step 2: Get the JSON content
        $jsonContent = File::get($jsonPath);
        $blogs = json_decode($jsonContent, true);

        if (!$blogs) {
            return redirect()->back()->with('error', 'Invalid JSON format.');
        }

        foreach ($blogs as $blogData) {
            $validatedData = [
                'title' => $blogData['title']['rendered'],
                'slug' => $blogData['slug'],
                'description' => $blogData['content']['rendered'],
                'tags' => isset($blogData['tag']) ? json_encode($blogData['tag']) : null,
                'author_name' => $blogData['author_name'],
                'blog_status' => $blogData['blog_status'],
                'meta_title' => $blogData['yoast_head_json']['title'],
                'meta_description' => $blogData['yoast_head_json']['description']
            ];

            // Check if blog with the same title already exists
            $blog = Blog::firstOrCreate(
                ['title' => $validatedData['title']], // Check for existing record by title
                $validatedData // Create if not exists
            );

            // Log the creation of the blog
            // Log::info('Blog Created or Found ->', $validatedData);

            // Attach categories if available
            if (isset($blogData['blog_category_id'])) {
                $blog->blogCategories()->attach($blogData['blog_category_id']);
            }
        }

        return redirect()->back()->with('success', 'All blogs imported successfully.');
    }

    private function downloadImage($url, $uploadPath)
    {
        try {
            // Get the image contents from the URL
            $response = Http::get($url);

            // Check if the request was successful
            if ($response->failed()) {
                throw new \Exception('Image download failed with status: ' . $response->status());
            }

            $imageContents = $response->body();
            $imageName = basename($url);
            $imagePath = public_path($uploadPath . $imageName);

            // Save the image to local storage
            File::put($imagePath, $imageContents);

            return [
                'image_name' => $imageName,
                'uploaded_path' => asset($uploadPath . $imageName),
            ];
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Image download error: ' . $e->getMessage());
            return ['image_name' => null, 'uploaded_path' => null]; // Handle image download failure
        }
    }

    public function editBlogs($id)
    {
        $allBlogs = Blog::all();
        $blog = Blog::with('blogCategories')->findOrFail($id);
        $allCategories = BlogCategory::all();
        $tags = json_decode($blog->tags, true);
        return view('admin.blogs-management.edit', compact('blog', 'allCategories', 'tags', 'allBlogs'));
    }

    public function updateBlogs(Request $request, $id)
    {
        $validatedData = $request->validate([
            'blog_category_id' => 'required|array',
            'blog_category_id.*' => 'exists:blog_categories,id',
            'title' => 'required|string|max:255|unique:blogs,title,' . $id,
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'related_blogs' => 'nullable',
            // 'related_blogs.*' => 'exists:blogs,id',
            'author_name' => 'required|string|max:100',
            'blog_status' => 'required|boolean',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string'
        ]);

        $blog = Blog::findOrFail($id);
        $uploadPath = 'admin/uploads/blogs/';

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image) {
                $oldCoverImagePath = public_path($uploadPath . $blog->cover_image);
                if (file_exists($oldCoverImagePath)) {
                    unlink($oldCoverImagePath);
                }
            }

            if (!file_exists(public_path($uploadPath))) {
                mkdir(public_path($uploadPath), 0777, true);
            }
            $uploadData = parent::uploadImage2($uploadPath, $request->file('cover_image'));
            $validatedData['cover_image'] = $uploadData['image_name'];
            $validatedData['cover_image_url'] = $uploadData['uploaded_path'];
        }

        if ($request->hasFile('banner_image')) {
            if ($blog->banner_image) {
                $oldBannerImagePath = public_path($uploadPath . $blog->banner_image);
                if (file_exists($oldBannerImagePath)) {
                    unlink($oldBannerImagePath);
                }
            }

            if (!file_exists(public_path($uploadPath))) {
                mkdir(public_path($uploadPath), 0777, true);
            }
            $uploadData = parent::uploadImage2($uploadPath, $request->file('banner_image'));
            $validatedData['banner_image'] = $uploadData['image_name'];
            $validatedData['banner_image_url'] = $uploadData['uploaded_path'];
        }

        if ($request->has('tags')) {
            $validatedData['tags'] = $request->has('tags') ? json_encode($request->tags) : null;
        }
        if ($request->has('related_blogs')) {
            $validatedData['related_blogs'] = $request->has('related_blogs') ? json_encode($request->related_blogs) : null;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $blog->update($validatedData);
        $blog->blogCategories()->sync($request->blog_category_id);

        return redirect()->back()->with('success', 'Blog updated successfully.');
    }

    public function updateBlogsStatus(Request $request)
    {
        if ($request->id && isset($request->status)) {
            try {
                $date = Blog::findOrFail($request->id);
                $date->update(['blog_status' => $request->status]);

                return [
                    'status' => 'success',
                    'msg' => 'Record Updated successfully.',
                ];
            } catch (\Exception $e) {
                return [
                    'status' => 'failed',
                    'msg' => 'Error updating record: ' . $e->getMessage(),
                ];
            }
        } else {
            return [
                'status' => 'failed',
                'msg' => 'Invalid or missing data for update.',
            ];
        }
    }

    public function deleteBlogs($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $imagePath = public_path($blog->image_url);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $blog->delete();
            session()->flash('success', 'Blog deleted successfully');
        } else {
            session()->flash('error', 'Blog not found');
        }
        return redirect()->back();
    }

    // public function blogCategoryIndex(Request $request)
    // {
    //     if (\Auth::user()->is_superadmin == 1) {

    //         $query = BlogCategory::query();
    //         $category = $request->input('category');
    //         $status = $request->input('status');

    //         if ($request->filled('category')) {
    //             $query->where('category', 'like', '%' . $category . '%');
    //         }
    //         if ($request->filled('status')) {
    //             $query->where('status', 'like', '%' . $status . '%');
    //         }

    //         $blogCategories = $query->paginate(10)->appends($request->all());

    //         return view('admin.blog-categories-management.list', compact(
    //             'blogCategories',
    //             'category',
    //             'status'
    //         ));
    //     } else {
    //         return redirect()->back()->with('error', 'Permission denied.');
    //     }
    //     if ($request->filled('status')) {
    //         $query->where('status', 'like', '%' . $status . '%');
    //     }

    //     $blogCategories = $query->orderBy('id','desc')->paginate(10)->appends($request->all());

    //     return view('admin.blog-categories-management.list', compact(
    //         'blogCategories',
    //         'category',
    //         'status'
    //     ));
    // }

    public function blogCategoryIndex(Request $request)
{
    $query = BlogCategory::query();
    $category = $request->input('category');
    $status = $request->input('status');

    if ($request->filled('category')) {
        $query->where('category', 'like', '%' . $category . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $status); // use exact match for status
    }

    $blogCategories = $query->orderBy('id', 'desc')
                            ->paginate(10)
                            ->appends($request->all());

    return view('admin.blog-categories-management.list', compact(
        'blogCategories',
        'category',
        'status'
    ));
}


    public function createBlogCategory()
    {
        return view('admin.blog-categories-management.create');
    }

    public function storeBlogCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|unique:blog_categories,category',
        ], [
            'category.unique' => 'The category name already exists.',
        ]);

        $validatedData['category_slug'] = Str::slug($validatedData['category']);
        $blogCategory = BlogCategory::create($validatedData);
        if ($blogCategory) {
            return redirect()->back()->with('success', 'Blog category stored successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to store blog category.');
        }
    }

    public function editBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog-categories-management.edit', compact('blogCategory'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|unique:blog_categories,category,' . $id . ',id',
        ]);

        $blogCategory = BlogCategory::findOrFail($id);
        $validatedData['category_slug'] = Str::slug($validatedData['category']);
        $blogCategoryUpdated = $blogCategory->update($validatedData);

        if ($blogCategoryUpdated) {
            return redirect()->route('blog-categories-list')->with('success', 'Blog categories updated successfully.');
        } else {
            return redirect()->route('blog-categories-list')->with('error', 'Blog categories update failed.')->withInput();
        }
    }

    public function updateBlogCategoryStatus(Request $request)
    {
        if ($request->id && isset($request->status)) {
            try {
                $validatedData = $request->validate([
                    'status' => 'required|in:1,0', // Assuming these are your status options
                    'id' => 'required|exists:blog_categories,id',
                ]);
                $blogCategory = BlogCategory::findOrFail($validatedData['id']);
                $blogCategory->update(['status' => $validatedData['status']]);

                return [
                    'status' => 'success',
                    'msg' => 'Record Updated successfully.',
                ];
            } catch (\Exception $e) {
                return [
                    'status' => 'failed',
                    'msg' => 'Error updating record: ' . $e->getMessage(),
                ];
            }
        } else {
            return [
                'status' => 'failed',
                'msg' => 'Invalid or missing data for update.',
            ];
        }
    }

    public function deleteBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        if ($blogCategory) {
            $blogCategory->delete();
            return redirect()->back()->with('success', 'Blog category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Blog category not found.');
        }
    }

    public function showBlogComments($id)
    {
        $blogTitle = Blog::where('id', $id)->pluck('title')->first();
        $blogReviews = BlogReviews::where('blog_id', $id)->paginate(10);

        return view('admin.blogs-management.reviews', compact(
            'blogTitle',
            'blogReviews'
        ));
    }

    public function updateBlogsReviewStatus(Request $request)
    {
        if ($request->id && isset($request->blog_review_status)) {
            try {
                $date = BlogReviews::findOrFail($request->id);
                $date->update(['blog_review_status' => $request->blog_review_status]);

                return [
                    'status' => 'success',
                    'msg' => 'Record Updated successfully.',
                ];
            } catch (\Exception $e) {
                return [
                    'status' => 'failed',
                    'msg' => 'Error updating record: ' . $e->getMessage(),
                ];
            }
        } else {
            return [
                'status' => 'failed',
                'msg' => 'Invalid or missing data for update.',
            ];
        }
    }

    public function deleteBlogsReview($id)
    {
        $blogReview = BlogReviews::find($id);
        if ($blogReview) {
            $blogReview->delete();
            session()->flash('success', 'Blog Review deleted successfully');
        } else {
            session()->flash('error', 'Blog Review not found');
        }
        return redirect()->back();
    }


    // BlogController.php


}
