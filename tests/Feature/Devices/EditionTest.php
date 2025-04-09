<?php

use App\Models\Device;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

it('should open edit device page', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->get(route('devices.edit', $device->id))
        ->assertStatus(200)
        ->assertSee('Editar Equipamento')
        ->assertSee($device->client->name)
        ->assertSee($device->type->label())
        ->assertSee($device->brand->name);
});

it('should update device', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type' => $device->type->value,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'description' => 'Device Description Updated',
        ])
        ->assertRedirect(route('devices.index'))
        ->assertSessionHas('success', 'Equipamento atualizado com sucesso!');

    $this->assertDatabaseHas('devices', [
        'id' => $device->id,
        'model' => 'Device Model Updated',
        'serial_number' => 'Device Serial Number Updated',
        'description' => 'Device Description Updated',
    ]);
});

it('should not update device without client', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => '',
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('client_id');
});

it('should not update device without type', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => '',
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('type');
});

it('should not update device without brand', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => '',
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('brand_id');
});

it('should not update device with model bigger than 50 characters', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => str_repeat('a', 51),
            'serial_number' => 'Device Serial Number Updated',
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('model');
});

it('should not update device with serial bigger than 50 characters', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => str_repeat('a', 51),
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('serial_number');
});

it('should not update device with service tag bigger than 30 characters', function () {
    $device = Device::factory()->create();

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'service_tag' => str_repeat('a', 31),
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('service_tag');
});

it('should not update device with duplicated serial number', function () {
    $device = Device::factory()->create();
    $deviceDuplicated = Device::factory()->create(['serial_number' => 'Serial Number Duplicated']);

    $this->actingAs($this->user)
        ->put(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => $deviceDuplicated->serial_number,
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('serial_number');
});

it('should not update device with duplicated service tag', function () {
    $device = Device::factory()->create();
    $deviceDuplicated = Device::factory()->create(['service_tag' => 'Service Tag Duplicated']);

    $this->actingAs($this->user)
        ->patch(route('devices.update', $device->id), [
            'client_id' => $device->client_id,
            'type_id' => $device->type_id,
            'brand_id' => $device->brand_id,
            'model' => 'Device Model Updated',
            'serial_number' => 'Device Serial Number Updated',
            'service_tag' => $deviceDuplicated->service_tag,
            'description' => 'Device Description Updated',
        ])
        ->assertSessionHasErrors('service_tag');
});
