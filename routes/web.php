<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {
    return view('index', [
        'title' => 'HOMEPAGE'
    ]);
});

Route::get('/login', function () {
    return view('login', [
        'title' => 'LOGIN PAGE'
    ]);
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('register', [
        'title' => 'REGISTER PAGE'
    ]);
})->middleware('guest');

Route::get('/checkout', [PaymentController::class, 'index'])->middleware('auth');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/register', [UserController::class, 'store'])->name('user.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::post('/shopping-cart/{id}', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::get('/shopping-cart', [CartController::class, 'index'])->middleware('auth');
