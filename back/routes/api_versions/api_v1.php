<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\TypeSpaceController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Routes only admin
    Route::middleware(['role:admin'])->group(function() {
        Route::post('register', [AuthController::class, 'register']);
        Route::apiResource('spaces', SpaceController::class)->except(['create', 'edit']);
        Route::apiResource('types', TypeSpaceController::class)->except(['create', 'edit', 'destroy']);
    });

    // Routes for admin and assistant
    Route::middleware(['role:admin,assistant'])->group(function() {
        Route::get('reservations/status', [ReservationController::class, 'listStatus']);
        Route::apiResource('reservations', ReservationController::class)->except(['create', 'edit']);
    });
    // Routes for admin and assistant and client
    Route::middleware(['role:admin,assistant,client'])->group(function() {
        Route::get('user', function () {
            return auth()->user();
        });
    });
});
