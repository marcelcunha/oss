<?php

namespace Database\Factories;

use App\Enums\DeviceTypeEnum;
use App\Models\Brand;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            'type' => $this->faker->randomElement(DeviceTypeEnum::cases())?->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => $this->faker->optional()->word(),
            'serial_number' => $this->faker->optional()->unique()?->word(),
            'service_tag' => $this->faker->optional()->unique()?->word(),
            'description' => $this->faker->optional()->sentence(),
        ];
    }

    public function nonComputer(): static
    {
        $types = array_filter(DeviceTypeEnum::cases(), function ($case) {
            return !in_array($case->value, [
                DeviceTypeEnum::DESKTOP->value,
                DeviceTypeEnum::LAPTOP->value,
            ]);
        },);

        return $this->state([
            'type' => $this->faker->randomElement($types)?->value,
        ]);
    }
}
