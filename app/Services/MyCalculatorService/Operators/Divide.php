<?php

namespace App\Services\MyCalculatorService\Operators;

use App\Services\MyCalculatorService\OperatorContract;

class Divide implements OperatorContract
{

    public function calculate(string $operand1, string $operand2): string
    {
        if($operand2 == 0) {
            return 'INF';
        }
        return strval(floatval($operand1) / floatval($operand2));
    }

    public function getSymbol(): string
    {
        return '/';
    }
}
