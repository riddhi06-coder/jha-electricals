<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
    use HasFactory;

    protected $table = 'blog_types';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'slug',
        'thumbnail',
        'date',
        'location',
        'blog_heading',
        'short_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
