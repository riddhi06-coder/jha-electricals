<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialLightPartC extends Model
{
    use HasFactory;

    protected $table = 'commercial_partc';
    public $timestamps = false;

    protected $fillable = [
        'section_heading',
        'short_description',
        'image',
        'title',
        'detailed_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
