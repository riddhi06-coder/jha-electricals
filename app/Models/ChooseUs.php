<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChooseUs extends Model
{
    use HasFactory;

    protected $table = 'about_why_choose';
    public $timestamps = false;

    protected $fillable = [
        'product_title',
        'product_description',
        'product_images',
        'product_titles',
        'product_descriptions',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
