<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/login/verify', [LoginController::class, 'verify']);

Route::group(["middlewere" => "auth:sanctum"], function(){

    Route::get('/user', function() {
        return $this->user();
    });

    Route::get('/driver', [DriverController::class, 'show']);
    Route::post('/driver/update', [DriverController::class, 'update']);

});

