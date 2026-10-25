<?php
use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/airports', [AirportController::class, 'index']);
    Route::get('/flights', [FlightController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);
});