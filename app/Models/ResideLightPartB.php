<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResideLightPartB extends Model
{
    use HasFactory;

    protected $table = 'residential_partb';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'detailed_description',
        'section_heading',
        'short_description',
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
