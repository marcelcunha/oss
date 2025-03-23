
<?php

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can delete a brand', function () {
    $this->actingAs($this->user);

    $brand = Brand::factory()->create();

    $response = $this->delete(route('brands.destroy', $brand));

    $response->assertRedirect(route('brands.index'));
    $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
});

it('returns 404 if brand does not exist', function () {
    $this->actingAs($this->user);

    $response = $this->delete(route('brands.destroy', 999));

    $response->assertStatus(404);
});

it('cannot delete a brand if not authenticated', function () {
    $brand = Brand::factory()->create();

    $response = $this->actingAs($this->user)
        ->delete(route('brands.destroy', $brand));

    $response->assertRedirect(route('brands.index'));
    $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
});
