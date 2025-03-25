<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceConfigurationFactory> */
    use HasFactory;

    protected $filled = [
        'mobo_brand',
        'mobo_model',
        'cpu_brand',
        'cpu_model',
        'ram_brand',
        'ram_model',
        'ram_capacity',
        'gpu_brand',
        'gpu_model',
        'storage1_brand',
        'storage1_model',
        'storage1_capacity',
        'storage2_brand',
        'storage2_model',
        'storage2_capacity',
        'storage3_brand',
        'storage3_model',
        'storage3_capacity',
        'storage4_brand',
        'storage4_model',
        'storage4_capacity',
    ];
}
