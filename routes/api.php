<?php
use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/airports', [AirportController::class, 'index']);
    Route::post('/airports', [AirportController::class, 'store']);
    Route::delete('/airports/{id}', [AirportController::class, 'destroy']);
    Route::get('/flights', [FlightController::class, 'index']);
    Route::post('/flights', [FlightController::class, 'store']);
    Route::put('/flights/{id}', [FlightController::class, 'update']);
    Route::delete('/flights/{id}', [FlightController::class, 'destroy']);
    Route::post('/tickets', [TicketController::class, 'store']);
});