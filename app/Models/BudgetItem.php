<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BudgetItem extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetItemFactory> */
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'description',
        'price',
    ];

    /**
     * @return BelongsTo<Budget, $this>
     */
    public function budget() : BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * @return Attribute<float,string>
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value): float => (float) $value / 100,
            set: fn($value) => preg_replace('/\D/', '', $value),
        );
    }
}
