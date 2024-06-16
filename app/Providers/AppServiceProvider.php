<?php

namespace App\Providers;

use App\Services\CalculatorServiceContract;
use App\Services\FormulaParserService;
use App\Services\MyCalculatorService\MyCalculatorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register():void
    {
        $this->app->bind(CalculatorServiceContract::class, function () {
            $serviceType = config('calculation_service.default');
            switch($serviceType) {
                case 'FORMULA_PARSER':
                    return new FormulaParserService();
                case 'MY_CALCULATOR_SERVICE':
                    return new MyCalculatorService();
                default:
                    throw new \Exception("Calculator service type '$serviceType' not found");
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
