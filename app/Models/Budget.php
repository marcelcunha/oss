<?php

namespace App\Models;

use App\Enums\BudgetStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetFactory> */
    use HasFactory;

    protected $casts = [
        'budget_date' => 'date',
        'status' => BudgetStatusEnum::class,
    ];

    protected $fillable = [
        'checkin_id',
        'budget_date',
        'notes',
        'status',
    ];

    /**
     * @return BelongsTo<Checkin, $this>
     */
    public function checkin(): BelongsTo
    {
        return $this->belongsTo(Checkin::class);
    }

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
            get: fn($value): float => $this->items->sum('price'),
        );
    }
}
