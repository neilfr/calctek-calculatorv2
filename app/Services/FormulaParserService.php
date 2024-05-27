<?php
namespace App\Services;

use FormulaParser\FormulaParser;
use InvalidArgumentException;

class FormulaParserService implements CalculatorServiceContract
{
    public function calculate(string $calculation): string
    {
        // TODO: add capability to process 2(3+1) as 2*(3+1)
        $parser = new FormulaParser($calculation);
        $result = $parser->getResult();
        if($result[0]=='error') throw new InvalidArgumentException("Invalid calculation");
        return $result[1];
    }
}
