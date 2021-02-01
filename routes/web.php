<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', [PageController::class, 'index']);
Route::get('/shopping', [PageController::class, 'shopping']);
Route::get('/test', [PageController::class, 'test']);

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);