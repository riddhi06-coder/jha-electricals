<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeRange extends Model
{
    use HasFactory;

    protected $table = 'home_range';
    public $timestamps = false;

    protected $fillable = [
        'section_heading',
        'product_name',
        'product_price',
        'image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
