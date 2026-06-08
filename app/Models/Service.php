<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_info',
        'icon',
        'image_path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
