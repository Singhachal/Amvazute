<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = [
        'category',
        'category_slug',
        'status'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_blog_category');
    }
}
