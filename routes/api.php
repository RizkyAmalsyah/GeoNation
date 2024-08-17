<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//negara
Route::apiResource('/negara', App\Http\Controllers\Api\NegaraController::class);
