<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('shows budgets list', function () {
    $response = $this->actingAs($this->user)->get(route('budgets.index'));

    $response->assertStatus(200)
        ->assertSee('Orçamentos');
});
