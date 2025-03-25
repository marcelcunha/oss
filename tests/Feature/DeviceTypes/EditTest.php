<?php

use App\Models\DeviceType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open edit device type page', function () {
    $type = DeviceType::factory()->create();

    $this->actingAs($this->user)
        ->get(route('device_types.edit', $type))
        ->assertStatus(200);
});

it('should save edited device type', function () {
    $type = DeviceType::factory()->create();
    $name = fake()->words(1, asText: true);

    $this->actingAs($this->user)
        ->put(route('device_types.update', $type), ['name' => $name])
        ->assertRedirect(route('device_types.index'));

    $this->assertDatabaseHas('device_types', [
        'id' => $type->id,
        'name' => $name,
    ]);
});

it('should fail if name is empty on edit', function () {
    $type = DeviceType::factory()->create();
    $this->actingAs($this->user)
        ->put(route('device_types.update', $type), ['name' => ''])
        ->assertSessionHasErrors('name');
});

it('should fail if name is too long on edit', function () {
    $type = DeviceType::factory()->create();
    $this->actingAs($this->user)
        ->put(route('device_types.update', $type), ['name' => Str::random(31)])
        ->assertSessionHasErrors('name');
});

it('should fail if name is not unique on edit', function () {
    $type1 = DeviceType::factory()->create();
    $type2 = DeviceType::factory()->create();
    $this->actingAs($this->user)
        ->put(route('device_types.update', $type2), ['name' => $type1->name])
        ->assertSessionHasErrors('name');
});
