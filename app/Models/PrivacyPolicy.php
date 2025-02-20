<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $table = 'privacy_policy';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'privacy_policy',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
