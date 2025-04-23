<?php

use App\Models\Budget;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('deletes a budget', function () {
    $budget = Budget::factory()->create();
    $items = $budget->items->pluck('id');

    foreach ($items as $item) {
        $this->assertDatabaseHas('budget_items', [
            'id' => $item,
        ]);
    }

    $response = $this->delete(route('budgets.destroy', $budget));

    $response
        ->assertRedirect(route('budgets.index'))
        ->assertSessionHas('success', 'Orçamento excluído com sucesso!');

    $this->assertDatabaseMissing('budgets', [
        'id' => $budget->id,
    ]);

    foreach ($items as $item) {
        $this->assertDatabaseMissing('budget_items', [
            'id' => $item,
        ]);
    }
});
