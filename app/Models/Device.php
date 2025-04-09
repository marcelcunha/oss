<?php

namespace App\Models;

use App\Enums\DeviceTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    /** @use HasFactory<\Database\Factories\DeviceFactory> */
    use HasFactory;

    protected $casts = [

        'type' => DeviceTypeEnum::class,
    ];

    protected $fillable = [
        'client_id',
        'type',
        'brand_id',
        'model',
        'serial_number',
        'service_tag',
        'description',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->orderBy('name');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            function () {
                $description = $this->brand->name;

                if ($this->model) {
                    $description .= ' - '.$this->model;
                }

                return $description;
            },
        );
    }
}
