<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Http\Resources\CalculationResource;
use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request):JsonResponse
    {
        $calculations = Calculation::all();
        return CalculationResource::collection($calculations)->response();
    }
}
