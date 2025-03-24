<?php

use App\Models\Device;
use App\Models\User;

beforeEach( fn() => $this->user = User::factory()->create() );

it('should delete a device', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->delete(route('devices.destroy', $device->id))
        ->assertRedirect(route('devices.index'));

    $this->assertDatabaseMissing('devices', [
        'id' => $device->id,
    ]);
});
