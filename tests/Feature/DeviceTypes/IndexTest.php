<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('shows device_type list page', function () {
    $response = $this->actingAs($this->user)->get(route('device_types.index'));

    $response->assertStatus(200)
        ->assertSee('Tipos de Equipamentos');
});
