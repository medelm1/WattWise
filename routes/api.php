<?php

use App\Http\Controllers\ApplianceController;
use Illuminate\Support\Facades\Route;

Route::get('/appliances', [ApplianceController::class, 'index']);
Route::get('/appliances/{id}', [ApplianceController::class, 'show']);
Route::post('/appliances', [ApplianceController::class, 'store']);
Route::put('/appliances/{id}', [ApplianceController::class, 'update']);
Route::delete('/appliances/{id}', [ApplianceController::class, 'destroy']);