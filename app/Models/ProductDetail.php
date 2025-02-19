<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_id',
        'section_heading',
        'product_images',
        'product_codes',
        'product_wattages',
        'product_sizes',
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
         return $this->belongsTo(Product::class, 'product_id');
     }

     

}
