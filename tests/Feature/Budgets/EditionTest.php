<?php

use App\Models\User;
use App\Models\Budget;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});
it('can show edit page', function(){
    $budget = Budget::factory()->create();

    $response = $this->get(route('budgets.edit', $budget));

    $response->assertStatus(200)
        ->assertSee('Editar Orçamento')
       
        ;
});


it('can update a budget', function () {
    $budget = Budget::factory()->create(['date' => '2023-01-01']);

    $response = $this->actingAs($this->user)->put(route('budgets.update', $budget), [
        'description' => $budget->description,  
        'client_id' => $budget->client_id,
        'device_id' => $budget->device_id,
        'date' => '2024-05-18',
    ]);

    $response->assertRedirect(route('budgets.index'))
    ->assertSessionHas('success', 'Orçamento atualizado com sucesso!');
    $this->assertDatabaseHas('budgets', [
        'id' => $budget->id,
        'date' => Carbon::parse('2024-05-18'),
    ]);
});

it('cannot update a budget without required fields', function () {
    $budget = Budget::factory()->create();

    $response = $this->put(route('budgets.update', $budget), []);

    $response->assertSessionHasErrors([
        'description',
        'client_id',
        'device_id',
        'date',
    ]);
    
});

