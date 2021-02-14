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

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controls\PageController as ControlsPageController;

Route::get('/', [PageController::class, 'home']);


// == not logged in ==
// page
// products
// products/search
// users
// carts/index

// == logged in ==
// orders
// profile
// carts/purchase

// == admin ==
// controls/page
// controls/products
// controls/orders
// controls/brands
// controls/categories
// controls/users
// controls/carts
Route::prefix('controls')->name('controls.')->middleware(['auth'])->group(function () {
    Route::get('/', [ControlsPageController::class, 'home'])->name('home');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
