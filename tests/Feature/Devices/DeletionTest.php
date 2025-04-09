<?php

use App\Models\Device;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

it('should delete a device', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->delete(route('devices.destroy', $device->id))
        ->assertRedirect(route('devices.index'));

    $this->assertDatabaseMissing('devices', [
        'id' => $device->id,
    ]);
});

it('should return 404 if device does not exist', function () {
    $this->actingAs($this->user)
        ->delete(route('devices.destroy', 999))
        ->assertStatus(404);
});

it('should not delete a device if not authenticated', function () {
    $device = Device::factory()->create();

    $this->delete(route('devices.destroy', $device->id))
        ->assertRedirect(route('login'));

    $this->assertDatabaseHas('devices', [
        'id' => $device->id,
    ]);
});
