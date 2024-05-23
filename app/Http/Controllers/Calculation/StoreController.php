<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Calculations\StoreRequest;
use App\Http\Resources\CalculationResource;
use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $calculation = new Calculation();
        $calculation->calculation = $request->input('calculation');
        $calculation->result = 'bar';
        $calculation->save();
        return (new CalculationResource($calculation))->response();
    }
}
