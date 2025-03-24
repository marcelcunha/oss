<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows clients list', function(){
    $this->actingAs(User::factory()->create())
    ->get(route('clients.index'))
    ->assertStatus(200)
    ->assertSee('Clientes');
});