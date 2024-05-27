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
     * @dataProvider validCalculations
     */
    public function test_it_should_calculate_results($calculation, $result)
    {
        $calculatedResult = $this->calculatorService->calculate($calculation);
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

    public function validCalculations():array
    {
        return [
            'addition with negative first operand' => ['-2+3',1],
            'subtraction with negative first operand' => ['-2.3-3',-5.3],
            'multiplication with negative first operand' => ['-2*3',-6],
            'division with negative first operand' => ['-2/4',-0.5],
            'power with negative first operand' => ['-2^3',-8],
            'addition with unnecessary positive operator' => ['+2+3',5],
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
