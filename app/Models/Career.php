<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'career';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'title',
        'role',
        'job_title',
        'company_overview',
        'location',
        'job_description',
        'responsibilities',
        'job_requirements',
        'job_benefits',
        'job_disclaimer',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
