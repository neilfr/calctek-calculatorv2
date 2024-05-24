<?php

namespace Tests\Feature\Calculation;

use App\Models\Calculation;
use Tests\TestCase;

class DestroyAllControllerTest extends TestCase
{
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
