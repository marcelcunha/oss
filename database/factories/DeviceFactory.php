<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Client;
use App\Models\DeviceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory()->create()->id,
            'type_id' => DeviceType::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
            'model' => $this->faker->optional()->word(),
            'serial_number' => $this->faker->optional()->unique()?->word(),
            'service_tag' => $this->faker->optional()->unique()?->word(),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
