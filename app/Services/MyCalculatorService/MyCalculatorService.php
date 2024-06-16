<?php

namespace App\Services\MyCalculatorService;

use App\Services\CalculatorServiceContract;
use App\Services\MyCalculatorService\Operators\Add;
use App\Services\MyCalculatorService\Operators\Divide;
use App\Services\MyCalculatorService\Operators\Multiply;
use App\Services\MyCalculatorService\Operators\Power;
use App\Services\MyCalculatorService\Operators\Subtract;
use InvalidArgumentException;

class MyCalculatorService implements CalculatorServiceContract
{
    private $operators =[];

    public function calculate(string $calculation):string
    {
        $this->operators = [
            new Add(),
            new Subtract(),
            new Multiply(),
            new Divide(),
            new Power()
        ];

        $operator = $this->getOperator($calculation);
        list($operand1, $operand2) = $this->getOperands($operator->getSymbol(), $calculation);

        return $operator->calculate($operand1, $operand2);
    }

    private function getOperator(string $calculation):OperatorContract
    {
        foreach ($this->operators as $operator) {
            $operatorPosition = strrpos($calculation, $operator->getSymbol());
            if ($operatorPosition !== false && $operatorPosition != 0) {
                return $operator;
            }
        }
        throw new InvalidArgumentException("Invalid operator");
    }

    public function getOperands(string $operator, string $cleanCalculation): array
    {
        if ($cleanCalculation[0] == '-') {
            $operands = explode($operator, substr($cleanCalculation, 1));
            $operands[0] = '-'. $operands[0];
        } elseif ($cleanCalculation[0] == '+') {
            $operands = explode($operator, substr($cleanCalculation, 1));
        } else {
            $operands = explode($operator, $cleanCalculation);
        }

        return $operands;
    }
}
