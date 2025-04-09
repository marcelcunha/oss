<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Budget extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetFactory> */
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

    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }

    public function configuration(): HasOne
    {
        return $this->hasOne(DeviceConfiguration::class);
    }

    public function device(): BelongsTo
    {
        return $this->BelongsTo(Device::class);
    }
}
