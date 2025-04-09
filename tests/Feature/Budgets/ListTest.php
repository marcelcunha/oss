
<?php

use function Pest\Laravel\get;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);



describe('budgets', function(){
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('can list all budgets', function () {
        $budgets =Budget::factory()->count(5)->create();
    
        $response = $this->actingAs($this->user)->get(route('budgets.index'));
    
        $response->assertStatus(200)
        ->assertSee('Orçamentos')
        ->assertSee('Novo Orçamento');
       
    });

});