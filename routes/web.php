<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckOngkirController;
use App\Models\Products;

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

Route::get('/profile', [UserController::class, 'show'])->middleware('auth');
Route::get('/checkout', [PaymentController::class, 'index'])->middleware('auth');
Route::get('/cities/{id}', [CheckOngkirController::class, 'getCities']);
Route::get('/cost-ongkir', [CheckOngkirController::class, 'check_ongkir']);

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/register', [UserController::class, 'store'])->name('user.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::post('/shopping-cart/{id}', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::put('/shopping-cart/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::get('/shopping-cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::delete('/shopping-cart/{id}', [CartController::class, 'delete'])->name('cart.delete')->middleware('auth');

Route::post('/login-admin', [AuthController::class, 'authenticateAdmin'])->name('authenticateAdmin');
Route::post('/admin-product', [AdminController::class, 'store'])->middleware(['auth', 'is_admin']);
Route::post('/create-admin', [AdminController::class, 'create']);
Route::put('/admin-product/{id}', [AdminController::class, 'update'])->middleware(['auth', 'is_admin']);
Route::delete('/admin-product/{id}', [AdminController::class, 'delete'])->middleware(['auth', 'is_admin']);
Route::get('/admin-product', [AdminController::class, 'index']); //->middleware(['auth','is_admin']);
Route::get('/admin-product/{id}', [AdminController::class, 'show'])->middleware(['auth', 'is_admin']);


// NEW
Route::get('/dashboard', function () {
    return view('dashboard.main', [
        'title' => 'Dashboard',
        "products" => Products::all(),
        "active_link" => "/dashboard",
    ]);
});

Route::get("/dashboard/product", function () {
    return view('dashboard.crudProduct', [
        'title' => 'Product',
        "products" => Products::all(),
        "active_link" => "/dashboard/product",
    ]);
});
Route::get("/dashboard/profile", function () {
    return view('dashboard.profile', [
        'title' => 'Profile',
        "active_link" => "/dashboard/profile",
    ]);
});
