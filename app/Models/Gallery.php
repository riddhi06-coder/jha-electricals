<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'gallery_images',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

}
