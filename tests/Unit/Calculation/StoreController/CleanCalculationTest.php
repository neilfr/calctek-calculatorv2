<?php

namespace Tests\Unit\Calculation\StoreController;

use App\Http\Controllers\Calculation\StoreController;
use PHPUnit\Framework\TestCase;

class CleanCalculationTest extends TestCase
{
    /**
     * @dataProvider dirtyCalculations
     */
    public function test_it_cleans_calculations($calculation, $cleanCalculation)
    {
        $storeController = new StoreController();
        $this->assertEquals($cleanCalculation, $storeController->clean($calculation));
    }

    public function dirtyCalculations():array
    {
        return [
            'no spaces' => ['5+2', '5+2'],
            'leading spaces' => ['  5+2', '5+2'],
            'trailing spaces' => ['5+2   ', '5+2'],
            'spaces everywhere' => ['   5   + 2  ', '5+2'],
        ];
    }
}
