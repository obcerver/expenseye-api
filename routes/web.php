<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::prefix('category')->group(function () {
//     Route::get('/', [CategoryController::class, 'index']);
//     Route::get('/create', [CategoryController::class, 'create']);
//     Route::post('/', [CategoryController::class, 'store']);
//     Route::get('/{category}', [CategoryController::class, 'show']);
//     Route::get('/{category}/edit', [CategoryController::class, 'edit']);
//     Route::put('/{category}', [CategoryController::class, 'update']);
//     Route::delete('/{category}', [CategoryController::class, 'destroy']);
// });

// Route::prefix('expense')->group(function () {
//     Route::get('/', [ExpenseController::class, 'index']);
//     Route::get('/create', [ExpenseController::class, 'create']);
//     Route::post('/', [ExpenseController::class, 'store']);
//     Route::get('/{expense}', [ExpenseController::class, 'show']);
//     Route::get('/{expense}/edit', [ExpenseController::class, 'edit']);
//     Route::put('/{expense}', [ExpenseController::class, 'update']);
//     Route::delete('/{expense}', [ExpenseController::class, 'destroy']);
// });