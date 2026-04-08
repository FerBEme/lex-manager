<?php
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FileLocationController;
use App\Http\Controllers\Api\FileStatusController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
Route::apiResource('roles',RoleController::class);
Route::apiResource('specialties',SpecialtyController::class);
Route::apiResource('customer',CustomerController::class);
Route::apiResource('permissions',PermissionController::class);
Route::apiResource('file_statuses',FileStatusController::class);
Route::apiResource('file_locations',FileLocationController::class);
Route::apiResource('users',UserController::class);