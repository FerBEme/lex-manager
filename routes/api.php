<?php
use App\Http\Controllers\Api\CaseFileController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FileLocationController;
use App\Http\Controllers\Api\FileStatusController;
use App\Http\Controllers\Api\FolderController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:api')->group(function(){
    Route::post('me',[AuthController::class,'me']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::apiResource('roles',RoleController::class);
    Route::apiResource('specialties',SpecialtyController::class);
    Route::apiResource('customer',CustomerController::class);
    Route::apiResource('permissions',PermissionController::class);
    Route::apiResource('file_statuses',FileStatusController::class);
    Route::apiResource('file_locations',FileLocationController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('case_files',CaseFileController::class);
    Route::apiResource('folder',FolderController::class);
});