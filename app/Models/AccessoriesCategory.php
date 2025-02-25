<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoriesCategory extends Model
{
    use HasFactory;

    protected $table = 'accessories_category';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'image',
        'category_name',
        'slug',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    // public function products()
    // {
    //     return $this->hasMany(Switches::class, 'category_id')
    //                 ->whereNull('deleted_by')
    //                 ->whereNull('deleted_at');
    // }
}
