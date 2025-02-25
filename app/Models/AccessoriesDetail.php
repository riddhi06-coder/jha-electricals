<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoriesDetail extends Model
{
    use HasFactory;

    protected $table = 'accessories_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_id',
        'section_heading',
        'product_images',
        'product_codes',
        'product_description',
        'product_pkg',
        'product_mrps',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    // Define Relationship with Product Model
    public function product()
    {
        return $this->belongsTo(Accessories::class, 'product_id');
    }
}
