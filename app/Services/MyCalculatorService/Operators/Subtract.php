<?php

namespace App\Services\MyCalculatorService\Operators;

use App\Services\MyCalculatorService\OperatorContract;

class Subtract implements OperatorContract
{

    public function calculate(string $operand1, string $operand2): string
    {
        return strval(floatval($operand1) - floatval($operand2));
    }

    public function getSymbol(): string
    {
        return '-';
    }
}
