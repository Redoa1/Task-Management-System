<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:sanctum')->get('/tasks', [TaskController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tasks', [TaskController::class, 'store']);
Route::middleware('auth:sanctum')->put('/tasks/{task}', [TaskController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/tasks/{task}', [TaskController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
