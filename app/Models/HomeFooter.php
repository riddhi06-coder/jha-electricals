<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFooter extends Model
{
    use HasFactory;

    protected $table = 'home_footer';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'contact_number',
        'address',
        'time',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
