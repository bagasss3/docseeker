<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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
        'title' => 'Homepage'
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

Route::get('/product', [ProductController::class,'index'])->name('product.index');
Route::post('/product', [ProductController::class,'store']);
Route::get('/product/{id}', [ProductController::class,'show'])->name('product.show');

Route::post('/register', [UserController::class,'store'])->name('user.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout',[AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');