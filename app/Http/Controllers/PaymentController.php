<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Province;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('user_id', $request->user()->id)
            ->get(['cart.*', 'products.product_title', 'products.product_cat', 'products.product_harga']);
        $province = Province::pluck('name','province_id');
        return view('checkout', [
            'title' => 'Your Order',
            'data' => $products,
            'province'=>$province,
        ]);
    }
}
