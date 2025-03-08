<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 認証ルート
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);


// ユーザー管理のルート
Route::middleware('auth:sanctum')->get('/user',[UserController::class,'getUser']);
Route::middleware('auth:sanctum')->put('/user',[UserController::class,'updateUser']);
Route::middleware('auth:sanctum')->delete('/user',[UserController::class,'destroyUser']);


// タスク管理のルート
Route::middleware('auth:sanctum')->get('/tasks', [TaskController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tasks/{taskId}', [TaskController::class, 'store']);
Route::middleware('auth:sanctum')->put('/tasks/{taskId}',[TaskController::class,'update']);
Route::middleware('auth:sanctum')->delete('/tasks/{taskId}',[TaskController::class,'destroy']);

