<?php
use App\Http\Controllers\Api\CaseFileController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\FolderController;
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
    Route::apiResource('case_files',CaseFileController::class);
    Route::apiResource('folders',FolderController::class);
    Route::apiResource('files',FileController::class);
});