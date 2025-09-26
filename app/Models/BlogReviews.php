<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReviews extends Model
{
    use HasFactory;

    protected $table = 'blog_reviews';

    protected $fillable = [
        'blog_id',
        'name',
        'city',
        'email',
        'review',
        'rating',
        'blog_review_status'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
