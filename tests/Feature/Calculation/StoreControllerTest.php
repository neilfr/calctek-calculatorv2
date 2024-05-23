<?php

namespace Tests\Feature\Calculation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_calculation():void
    {
        $payload = [
            '5+2',
        ];
        $this->post(route('api.calculations.store'), $payload)
            ->isSuccessful();

        $this->assertDatabaseHas('calculations', [
            'calculation' => 'foo',
            'result' => 'bar',
        ]);
    }

    public function test_it_returns_calculation_with_result():void
    {
        $payload = [
            '5+2',
        ];
        $response = $this->post(route('api.calculations.store'), $payload);
        $responseData = $response->json('data');
        $this->assertEquals($responseData['calculation'], 'foo');
        $this->assertEquals($responseData['result'], 'bar');
    }

}
