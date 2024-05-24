<?php

namespace Tests\Feature\Services;

use App\Exceptions\DivisionByZeroException;
use App\Services\CalculatorService;
use InvalidArgumentException;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{

    protected $calculatorService;
    public function setUp(): void
    {
        parent::setUp();
        $this->calculatorService = new CalculatorService();
    }

    /**
     * @dataProvider dirtyCalculations
     */
    public function test_it_cleans_calculations($calculation, $cleanCalculation)
    {
        $this->assertEquals($cleanCalculation, $this->calculatorService->clean($calculation));
    }

    /**
     * @dataProvider validCalculations
     */
    public function test_it_should_calculate_results($calculation, $result)
    {
        $cleanCalculation = $this->calculatorService->clean($calculation);
        $calculatedResult = $this->calculatorService->calculate($cleanCalculation);
        $this->assertEquals($result, $calculatedResult);
    }

    public function test_it_throws_exception_when_valid_operator_is_not_found()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->calculate('5@2');
    }

    public function test_it_should_throw_division_by_zero_exception_on_division_by_zero():void
    {
        $this->expectException(DivisionByZeroException::class);
        $this->calculatorService->calculate('5/0');
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
            'power' => ['2^3','8'],
            'spaces' => ['   5   + 7  ', '12'],
            'decimals' => ['5.2 + 8.44', '13.64']
        ];
    }
}
