<?php

namespace Tests\Feature\Calculation;

use App\Services\CalculatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider validCalculations
     */
    public function test_it_returns_calculation_with_result($calculation, $result): void
    {
        $calculatorService = new CalculatorService();
        $payload = [
            'calculation' => $calculation,
        ];

        $response = $this->postJson(route('api.calculations.store'), $payload)
            ->assertSuccessful();

        $responseData = $response->json('data');
        $this->assertEquals($calculatorService->clean($calculation), $responseData['calculation']);
        $this->assertEquals($result, $responseData['result']);
        $this->assertDatabaseHas('calculations', [
            'calculation' => $calculatorService->clean($calculation),
            'result' => $result,
        ]);
    }

    /**
     * @dataProvider invalidCalculations
     */
    public function test_it_returns_422_for_invalid_calculation($calculation): void
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
            'addition' => ['5+2', '7'],
            'subtraction' => ['5-2', '3'],
            'multiplication' => ['8*4', '32'],
            'division' => ['8/2', '4'],
            'power' => ['2^3', '8'],
            'spaces' => ['   5   + 7  ', '12'],
            'decimals' => ['5.2 + 8.44', '13.64']
        ];
    }

    public function invalidCalculations():array
    {
        return [
            'missing calculation' => [null],
            'letters' => ['foobar'],
            'only the first operand' => ['8+'],
            'only the second operand' => ['+9'],
            'division by zero' => ['2/0']
        ];
    }

}
