<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Checkin extends Model
{
    /** @use HasFactory<\Database\Factories\CheckinFactory> */
    use HasFactory;

    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'date',
        'client_id',
        'device_id',
        'description',
    ];

    /**
     * @return HasOne<Budget, $this>
     */
    public function budget(): HasOne
    {
        return $this->hasOne(Budget::class);
    }

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }

    /**
     * @return HasOne<DeviceConfiguration, $this>
     */
    public function configuration(): HasOne
    {
        return $this->hasOne(DeviceConfiguration::class);
    }

    /**
     * @return BelongsTo<Device, $this>
     */
    public function device(): BelongsTo
    {
        return $this->BelongsTo(Device::class);
    }
}
