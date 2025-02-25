<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    use HasFactory;

    protected $table = 'accessories';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'image',
        'product_name',
        'slug',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function category()
    {
        return $this->belongsTo(AccessoriesCategory::class, 'category_id')->whereNull('deleted_at');
    }

}
