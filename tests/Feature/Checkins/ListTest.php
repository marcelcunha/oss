
<?php

use App\Models\Checkin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('checkins', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('can list all checkins', function () {
        $checkins = Checkin::factory()->count(5)->create();

        $response = $this->actingAs($this->user)->get(route('checkins.index'));

        $response->assertStatus(200)
            ->assertSee('Checkin')
            ->assertSee('Novo Checkin');

    });

});
