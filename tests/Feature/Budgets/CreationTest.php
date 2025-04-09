<?php

use App\Enums\BrandCategoryEnum;
use App\Enums\DeviceTypeEnum;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open create budget page', function () {
    $this->actingAs($this->user)
        ->get(route('budgets.create'))
        ->assertStatus(200);
});

it('should save new budget without configuration', function () {
    $client = Client::factory()->create();
    $device = Device::factory()->create(['type' => DeviceTypeEnum::TABLET]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => fake()->text(),
            'client_id' => $client->id,
            'device_id' => $device->id,
        ])
        ->assertRedirect(route('budgets.index'))
        ->assertSessionHas('success', 'Orçamento cadastrado com sucesso!');
});

it('should save new budget with configuration', function () {
    $client = Client::factory()->create();
    $device = Device::factory()->create(['type' => DeviceTypeEnum::DESKTOP]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => fake()->text(),
            'client_id' => $client->id,
            'device_id' => $device->id,
            'configuration' => [
                'os' => 'Windows 11',
                'cpu' => [
                    'brand_id' => Brand::factory()->create(['name' => 'AMD', 'categories' => BrandCategoryEnum::CPU])->id,
                    'model' => 'Ryzen 5 5600X',
                ],
                'mobo' => [
                    'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::MOTHERBOARD])->id,
                    'model' => 'ROG Strix B550-F Gaming',
                ],
                'storage' => [
                    [
                        'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::STORAGE])->id,
                        'model' => 'Samsung 970 EVO Plus',
                        'size' => 1000,
                    ],
                ],
                'memory' => [
                    [
                        'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::RAM])->id,
                        'model' => 'Corsair Vengeance LPX',
                        'size' => 16,
                    ],
                ],
                'power_supply' => [
                    'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::POWERSUPPLY])->id,
                    'model' => 'Corsair RM750x',
                    'wattage' => 750,

                ],
            ],
        ])
        ->assertRedirect(route('budgets.index'))
        ->assertSessionHas('success', 'Orçamento cadastrado com sucesso!');
});

it('should not save new budget with invalid configuration', function () {
    $client = Client::factory()->create();
    $device = Device::factory()->create(['type' => DeviceTypeEnum::DESKTOP]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => fake()->text(),
            'client_id' => $client->id,
            'device_id' => $device->id,
            'configuration' => [
                'os' => 'Windows 11',
                'cpu' => [
                    'brand_id' => Brand::factory()->create(['name' => 'AMD', 'categories' => BrandCategoryEnum::CPU])->id,
                    'model' => 'Ryzen 5 5600X',
                ],
                'mobo' => [
                    'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::MOTHERBOARD])->id,
                    'model' => 'ROG Strix B550-F Gaming',
                ],
                'storage' => [
                    [
                        'brand_id' => Brand::factory()->create(['categories' => BrandCategoryEnum::STORAGE])->id,
                        'model' => 'Samsung 970 EVO Plus',
                        // Missing size
                    ],
                ],
                'memory' => [
                    [
                        // Missing brand_id
                        'model' => 'Corsair Vengeance LPX',
                        // Missing size
                    ],
                ],
                // Missing power_supply
            ],
        ])
        ->assertSessionHasErrors([
            'configuration.storage.0.size',
            'configuration.memory.0.brand_id',
            'configuration.memory.0.size',
            'configuration.power_supply.brand_id',
        ]);
});

it('should not save new budget with invalid date', function () {
    $client = Client::factory()->create();
    $device = Device::factory()->create(['type' => DeviceTypeEnum::DESKTOP]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => 'invalid-date',
            'description' => fake()->text(),
            'client_id' => $client->id,
            'device_id' => $device->id,
        ])
        ->assertSessionHasErrors([
            'date',
        ]);
});

it('should not save new budget with invalid client', function () {
    $device = Device::factory()->create(['type' => DeviceTypeEnum::DESKTOP]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => fake()->text(),
            'client_id' => 9999, // Invalid client ID
            'device_id' => $device->id,
        ])
        ->assertSessionHasErrors([
            'client_id',
        ]);
});

it('should not save new budget with invalid device', function () {
    $client = Client::factory()->create();

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => fake()->text(),
            'client_id' => $client->id,
            'device_id' => 9999, // Invalid device ID
        ])
        ->assertSessionHasErrors([
            'device_id',
        ]);
});

it('should not save new budget with invalid description', function () {
    $client = Client::factory()->create();
    $device = Device::factory()->create(['type' => DeviceTypeEnum::DESKTOP]);

    $this->actingAs($this->user)
        ->post(route('budgets.store'), [
            'date' => now()->format('Y-m-d'),
            'description' => '', // Invalid description
            'client_id' => $client->id,
            'device_id' => $device->id,
        ])
        ->assertSessionHasErrors([
            'description',
        ]);
});

