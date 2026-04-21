<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:api')->group(function(){
    Route::get('me',[AuthController::class,'me']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);

    Route::apiResource('roles',RoleController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('customers',CustomerController::class);
});