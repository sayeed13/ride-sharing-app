<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/login/verify', [LoginController::class, 'verify']);

Route::group(["middlewere" => "auth:sanctum"], function(){

    Route::get('/user', function() {
        return $this->user();
    });
    
});

