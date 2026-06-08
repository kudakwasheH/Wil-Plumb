<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'service_id',
        'preferred_date',
        'problem_description',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
