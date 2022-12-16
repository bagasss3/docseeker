<?php

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

Route::get('/profile/orders', [UserController::class, 'showOrder'])->middleware(
    'auth'
);

Route::get('/profile/orders/{id}', [
    UserController::class,
    'detailOrder',
])->middleware('auth');

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

// Route::get('/cost-ongkir', [CheckOngkirController::class, 'check_ongkir']);

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

Route::put('/admin/orders', [AdminController::class, 'showOrderAsAdmin'])
    ->name('admin.showOrderAsAdmin')
    ->middleware(['auth:admin', 'is_admin']);

Route::put('/admin/orders/{id}', [AdminController::class, 'editStatusOrder'])
    ->name('admin.editStatusOrder')
    ->middleware(['auth:admin', 'is_admin']);

//Payment Route
Route::post("/transaction", [PaymentController::class, 'show']);
Route::delete("/transaction", [PaymentController::class, 'deleteToken']);
Route::post('/transaction/midtrans-notification', [
    PaymentCallbackController::class,
    'receive',
]);

Route::get('/weight', function (Request $request) {
    $products = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->where('user_id', $request->user()->id)
        ->get([
            'cart.*',
            'products.product_title',
            'products.product_cat',
            'products.product_harga',
            'products.weight',
        ]);
    $total = 0;
    foreach ($products as $product) {
        $total += $product->weight * $product->qty;
    }
    return $total;
});

Route::get('/cost-ongkir', function (Request $request) {
    $curl = curl_init();
    $origin = "11";
    $destination = $request->get('destination');
    $weight = $request->get('weight');
    $courier = $request->get('courier');

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>
        "origin=" .
            $origin .
            "&destination=" .
            $destination .
            "&weight=" .
            $weight .
            "&courier=" .
            $courier,
        // CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "key:2d4b91321f678b4462e99881e449e426",
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $products = Cart::join(
            'products',
            'cart.product_id',
            '=',
            'products.id'
        )
            ->where('user_id', $request->user()->id)
            ->get([
                'cart.*',
                'products.product_title',
                'products.product_cat',
                'products.product_harga',
                'products.weight',
            ]);

        $total = 0;
        foreach ($products as $product) {
            $total += $product->product_harga * $product->qty;
        }

        return [
            "total_harga" => $total,
            "raja_ongkir" => json_decode($response),
        ];
    }
});

Route::get('/total-cost', function (Request $request) {
    $products = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->where('user_id', $request->user()->id)
        ->get([
            'cart.*',
            'products.product_title',
            'products.product_cat',
            'products.product_harga',
            'products.weight',
        ]);

    $total = 0;
    foreach ($products as $product) {
        $total += $product->product_harga * $product->qty;
    }

    return $total;
});

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

// detail order
Route::get('/detail-order', function () {
    return view('detail-order', [
        'title' => 'ORDER DETAIL',
    ]);
})->name('detail-order');
