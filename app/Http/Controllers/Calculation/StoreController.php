<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Calculations\StoreRequest;
use App\Http\Resources\CalculationResource;
use App\Models\Calculation;
use App\Services\CalculatorServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, CalculatorServiceContract $calculatorService):JsonResponse
    {
        Log::info('hello');
        $calculation = new Calculation();
        $calculation->calculation = $this->clean($request->input('calculation'));
        $calculation->result = $calculatorService->calculate($calculation->calculation);
        $calculation->save();
        return (new CalculationResource($calculation))->response();
    }

    public function clean(string $calculation):string
    {
        return str_replace(" ","",$calculation);
    }


}
