<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BudgetItem>
 */
class BudgetItemFactory extends Factory
{
    public function budget(int $budgetId): static
    {
        return $this->state(function () use ($budgetId) {
            return [
                'budget_id' => $budgetId,
            ];
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
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
