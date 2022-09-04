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

//Auth Route
Route::get('/login', function () {
    return view('login', [
        'title' => 'LOGIN PAGE',
    ]);
})
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->name(
    'authenticate'
);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout')
    ->middleware('auth');

Route::get("/admin/login", function () {
    return view('dashboard.login-admin', [
        'title' => 'login',
        "active_link" => "/admin/login",
    ]);
});

Route::post('/admin/login', [AuthController::class, 'authenticateAdmin'])->name(
    'authenticateAdmin'
);
Route::post('/admin/logout', [AuthController::class, 'logoutAdmin'])
    ->name('auth.logoutAdmin')
    ->middleware('auth:admin', 'is_admin');

//User Route
Route::get('/', function () {
    return view('index', [
        'title' => 'HOMEPAGE',
    ]);
})->name('main');

Route::get('/register', function () {
    return view('register', [
        'title' => 'REGISTER PAGE',
    ]);
})->middleware('guest');

Route::post('/register', [UserController::class, 'store'])->name('user.store');

Route::get('/profile', [UserController::class, 'show'])->middleware('auth');

//Payment Route
Route::get('/checkout', [PaymentController::class, 'index'])->middleware(
    'auth'
);

//Ongkir Route
Route::get('/cities/{id}', [CheckOngkirController::class, 'getCities']);

Route::get('/cost-ongkir', [CheckOngkirController::class, 'check_ongkir']);

//Product Route
Route::get('/product', [ProductController::class, 'index'])->name(
    'product.index'
);
Route::get('/product/{id}', [ProductController::class, 'show'])->name(
    'product.show'
);

//Cart Route
Route::post('/shopping-cart/{id}', [CartController::class, 'store'])
    ->name('cart.store')
    ->middleware('auth');

Route::put('/shopping-cart/{id}', [CartController::class, 'update'])
    ->name('cart.update')
    ->middleware('auth');

Route::get('/shopping-cart', [CartController::class, 'index'])
    ->name('cart.index')
    ->middleware('auth');

Route::delete('/shopping-cart/{id}', [CartController::class, 'delete'])
    ->name('cart.delete')
    ->middleware('auth');

//Admin Route
Route::post('/admin/product', [AdminController::class, 'store'])->middleware([
    'auth:admin',
    'is_admin',
]);

Route::post('/create-admin', [AdminController::class, 'create']);

Route::put('/admin/product/{id}', [AdminController::class, 'update'])
    ->name('admin.update')
    ->middleware(['auth:admin', 'is_admin']);

Route::delete('/admin/product/{id}', [
    AdminController::class,
    'delete',
])->middleware(['auth:admin', 'is_admin']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth:admin', 'is_admin'])
    ->name("dashboard");

Route::get('/admin/product', [AdminController::class, 'index'])->middleware([
    'auth:admin',
    'is_admin',
]);

Route::get('/admin/product/{id}', [AdminController::class, 'show'])
    ->name('admin.show')
    ->middleware(['auth:admin', 'is_admin']);

Route::get("/admin/profile", function () {
    return view('dashboard.profile', [
        'title' => 'Profile',
        "active_link" => "/admin/profile",
    ]);
})->middleware(['auth:admin', 'is_admin']);

Route::get("/admin/update", function () {
    return view('dashboard.update-produk', [
        'title' => 'update produk',
        "active_link" => "/admin/update-product",
    ]);
})->middleware(['auth:admin', 'is_admin']);
