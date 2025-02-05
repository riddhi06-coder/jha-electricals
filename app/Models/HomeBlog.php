<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBlog extends Model
{
    use HasFactory;

    protected $table = 'home_blog';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'blog_title',
        'blog_author',
        'blog_date',
        'image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
