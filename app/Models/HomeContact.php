<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContact extends Model
{
    use HasFactory;

    protected $table = 'home_contact';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'heading',
        'image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
