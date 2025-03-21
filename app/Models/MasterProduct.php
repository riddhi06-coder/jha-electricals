<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    use HasFactory;

    protected $table = 'master_products';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'product_name',
        'image',
        'slug',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    
     // Define the relationship with Category
     public function category()
     {
         return $this->belongsTo(Category::class, 'category_id');
     }
 

     // Define the relationship with SubCategory
     public function subcategory()
     {
         return $this->belongsTo(SubCategory::class, 'sub_category_id');
     }
}
