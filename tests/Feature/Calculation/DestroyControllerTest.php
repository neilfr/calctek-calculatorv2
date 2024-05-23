<?php

namespace Tests\Feature\Calculation;

use App\Models\Calculation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_deletes_a_calculation()
    {
        $calculations = Calculation::factory()->count(3)->create();

        $this->delete(route('api.calculations.destroy', $calculations[1]))
            ->assertNoContent();

        $this->assertDatabaseMissing('calculations', $calculations[1]->toArray());
        $this->assertDatabaseHas('calculations', $calculations[0]->toArray());
        $this->assertDatabaseHas('calculations', $calculations[2]->toArray());
    }
}
