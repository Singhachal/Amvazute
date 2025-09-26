<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogReviews;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function blog()
    {
        $blogs = Blog::orderBy('id','desc')->paginate(6);
        $categories = BlogCategory::where('status', true)->latest()->take(10)->get();
        return view('front.blog.blog',compact('blogs', 'categories'));
    }
    public function blogDetails($slug)
    {
        $recentBlogs = Blog::where('blog_status', true)->latest()->take(4)->get(['cover_image_url', 'title', 'slug', 'created_at']);

        $currentBlog = Blog::with([
            'blogCategories',
            'reviews' => function ($query) {
                $query->where('blog_review_status', true);
            }
        ])->where('slug', $slug)->first();

        $relatedBlogs = collect();
        if (!empty($currentBlog->related_blogs)) {
            $relatedBlogIds = json_decode($currentBlog->related_blogs);

            if (is_array($relatedBlogIds) && count($relatedBlogIds) > 0) {
                $relatedBlogs = Blog::whereIn('id', $relatedBlogIds)->get();
            }
        }
        return view('front.blog.blog-detail',compact('currentBlog', 'recentBlogs', 'relatedBlogs'));
    }

    public function storeBlogReview(Request $request)
    {
        $validatedData = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'name' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|email',
        ]);

        $validatedData['blog_review_status'] = '0';

        try {
            $blogReview = BlogReviews::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Blog review submitted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the blog review. Please try again.'
            ], 500);
        }
    }

    public function searchBlog(Request $request)
    {
        $searchTerm = $request->input('query');
        $blogs = Blog::where('title', 'LIKE', '%' . $searchTerm . '%')->get(['title', 'slug']); // Fetch title and slug

        return response()->json($blogs);
    }

    public function blogByCategory($category_slug)
    {
        // Fetch the specific category by its slug
        $category = BlogCategory::where('category_slug', $category_slug)->where('status', true)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        // Fetch all active categories (for sidebar or other purposes)
        $allCategories = BlogCategory::where('status', true)->latest()->take(10)->get();

        // Fetch recent blogs
        $recentBlogs = Blog::where('blog_status', true)->latest()->take(4)->get();

        // Fetch blogs associated with the specific category
        $blogs = Blog::whereHas('blogCategories', function ($q) use ($category) {
            $q->where('blog_category_id', $category->id);
        })->where('blog_status', true)->paginate(6);

        // Pass the data to the view
        return view('front.blog.blog-by-category', compact('blogs', 'category', 'allCategories', 'recentBlogs'));
    }
}
