<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;

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

Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

Route::post('auth/register', [AuthController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'loginUser']);

