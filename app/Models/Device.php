<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type_id',
        'brand_id',
        'model',
        'serial_number',
        'service_tag',
        'description',
    ];

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(DeviceType::class, 'type_id');
    }

    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
