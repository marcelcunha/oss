<?php

namespace Database\Factories;

use App\Enums\BudgetStatusEnum;
use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\Checkin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterCreating(function (Budget $budget) {
            BudgetItem::factory()->budget($budget->id)->count(3)->create();
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'checkin_id' => Checkin::factory()->create()->id,
            'budget_date' => now()->format('Y-m-d'),
            'notes' => $this->faker->sentence(),
            'status' => BudgetStatusEnum::PENDING,
        ];
    }
}
