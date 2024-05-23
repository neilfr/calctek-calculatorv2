<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use App\Models\Calculation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyAllController extends Controller
{

    public function __invoke(Request $request)
    {
        Calculation::truncate();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
