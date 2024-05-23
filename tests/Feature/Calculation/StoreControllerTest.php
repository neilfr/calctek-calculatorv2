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
            'calculation' => '5+2',
        ];
        $this->postJson(route('api.calculations.store'), $payload)
            ->isSuccessful();

        $this->assertDatabaseHas('calculations', [
            'calculation' => $payload['calculation'],
            'result' => 'bar',
        ]);
    }

    /**
     * @dataProvider validCalculations
     */
    public function test_it_returns_calculation_with_result($calculation, $result): void
    {
        $payload = [
            'calculation' => '5+2',
        ];
        $response = $this->postJson(route('api.calculations.store'), $payload);
        $responseData = $response->json('data');
        $this->assertEquals($responseData['calculation'], $payload['calculation']);
        $this->assertEquals($responseData['result'], $result);
    }

    /**
     * @dataProvider invalidCalculations
     */
    public function test_it_returns_422_for_no_calculation($calculation): void
    {
        $payload = [
            'calculation' => $calculation,
        ];

        $this->postJson(route('api.calculations.store'), $payload)
            ->assertUnprocessable();
    }

    public function validCalculations():array
    {
        return [
            'addition' => ['5+2', 'bar'],
            'subtraction' => ['5-2', 'bar'],
            'multiplication' => ['8*4', 'bar'],
            'division' => ['8/2', 'bar'],
            'spaces' => ['   5   + 7  ', 'bar'],
            'decimals' => ['5.2 + 8.44', 'bar']
        ];
    }
    public function invalidCalculations():array
    {
        return [
            'missing calculation' => [null],
            'letters' => ['foobar'],
            'only the first operand' => ['8+'],
            'only the second operand' => ['+9'],
        ];
    }

}
