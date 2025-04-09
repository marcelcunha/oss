<?php

use App\Enums\DeviceTypeEnum;
use App\Models\Brand;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Str;

beforeEach(fn () => $this->user = User::factory()->create());

it('should open create device page', function () {
    $this->actingAs($this->user)
        ->get(route('devices.create'))
        ->assertStatus(200)
        ->assertSee('Novo Equipamento');
});

it('should save new device', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => 'Device Model',
            'serial_number' => 'Device Serial Number',
            'description' => 'Device Description',
        ])
        ->assertRedirect(route('devices.index'))
        ->assertSessionHas('success', 'Equipamento cadastrado com sucesso!');
});

it('should not save new device without client', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => '',
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => '',
            'serial_number' => 'Device Serial Number',
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('client_id');
});

it('should not save new device without type', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => '',
            'brand_id' => Brand::factory()->create()->id,
            'model' => 'Device Model',
            'serial_number' => 'Device Serial Number',
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('type');
});

it('should not save new device without brand', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => '',
            'model' => 'Device Model',
            'serial_number' => 'Device Serial Number',
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('brand_id');
});

it('should not save new device with model bigger than 50 characters', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => Str::random(51),
            'serial_number' => 'Device Serial Number',
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('model');
});

it('should not save new device with serial bigger than 50 characters', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => 'Device Model',
            'serial_number' => Str::random(51),
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('serial_number');
});

it('should not save new device with service tag bigger than 30 characters', function () {
    $this->actingAs($this->user)
        ->post(route('devices.store'), [
            'client_id' => Client::factory()->create()->id,
            'type' => fake()->randomElement(DeviceTypeEnum::cases())->value,
            'brand_id' => Brand::factory()->create()->id,
            'model' => 'Device Model',
            'serial_number' => 'Device Serial Number',
            'service_tag' => Str::random(31),
            'description' => 'Device Description',
        ])
        ->assertSessionHasErrors('service_tag');
});
