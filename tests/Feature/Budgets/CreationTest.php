
<?php

use App\Models\Checkin;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should open create budget page', function () {
    $checkin = Checkin::factory()->create();

    $response = $this->get(route('budgets.create', $checkin));

    $response->assertStatus(200);

});

it('should save new budget', function () {
    $checkin = Checkin::factory()->create();
    $budgetData = [
        'checkin_id' => $checkin->id,
        'budget_date' => now()->format('Y-m-d'),
        'items' => [
            ['description' => 'Test Item', 'price' => 100.00],
            ['description' => 'Test Item 2', 'price' => 150.00],
        ],
    ];

    $response = $this->post(route('budgets.store'), $budgetData);

    $response->assertRedirect(route('budgets.index'))
        ->assertSessionHas('success', 'Orçamento cadastrado com sucesso!');

    $this->assertDatabaseHas('budgets', [
        'checkin_id' => $checkin->id,
    ]);
    
    $this->assertDatabaseHas('budget_items', [
        'description' => 'Test Item',
        'price' => 100.00,
    ]);
    $this->assertDatabaseHas('budget_items', [
        'description' => 'Test Item 2',
        'price' => 150.00,
    ]);
});

it('should not save budget without items', function () {
    $checkin = Checkin::factory()->create();
    $budgetData = [
        'checkin_id' => $checkin->id,
        'budget_date' => now()->format('Y-m-d'),
        'items' => [],
    ];

    $response = $this->post(route('budgets.store'), $budgetData);

    $response->assertSessionHasErrors(['items']);
});

it('should not save budget with invalid checkin', function () {
    $budgetData = [
        'checkin_id' => 9999, // Invalid checkin ID
        'budget_date' => now()->format('Y-m-d'),
        'items' => [
            ['description' => 'Test Item', 'price' => 100.00],
        ],
    ];

    $response = $this->post(route('budgets.store'), $budgetData);

    $response->assertSessionHasErrors(['checkin_id']);
});

it('should not save budget with invalid date', function () {
    $checkin = Checkin::factory()->create();
    $budgetData = [
        'checkin_id' => $checkin->id,
        'budget_date' => 'invalid-date',
        'items' => [
            ['description' => 'Test Item', 'price' => 100.00],
        ],
    ];

    $response = $this->post(route('budgets.store'), $budgetData);

    $response->assertSessionHasErrors(['budget_date']);
});
