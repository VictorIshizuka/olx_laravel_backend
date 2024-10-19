<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class Controller
{
    public function index(Request $r): JsonResponse
    {
        $states = State::all();
        return response()->json(['data' => $states]);
    }
}
