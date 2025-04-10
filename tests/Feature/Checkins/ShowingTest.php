
<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can show a checkin', function () {
    $checkin = \App\Models\Checkin::factory()->create();

    $response = $this->get(route('checkins.show', $checkin));

    $response->assertStatus(200);
    $response->assertSee($checkin->name);
});

it('returns 404 for non-existent checkin', function () {
    $response = $this->get(route('checkins.show', 999));

    $response->assertStatus(404);
});
