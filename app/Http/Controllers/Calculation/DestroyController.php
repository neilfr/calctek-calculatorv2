<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    public function __invoke(Request $request, Calculation $calculation): JsonResponse
    {
        $calculation->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
