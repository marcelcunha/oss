<?php

use App\Models\DeviceType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open create brand page', function () {
    $this->actingAs($this->user)
        ->get(route('device_types.create'))
        ->assertStatus(200);
});

it('should save new brand', function () {
    $this->actingAs($this->user)
        ->post(route('device_types.store'), ['name' => fake()->word()])
        ->assertRedirect(route('device_types.index'));
});

it('should fail if name is empty', function () {
    $this->actingAs($this->user)
        ->post(route('device_types.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
});

it('should fail if name is too long', function () {
    $this->actingAs($this->user)
        ->post(route('device_types.store'), ['name' => Str::random(31)])
        ->assertSessionHasErrors('name');
});

it('should fail if name is not unique', function () {
    $type = DeviceType::factory()->create();

    $this->actingAs($this->user)
        ->post(route('device_types.store'), ['name' => $type->name])
        ->assertSessionHasErrors('name');
});
