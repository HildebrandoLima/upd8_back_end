<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RepresentativeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('client')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{id}', [ClientController::class, 'show']);
    Route::post('/create', [ClientController::class, 'store']);
    Route::put('/update', [ClientController::class, 'update']);
    Route::delete('/delete/{id}', [ClientController::class, 'destroy']);
});

Route::prefix('representative')->group(function () {
    Route::get('/', [RepresentativeController::class, 'index']);
    Route::get('/{id}', [RepresentativeController::class, 'show']);
    Route::post('/create', [RepresentativeController::class, 'store']);
    Route::put('/update', [RepresentativeController::class, 'update']);
    Route::delete('/delete/{id}', [RepresentativeController::class, 'destroy']);
});
