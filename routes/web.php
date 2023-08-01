<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Log;

use App\Models\Products;

use Illuminate\Http\Request;
use App\Models\Cart;

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

Route::post('/profile/orders', [
    UserController::class,
    'showOrder',
])->middleware('auth');

Route::get('/profile/orders/{id}', [UserController::class, 'detailOrder'])
    ->name('user.detailOrder')
    ->middleware('auth');

Route::put('/profile/orders/{id}', [
    UserController::class,
    'editOrder',
])->middleware('auth');

//Payment Route
Route::get('/checkout', [PaymentController::class, 'index'])->middleware(
    'auth'
);
Route::post('/email', [PaymentController::class, 'testEmail']);

//Ongkir Route
Route::get('/cities/{id}', [CheckOngkirController::class, 'getCities']);
Route::get('/province', [CheckOngkirController::class, 'getProvince']);

Route::get('/cost-ongkir', [CheckOngkirController::class, 'check_ongkir']);

//Product Route
Route::get('/product', [ProductController::class, 'index'])->name(
    'product.index'
);
Route::get('/search', [ProductController::class, 'search'])->name(
    'product.search'
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

Route::delete('/admin/product/{id}', [AdminController::class, 'delete'])
    ->name('admin.delete')
    ->middleware(['auth:admin', 'is_admin']);

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

Route::get("/admin/profile", [AdminController::class, 'profile'])->middleware([
    'auth:admin',
    'is_admin',
]);

Route::put('/admin/product/image/{id}', [
    AdminController::class,
    'updatePicture1',
])
    ->name('admin.updatePicture1')
    ->middleware(['auth:admin', 'is_admin']);

Route::put('/admin/product/image2/{id}', [
    AdminController::class,
    'updatePicture2',
])
    ->name('admin.updatePicture2')
    ->middleware(['auth:admin', 'is_admin']);

Route::get('/admin/orders', [AdminController::class, 'showOrderAsAdmin'])
    ->name('admin.showOrderAsAdmin')
    ->middleware(['auth:admin', 'is_admin']);

Route::get('/admin/orders/{id}', [AdminController::class, 'showDetailAsAdmin'])
    ->name('admin.showDetailAsAdmin')
    ->middleware(['auth:admin', 'is_admin']);

Route::put('/admin/orders/{id}', [AdminController::class, 'editStatusOrder'])
    ->name('admin.editStatusOrder')
    ->middleware(['auth:admin', 'is_admin']);

// Address Route
Route::get('/address', [AddressController::class, 'index'])->name(
    'address.index'
);
Route::get('/create-address', [AddressController::class, 'create'])
    ->name('address.create')
    ->middleware('auth');
Route::post('/address', [AddressController::class, 'store'])
    ->name('address.store')
    ->middleware('auth');
Route::get('/address/{id}', [AddressController::class, 'show'])
    ->name('address.show')
    ->middleware('auth');
Route::put('/address/{id}', [AddressController::class, 'update'])
    ->name('address.update')
    ->middleware('auth');
Route::put('/address/active/{id}', [AddressController::class, 'edit'])
    ->name('address.active')
    ->middleware('auth');
Route::put('/address/nonactive/{id}', [AddressController::class, 'nonactive'])
    ->name('address.nonactive')
    ->middleware('auth');
Route::delete('/address/{id}', [AddressController::class, 'destroy'])
    ->name('address.destroy')
    ->middleware('auth');
//Payment Route
Route::post("/transaction", [PaymentController::class, 'show']);
Route::delete("/transaction", [PaymentController::class, 'deleteToken']);
Route::post('/transaction/midtrans-notification', [
    PaymentCallbackController::class,
    'receive',
]);

// Callback Redirect After Payment Page
Route::get('/payment-success', function () {
    return view('payment-success', [
        'title' => 'PAYMENT SUCCESS PAGE',
    ]);
});
Route::post('/payment-success', function (Request $request) {
    return view('payment-success', [
        'title' => 'PAYMENT SUCCESS PAGE',
    ]);
});
Route::get('/payment-cancel', function () {
    return view('payment-cancel', [
        'title' => 'PAYMENT CANCEL PAGE',
    ]);
});
Route::post('/payment-cancel', function (Request $request) {
    return view('payment-cancel', [
        'title' => 'PAYMENT CANCEL PAGE',
    ]);
});
Route::get('/payment-expired', function () {
    return view('payment-expired', [
        'title' => 'PAYMENT EXPIRED PAGE',
    ]);
});
Route::post('/payment-expired', function (Request $request) {
    return view('payment-expired', [
        'title' => 'PAYMENT EXPIRED PAGE',
    ]);
});

// Image Route
Route::resource('images', ImageController::class);
