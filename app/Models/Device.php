<?php

namespace App\Models;

use App\Enums\DeviceTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read string $name
 * @property-read \App\Models\Brand|null $brand
 */
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

    /**
     * @return BelongsTo<Brand, $this>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->orderBy('name');
    }

    /**
     * @return Attribute<string, never>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $description = "{$this->type->label()}: {$this->brand?->name}";

                if ($this->model) {
                    $description .= ' - '.$this->model;
                }

                return $description;
            },
        );
    }
}
