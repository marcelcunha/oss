<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'client_id' => \App\Models\Client::factory()->create()->id,
            'device_id' => \App\Models\Device::factory()->nonComputer()->create()->id,
            'description' => $this->faker->sentence(10),
        ];
    }
}
