<?php

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should open create client page', function () {
    $this->actingAs($this->user)
        ->get(route('clients.create'))
        ->assertStatus(200)
        ->assertSee('Novo Cliente');
});

it('should save new client', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => 'Client Address',
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertRedirect(route('clients.index'));
});

it('should not save new client without name', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => '',
            'phone' => fake()->cellphoneNumber(),
            'address' => 'Client Address',
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('name');
});

it('should not save new client with name bigger than 60 characters', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => Str::random(61),
            'phone' => fake()->cellphoneNumber(),
            'address' => 'Client Address',
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('name');
});

it('should not save new client with phone bigger than 16 characters', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => Str::random(17),
            'address' => 'Client Address',
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('phone');
});

it('should not save new client with address bigger than 60 characters', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => Str::random(61),
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('address');
});

it('should not save new client with num not numeric', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => 'Client Address',
            'num' => 'abc',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('num');
});

it('should not save new client with complement bigger than 60 characters', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => 'Client Address',
            'num' => '123',
            'complement' => Str::random(61)
        ])
        ->assertSessionHasErrors('complement');
});

it('should not save new client without phone', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => '',
            'address' => 'Client Address',
            'num' => '123',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors('phone');
});

it('should not save new client without address and num present', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => '',
            'num' => '123',
            'complement' => ''
        ])
        ->assertSessionHasErrors(['num']);
});

it('should not save new client without address and complement present', function () {
    $this->actingAs($this->user)
        ->post(route('clients.store'), [
            'name' => 'Client Name',
            'phone' => fake()->cellphoneNumber(),
            'address' => '',
            'num' => '',
            'complement' => 'Client Complement'
        ])
        ->assertSessionHasErrors(['complement']);
});
