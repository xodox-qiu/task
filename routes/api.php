<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController as ApiTaskController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\API\ServisController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('servis', ServisController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource("/tasks", ApiTaskController::class);
});

Route::post("/login", [LoginController::class, "login"]);
Route::post("/logout", [LoginController::class, "logout"]);