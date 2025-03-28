<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'categories' => $this->faker->optional(0.6)->randomElements([
                'electronics',
                'furniture',
                'clothing',
                'toys',
                'books',
                'sports',
                'automotive',
                'health',
                'beauty',
                'food',
            ], rand(1, 5)),
        ];
    }
}
