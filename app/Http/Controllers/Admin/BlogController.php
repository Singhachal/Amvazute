<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function BlogCategoryManagement()
{
    $categories = BlogCategory::orderBy('id', 'desc')->get();
    return view('admin.blog.category', compact('categories'));
}

    public  function createBlogCategory()
    {
        return view('admin.blog.create-blog-category');
    }

public function BlogCategoryStore(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'status' => 'required|in:0,1',
    ]);

    BlogCategory::create([
        'category' => $request->category,
        'slug' => Str::slug($request->category),
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Blog Category created successfully.');

}

public function editBlog($id)
{
    $category = BlogCategory::findOrFail($id);
    return view('admin.blog.edit-blog', compact('category'));
}

public function updateBlog(Request $request, $id)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'status' => 'required|in:1,0',
    ]);

    $category = BlogCategory::findOrFail($id);

    $category->update([
        'category' => $request->category,
        'slug' => Str::slug($request->category),
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Blog Category updated successfully.');
}

public function deleteBlog($id)
{
    BlogCategory::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Blog Category deleted successfully.');
}


public function blogs()
{
    $categories = BlogCategory::where('status', 1)->get();
    $blogs = Blog::where('status', 1)->get(); // fetch all existing blogs

    return view('admin.blog.blog', compact('categories', 'blogs'));
}


public function Storeblogs(Request $request)
{
    
    $request->validate([
        'category_id'      => 'required|exists:blog_category,id',
        'title'            => 'required|string|max:255',
        'description'      => 'nullable|string',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'tag'              => 'nullable|string',
        'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'banner_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'author'           => 'nullable|string|max:100',
        'related_blog'     => 'nullable|exists:blog,id',
        'status'           => 'required|boolean',
    ]);

    $coverImageName = null;
    $bannerImageName = null;

    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageName = time().'_cover.'.$coverImage->getClientOriginalExtension();
        $coverImage->move(public_path('admin/uploads/blog'), $coverImageName);
    }

    if ($request->hasFile('banner_image')) {
        $bannerImage = $request->file('banner_image');
        $bannerImageName = time().'_banner.'.$bannerImage->getClientOriginalExtension();
        $bannerImage->move(public_path('admin/uploads/blog'), $bannerImageName);
    }

    $slug = Str::slug($request->title);
    $originalSlug = $slug;
    $counter = 1;
    while (Blog::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }

    $blog = new Blog();
    $blog->category_id       = $request->category_id;
    $blog->title             = $request->title;
    $blog->slug              = $slug;
    $blog->description       = $request->description;
    $blog->meta_title        = $request->meta_title;
    $blog->meta_description  = $request->meta_description;
    $blog->tag               = $request->tag;
    $blog->cover_image       = $coverImageName;
    $blog->banner_image      = $bannerImageName;
    $blog->author            = $request->author;
    $blog->related_blog      = $request->related_blog;
    $blog->status            = $request->status;
    $blog->save();

    return redirect()->back()->with('success', 'Blog created successfully!');
}

public function blogList()
{
    $blogs = Blog::with('category')->latest()->get();
    return view('admin.blog.blog-list', compact('blogs'));
}


public function edit($id)
{
    $blog = Blog::findOrFail($id);
    $categories = BlogCategory::all();
    $blogs = Blog::where('id', '!=', $id)->get();

    return view('admin.blog.edit', compact('blog', 'categories', 'blogs'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'category_id'      => 'required|exists:blog_category,id',
        'title'            => 'required|string|max:255',
        'description'      => 'nullable|string',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'tag'              => 'nullable|string',
        'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'banner_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'author'           => 'nullable|string|max:100',
        'related_blog'     => 'nullable|exists:blog,id',
        'status'           => 'required|boolean',
    ]);

    $blog = Blog::findOrFail($id);


    if ($blog->title !== $request->title) {
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('id', '!=', $id)->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $blog->slug = $slug;
    }


    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageName = time() . '_cover.' . $coverImage->getClientOriginalExtension();
        $coverImage->move(public_path('admin/uploads/blog'), $coverImageName);
        $blog->cover_image = $coverImageName;
    }

    if ($request->hasFile('banner_image')) {
        $bannerImage = $request->file('banner_image');
        $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
        $bannerImage->move(public_path('admin/uploads/blog'), $bannerImageName);
        $blog->banner_image = $bannerImageName;
    }


    $blog->category_id       = $request->category_id;
    $blog->title             = $request->title;
    $blog->description       = $request->description;
    $blog->meta_title        = $request->meta_title;
    $blog->meta_description  = $request->meta_description;
    $blog->tag               = $request->tag;
    $blog->author            = $request->author;
    $blog->related_blog      = $request->related_blog;
    $blog->status            = $request->status;
    $blog->save();

    return redirect()->route('admin.blog.edit', $blog->id)->with('success', 'Blog updated successfully!');
}




public function destroy($id)
{
    $blog = Blog::findOrFail($id);


    if ($blog->cover_image) {
        $coverPath = public_path('admin/uploads/blog/' . $blog->cover_image);
        if (File::exists($coverPath)) {
            File::delete($coverPath);
        }
    }


    if ($blog->banner_image) {
        $bannerPath = public_path('admin/uploads/blog/' . $blog->banner_image);
        if (File::exists($bannerPath)) {
            File::delete($bannerPath);
        }
    }


    $blog->delete();

    return redirect()->back()->with('success', 'Blog deleted successfully!');
}






}
