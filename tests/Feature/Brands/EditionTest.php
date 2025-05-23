<?php

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open edit brand page', function () {
    $brand = Brand::factory()->create();

    $this->actingAs($this->user)
        ->get(route('brands.edit', $brand))
        ->assertStatus(200);
});

it('should save edited brand', function () {
    $brand = Brand::factory()->create();
    $name = fake()->words(asText: true);
    $categories = ['a', 'b', 'c'];

    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => $name, 'categories' => $categories])
        ->assertRedirect(route('brands.index'))
        ->assertSessionHas('success', 'Marca atualizada com sucesso!');

    $this->assertDatabaseHas('brands', [
        'id' => $brand->id,
        'name' => $name,
        'categories' => json_encode($categories),
    ]);
});

it('should save edited brand with empty categories', function () {
    $brand = Brand::factory()->create();
    $name = fake()->words(2, asText: true);

    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => $name, 'categories' => []])
        ->assertRedirect(route('brands.index'))
        ->assertSessionHas('success', 'Marca atualizada com sucesso!');

    $this->assertDatabaseHas('brands', [
        'id' => $brand->id,
        'name' => $name,
        'categories' => json_encode([]),
    ]);
});

it('should fail if name is empty on edit', function () {
    $brand = Brand::factory()->create();
    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => ''])
        ->assertSessionHasErrors('name');
});

it('should fail if name is too long on edit', function () {
    $brand = Brand::factory()->create();
    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => Str::random(31)])
        ->assertSessionHasErrors('name');
});

it('should fail if name is not unique on edit', function () {
    $brand1 = Brand::factory()->create();
    $brand2 = Brand::factory()->create();
    $this->actingAs($this->user)
        ->put(route('brands.update', $brand2), ['name' => $brand1->name])
        ->assertSessionHasErrors('name');
});

it('should fail if categories is not an array on edit', function () {
    $brand = Brand::factory()->create();
    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => fake()->company(), 'categories' => 'not-an-array'])
        ->assertSessionHasErrors('categories');
});

it('should fail if categories is not distinct on edit', function () {
    $brand = Brand::factory()->create();
    $this->actingAs($this->user)
        ->put(route('brands.update', $brand), ['name' => fake()->company(), 'categories' => ['a', 'b', 'a']])
        ->assertSessionHasErrors('categories.*');
});
