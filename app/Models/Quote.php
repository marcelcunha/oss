<?php

namespace App\Models;

use App\Enums\QuoteStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    protected $casts = [
        'quote_date' => 'date',
        'status' => QuoteStatusEnum::class,
    ];

    protected $fillable = [
        'checkin_id',
        'quote_date',
        'notes',
        'status',
    ];

    /**
     * @return HasMany<BudgetItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }

    /**
     * @return Attribute<float, never>
     */
    public function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value): float => $this->items->sum('price'),
        );
    }
}
