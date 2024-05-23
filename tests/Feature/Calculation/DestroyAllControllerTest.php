<?php

namespace Tests\Feature\Calculation;

use App\Models\Calculation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyAllControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_destroys_all_calculations()
    {
        $calculations = Calculation::factory()->count(3)->create();

        $this->delete(route('api.calculations.destroy-all'))
            ->assertNoContent();

        $calculations->each(function (Calculation $calculation) {
            $this->assertDatabaseMissing('calculations', $calculation->toArray());
        });
    }
}
