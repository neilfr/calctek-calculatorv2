<?php

namespace Tests\Feature\Services;

use App\Services\FormulaParserService;
use InvalidArgumentException;
use Tests\TestCase;

class FormulaParserServiceTest extends TestCase
{
    public function test_it_throws_exception_on_invalid_calculation()
    {
        $calculatorService = new FormulaParserService();
        $this->expectException(InvalidArgumentException::class);
        $calculatorService->calculate('5@2');
    }
}
