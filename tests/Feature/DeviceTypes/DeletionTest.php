<?php

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

it('can delete a device type', function () {
    $this->actingAs($this->user);

    $deviceType = DeviceType::factory()->create();

    $response = $this->delete(route('device_types.destroy', $deviceType));

    $response->assertRedirect(route('device_types.index'))
    ->assertSessionHas('success', 'Tipo de dispositivo excluído com sucesso!');
    $this->assertDatabaseMissing('device_types', ['id' => $deviceType->id]);
});

it('returns 404 if device type does not exist', function () {
    $this->actingAs($this->user);

    $response = $this->delete(route('device_types.destroy', 999));

    $response->assertStatus(404);
});

it('cannot delete a device type if not authenticated', function () {
    $deviceType = DeviceType::factory()->create();

    $response = $this->delete(route('device_types.destroy', $deviceType));

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('device_types', ['id' => $deviceType->id]);
});

it('cannot delete a device type if used in a device', function () {
    $this->actingAs($this->user);

    $deviceType = DeviceType::factory()->create();
  Device::factory()->create(['type_id' => $deviceType->id]);

    $response = $this->delete(route('device_types.destroy', $deviceType));

    $response->assertRedirect(route('device_types.index'))
    ->assertSessionHas('error', 'Tipo de dispositivo não pode ser excluído, pois está associado a um dispositivo.');
    $this->assertDatabaseHas('device_types', ['id' => $deviceType->id]);
});