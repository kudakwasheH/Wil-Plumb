<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'before_image',
        'after_image',
        'completion_date',
        'location',
        'category',
        'is_featured'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
