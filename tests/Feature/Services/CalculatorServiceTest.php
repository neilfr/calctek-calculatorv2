<?php

namespace Tests\Feature\Services;

use App\Services\CalculatorService;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{

    /**
     * @dataProvider dirtyCalculations
     */
    public function test_it_cleans_calculations($calculation, $cleanCalculation)
    {
        $calculatorService = new CalculatorService();
        $this->assertEquals($cleanCalculation, $calculatorService->clean($calculation));
    }

    /**
     * @dataProvider validCalculations
     */
    public function test_it_should_calculate_results($calculation, $result)
    {
        $calculatorService = new CalculatorService();
        $cleanCalculation = $calculatorService->clean($calculation);
        $calculatedResult = $calculatorService->calculate($cleanCalculation);
        $this->assertEquals($result, $calculatedResult);
    }

    public function dirtyCalculations():array
    {
        return [
            'no spaces' => ['5+2', '5+2'],
            'leading spaces' => ['  5+2', '5+2'],
            'trailing spaces' => ['5+2   ', '5+2'],
            'spaces everywhere' => ['   5   + 2  ', '5+2'],
        ];
    }

    public function validCalculations():array
    {
        return [
            'addition' => ['5+2', '7'],
            'subtraction' => ['5-2', '3'],
            'multiplication' => ['8*4', '32'],
            'division' => ['8/2', '4'],
            'spaces' => ['   5   + 7  ', '12'],
            'decimals' => ['5.2 + 8.44', '13.64']
        ];
    }
}
