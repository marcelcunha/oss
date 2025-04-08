<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceConfigurationFactory> */
    use HasFactory;

    protected $filled = [
        'os',
        'cpu',
        'mobo',
        'memory',
        'storage',
        'gpu',
        'power_suply',
        'notes',
        'device_id',
    ];

    protected $casts = [
        'memory' => 'array',
        'storage' => 'array',
        'gpu' => 'array',
        'power_supply' => 'array',
        'cpu' => 'array',
        'mobo' => 'array',
    ];
}
