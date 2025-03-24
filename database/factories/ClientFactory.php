<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>.en
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->cellphoneNumber(),
            'address' => $this->faker->optional()->address(),
            'num' => $this->faker->optional()->randomNumber(3),
            'complement' => $this->faker->optional()->sentence(),
        ];
    }
}
