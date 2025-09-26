<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'related_blogs',
        'description',
        'tags',
        'cover_image',
        'cover_image_url',
        'banner_image',
        'banner_image_url',
        'author_name',
        'blog_status',
        'meta_title',
        'meta_description'
    ];

    // Define the many-to-many relationship
    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }


    // Define the relationship with BlogReview
    public function reviews()
    {
        return $this->hasMany(BlogReviews::class);
    }
}
