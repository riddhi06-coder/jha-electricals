<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreWiringPartB extends Model
{
    use HasFactory;

    protected $table = 'pre_wiring_partB';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'detailed_description',
        'section_heading',
        'calculation_images',
        'calculation_titles',
        'calculation_descriptions',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
