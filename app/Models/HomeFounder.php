<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFounder extends Model
{
    use HasFactory;

    protected $table = 'home_founder';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
