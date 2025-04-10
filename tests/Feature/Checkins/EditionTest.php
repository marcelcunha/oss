<?php

use App\Models\Checkin;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});
it('can show edit page', function () {
    $checkin = Checkin::factory()->create();

    $response = $this->get(route('checkins.edit', $checkin));

    $response->assertStatus(200)
        ->assertSee('Editar Orçamento');
});

it('can update a checkin', function () {
    $checkin = Checkin::factory()->create(['date' => '2023-01-01']);

    $response = $this->actingAs($this->user)->put(route('checkins.update', $checkin), [
        'description' => $checkin->description,
        'client_id' => $checkin->client_id,
        'device_id' => $checkin->device_id,
        'date' => '2024-05-18',
    ]);

    $response->assertRedirect(route('checkins.index'))
        ->assertSessionHas('success', 'Orçamento atualizado com sucesso!');
    $this->assertDatabaseHas('checkins', [
        'id' => $checkin->id,
        'date' => Carbon::parse('2024-05-18'),
    ]);
});

it('cannot update a checkin without required fields', function () {
    $checkin = Checkin::factory()->create();

    $response = $this->put(route('checkins.update', $checkin), []);

    $response->assertSessionHasErrors([
        'description',
        'client_id',
        'device_id',
        'date',
    ]);

});
