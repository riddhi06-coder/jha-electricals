<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetails extends Model
{
    use HasFactory;

    protected $table = 'blog_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'blog_title_id',
        'image',
        'description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function blogType()
    {
        return $this->belongsTo(BlogType::class, 'blog_title_id');
    }
}
