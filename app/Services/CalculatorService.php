<?php

namespace App\Services;

use App\Exceptions\DivisionByZeroException;
use InvalidArgumentException;

class CalculatorService implements CalculatorServiceContract
{
    const ADD = '+';
    const SUBTRACT = '-';
    const MULTIPLY = '*';
    const DIVIDE = '/';
    const POWER = '^';

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
            case self::ADD:
                return strval($operand1 + $operand2);
            case self::SUBTRACT:
                return strval($operand1 - $operand2);
            case self::MULTIPLY:
                return strval($operand1 * $operand2);
            case self::DIVIDE:
                if ($operand2 == 0) throw new DivisionByZeroException("Division by zero");
                return strval($operand1 / $operand2);
            case self::POWER:
                return strval($operand1 ** $operand2);
            default:
                throw new InvalidArgumentException("Invalid operator");
        }
    }

    private function getOperator(string $calculation):string
    {
        $operators = [self::ADD,self::SUBTRACT, self::MULTIPLY, self::DIVIDE, self::POWER];
        foreach ($operators as $op) {
            if (strpos($calculation, $op) !== false) {
                return $op;
            }
        }
        throw new InvalidArgumentException("Invalid operator");
    }
}
