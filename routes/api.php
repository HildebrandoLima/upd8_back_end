<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RepresentativeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cities', [CityController::class, 'index'])->name('cities');

Route::prefix('client')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.all');
    Route::get('/find', [ClientController::class, 'show'])->name('client.find');
    Route::post('/create', [ClientController::class, 'store'])->name('client.create');
    Route::put('/update', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/delete', [ClientController::class, 'destroy'])->name('client.delete');
});

Route::prefix('representative')->group(function () {
    Route::get('/', [RepresentativeController::class, 'index'])->name('representative.all');
    Route::get('/{id}', [RepresentativeController::class, 'show'])->name('representative.find');
    Route::post('/create', [RepresentativeController::class, 'store'])->name('representative.create');
    Route::put('/update', [RepresentativeController::class, 'update'])->name('representative.update');
    Route::delete('/delete/{id}', [RepresentativeController::class, 'destroy'])->name('representative.delete');
});
