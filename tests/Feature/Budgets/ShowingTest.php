
<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can show a budget', function () {
    $budget = \App\Models\Budget::factory()->create();

    $response = $this->get(route('budgets.show', $budget));

    $response->assertStatus(200);
    $response->assertSee($budget->name);
});

it('returns 404 for non-existent budget', function () {
    $response = $this->get(route('budgets.show', 999));

    $response->assertStatus(404);
});
