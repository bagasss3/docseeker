<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('user_id', $request->user()->id)
            ->get(['cart.*', 'products.product_title', 'products.product_cat', 'products.product_harga']);

        return view('checkout', [
            'title' => 'Your Order',
            'data' => $products
        ]);
    }
}
