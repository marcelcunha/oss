<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceConfigurationFactory> */
    use HasFactory;

    protected $casts = [
        'memory' => 'array',
        'storage' => 'array',
        'gpu' => 'array',
        'power_supply' => 'array',
        'cpu' => 'array',
        'mobo' => 'array',
    ];

    protected $fillable = [
        'os',
        'cpu',
        'mobo',
        'memory',
        'storage',
        'gpu',
        'power_suplly',
        'notes',
        'device_id',
    ];
}
