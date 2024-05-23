<?php

namespace Tests\Feature\Calculation;

use App\Models\Calculation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_calculations():void
    {
        Calculation::factory()->count(3)->create();

        $this->assertEquals(3, Calculation::all()->count());

        $responseData = $this->get(route('api.calculations.get'))
            ->assertSuccessful()
            ->json('data');

        $this->assertCount(3, $responseData);
    }
}
