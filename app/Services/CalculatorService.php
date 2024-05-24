<?php

namespace App\Services;

use InvalidArgumentException;

class CalculatorService implements CalculatorServiceContract
{
    public function clean(string $calculation):string
    {
        return str_replace(" ","",$calculation);
    }

    public function calculate(string $calculation):string
    {
        $cleanCalculation = $this->clean($calculation);
        $operator = $this->getOperator($cleanCalculation);

        list($operand1, $operand2) = explode($operator, $cleanCalculation);
        switch ($operator) {
            case '+':
                return strval($operand1 + $operand2);
            case '-':
                return strval($operand1 - $operand2);
            case '*':
                return strval($operand1 * $operand2);
            case '/':
                return strval($operand1 / $operand2);
            default:
                throw new InvalidArgumentException("Invalid operator");
        }
    }

    private function getOperator(string $calculation):string
    {
        $operators = ['+', '-', '*', '/'];
        foreach ($operators as $op) {
            if (strpos($calculation, $op) !== false) {
                return $op;
            }
        }
        throw new InvalidArgumentException("Invalid operator");
    }
}
