<?php
use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\PassengerController;
use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('airports', AirportController::class);
    Route::apiResource('flights', FlightController::class);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('passengers', PassengerController::class);
});