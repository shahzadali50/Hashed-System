<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LeadApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('leads', [LeadApiController::class, 'leads']);
    Route::post('leads', [LeadApiController::class, 'store']);
    Route::get('leads/{id}', [LeadApiController::class, 'show']);
    Route::put('leads/{id}', [LeadApiController::class, 'update']);
    Route::delete('leads/{id}', [LeadApiController::class, 'destroy']);
});

