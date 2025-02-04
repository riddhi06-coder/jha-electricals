<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeQuality extends Model
{
    use HasFactory;

    protected $table = 'home_quality';
    public $timestamps = false;

    protected $fillable = [
        'quality_icon',
        'quality',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];


}

