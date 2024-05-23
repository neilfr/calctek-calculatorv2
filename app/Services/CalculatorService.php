<?php

namespace App\Services;

class CalculatorService
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
                return 'error';
        }
    }

    public function getOperator(string $calculation):string
    {
        $operators = ['+', '-', '*', '/'];
        foreach ($operators as $op) {
            if (strpos($calculation, $op) !== false) {
                return $op;
            }
        }
        return '';
    }
}
