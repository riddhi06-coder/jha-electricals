<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingGuidePartB extends Model
{
    use HasFactory;

    protected $table = 'shopping_partB';
    public $timestamps = false;

    protected $fillable = [
        'section_heading',
        'short_description',
        'image',
        'title',
        'detailed_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
