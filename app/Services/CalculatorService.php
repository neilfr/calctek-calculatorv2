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

    public function calculate(string $calculation):string
    {
        $operator = $this->getOperator($calculation);
        list($operand1, $operand2) = $this->getOperands($operator, $calculation);

        switch ($operator) {
            case self::ADD:
                return strval($operand1 + $operand2);
            case self::SUBTRACT:
                return strval($operand1 - $operand2);
            case self::MULTIPLY:
                return strval($operand1 * $operand2);
            case self::DIVIDE:
                if ($operand2 == 0) return 'INF';
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
            $operatorPosition = strrpos($calculation, $op);
            if ($operatorPosition !== false && $operatorPosition != 0) {
                return $op;
            }
        }
        throw new InvalidArgumentException("Invalid operator");
    }

    public function getOperands(string $operator, string $cleanCalculation): array
    {
        if ($cleanCalculation[0] == self::SUBTRACT) {
            $operands = explode($operator, substr($cleanCalculation, 1));
            $operands[0] = self::SUBTRACT . $operands[0];
        } elseif ($cleanCalculation[0] == self::ADD) {
            $operands = explode($operator, substr($cleanCalculation, 1));
        } else {
            $operands = explode($operator, $cleanCalculation);
        }

        return $operands;
    }
}
