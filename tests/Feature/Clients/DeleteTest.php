<?php

use App\Models\Client;
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
