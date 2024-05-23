<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Http\Resources\CalculationResource;
use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request):JsonResponse
    {
        $calculation = new Calculation();
        $calculation->calculation = 'foo';
        $calculation->result = 'bar';
        $calculation->save();
        return (new CalculationResource($calculation))->response();
    }
}
