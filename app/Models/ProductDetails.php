<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $table = 'master_product_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'product_id',
        'section_heading',
        'product_images',
        'product_header',
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
         return $this->belongsTo(MasterProduct::class, 'product_id');
     }
}
