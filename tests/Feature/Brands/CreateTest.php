<?php

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open create brand page', function () {
    $this->actingAs($this->user)
        ->get(route('brands.create'))
        ->assertStatus(200);
});

it('should save new brand', function () {
    $this->actingAs($this->user)
        ->post(route('brands.store'), ['name' => fake()->company()])
        ->assertRedirect(route('brands.index'));
});

it('should fail if name is empty', function () {
    $this->actingAs($this->user)
        ->post(route('brands.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
});

it('should fail if name is too long', function () {
    $this->actingAs($this->user)
        ->post(route('brands.store'), ['name' => Str::random(31)])
        ->assertSessionHasErrors('name');
});

it('should fail if name is not unique', function () {
    $brand = Brand::factory()->create();
    $this->actingAs($this->user)
        ->post(route('brands.store'), ['name' => $brand->name])
        ->assertSessionHasErrors('name');
});
