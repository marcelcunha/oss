<?php

use App\Models\Budget;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should open budget edit page', function () {
    $budget = Budget::factory()->create();

    $this->get(route('budgets.edit', $budget))
        ->assertStatus(200)
        ->assertSee('Alterar Orçamento')
        ->assertSee($budget->checkin->client->name)
        ->assertSee($budget->checkin->device->name);
});

it('should update budget', function () {
    $budget = Budget::factory()->create();
    $items = [
        [
            'description' => 'Item 1',
            'price' => 100,
        ],
        [
            'description' => 'Item 2',
            'price' => 200,
        ],
    ];

    $this->put(route('budgets.update', $budget), [
        'budget_date' => now()->format('Y-m-d'),
        'notes' => 'Updated notes',
        'items' => $items,
    ])
        ->assertRedirect(route('budgets.index'))
        ->assertSessionHas('success', 'Orçamento atualizado com sucesso!');

    $this->assertDatabaseHas('budgets', [
        'id' => $budget->id,
        'notes' => 'Updated notes',
    ]);

    foreach ($items as $item) {
        $this->assertDatabaseHas('budget_items', [
            'description' => $item['description'],
            'price' => $item['price'],
        ]);
    }
});

it('should not update budget if status is not pending', function () {
    $budget = Budget::factory()->create(['status' => 'approved']);
    $items = [
        [
            'description' => 'Item 1',
            'price' => 100,
        ],
        [
            'description' => 'Item 2',
            'price' => 200,
        ],
    ];

    $this->put(route('budgets.update', $budget), [
        'budget_date' => now()->format('Y-m-d'),
        'notes' => 'Updated notes',
        'items' => $items,
    ])
        ->assertStatus(403);
});
