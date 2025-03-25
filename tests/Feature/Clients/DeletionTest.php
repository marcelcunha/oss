<?php

use App\Models\Client;
use App\Models\Device;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('should delete a client', function () {
    $client = Client::factory()->create();

    $response = $this->actingAs($this->user)
        ->delete(route('clients.destroy', $client->id));

    $response->assertRedirect(route('clients.index'));
    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
});

it('should return 404 if client does not exist', function () {
    $this->actingAs($this->user);

    $response = $this->delete(route('clients.destroy', 999));

    $response->assertStatus(404);
});

it('should not delete a client if not authenticated', function () {
    $client = Client::factory()->create();

    $response = $this->delete(route('clients.destroy', $client->id));

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('clients', ['id' => $client->id]);
});

it('should not delete a client if used in a device', function () {
    $this->actingAs($this->user);

    $client = Client::factory()->create();
    $device = Device::factory()->create(['client_id' => $client->id]);

    $response = $this->delete(route('clients.destroy', $client->id));

    $response->assertRedirect(route('clients.index'))
        ->assertSessionHas('error', 'Cliente não pode ser excluído, pois está associado a um dispositivo.');
    $this->assertDatabaseHas('clients', ['id' => $client->id]);
});
