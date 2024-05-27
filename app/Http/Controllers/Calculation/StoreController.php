<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Calculations\StoreRequest;
use App\Http\Resources\CalculationResource;
use App\Models\Calculation;
use App\Services\CalculatorService;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, CalculatorService $calculatorService):JsonResponse
    {
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
