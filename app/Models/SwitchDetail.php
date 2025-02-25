<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwitchDetail extends Model
{
    use HasFactory;

    protected $table = 'switch_details';
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
        return $this->belongsTo(Switches::class, 'product_id');
    }

}
