<?php

use App\Models\Client;
use App\Models\User;

beforeEach(fn() => $this->user = User::factory()->create());

it('should show a client', function () {
    $client = Client::factory()->create();

    $response = $this->actingAs($this->user)
        ->get(route('clients.show', $client->id));

    $response->assertStatus(200)
        ->assertViewIs('pages.register.clients.show')
        ->assertViewHas('client', $client);
});
