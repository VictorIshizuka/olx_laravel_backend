<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function (): JsonResponse {
    return  response()->json(['Pong' => true]);
});

Route::get('/states', [StatesController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/advertises', [StatesController::class, 'index']);
Route::get('/users', [StatesController::class, 'index']);



Route::post('/users/signup', [UserController::class, 'signup']);
// ->withoutMiddleware(VerifyCsrfToken::class);
Route::post('/users/signin', [UserController::class, 'signin']);
Route::get('/users/me', [UserController::class, 'me'])->middleware('auth:sanctum');
