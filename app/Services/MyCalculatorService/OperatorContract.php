<?php

namespace App\Services\MyCalculatorService;

interface OperatorContract
{
    public function calculate(string $operand1, string $operand2): string;

    public function getSymbol(): string;
}
