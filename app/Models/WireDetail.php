<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WireDetail extends Model
{
    protected $table = 'master_wire_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'product_id',
        'product_images',
        'detailed_description',
        'background_images',
        'description',
        'approvals',
        'voltage_grade',
        'conductor',
        'conductor_specialty',
        'insulation',
        'colours',
        'marking',
        'packing',
        'brochures',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    
}
