<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVisionRange extends Model
{
    use HasFactory;

    protected $table = 'product_vision_range';
    public $timestamps = false;

    protected $fillable = [
        'product_title',
        'product_description',
        'product_images',
        'product_titles',
        'product_descriptions',
        'vision_title',
        'vision_description',
        'vision_image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    protected $casts = [
        'product_images' => 'array',
        'product_titles' => 'array',
        'product_descriptions' => 'array',
    ];
}
