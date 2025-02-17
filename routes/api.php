<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class);
Route::middleware('auth:sanctum')->get('user/categories', [CategoryController::class, 'user']);
 

Route::apiResource('expenses', ExpenseController::class);
Route::middleware('auth:sanctum')->get('user/expenses', [ExpenseController::class, 'user']);

Route::get('expenses/category/{category}', [ExpenseController::class, 'category']);
 
Route::get('/check', [AuthController::class, 'check']);
Route::apiResource('users', UserController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

