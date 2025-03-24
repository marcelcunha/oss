<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open edit client page', function () {
    $client = Client::factory()->create();

    $this->actingAs($this->user)
        ->get(route('clients.edit', $client))
        ->assertStatus(200)
        ->assertSee('Editar Cliente');
});

it('should save edited client', function () {
    $client = Client::factory()->create();
    $name = fake()->name();
    $phone = fake()->cellphoneNumber();
    $address = fake()->streetName();
    $num = fake()->randomNumber(3);
    $complement = fake()->sentence();

    $this->actingAs($this->user)
        ->put(route('clients.update', $client), [
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'num' => $num,
            'complement' => $complement,
        ])
        ->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', [
        'id' => $client->id,
        'name' => $name,
        'phone' => $phone,
        'address' => $address,
        'num' => $num,
        'complement' => $complement,
    ]);
});

it('should not save edited client without name', function () {
    $client = Client::factory()->create();
    $this->actingAs($this->user)
        ->put(route('clients.update', $client), [
            'name' => '',
            'phone' => fake()->cellphoneNumber(),
            'address' => fake()->streetName(),
            'num' => fake()->randomNumber(3),
            'complement' => fake()->sentence(2),
        ])
        ->assertSessionHasErrors('name');
});
