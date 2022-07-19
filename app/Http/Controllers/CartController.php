<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $products = Cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('user_id', $request->user()->id)
            ->get(['cart.*', 'products.product_title', 'products.product_cat', 'products.product_harga']);

        return view('shopping-cart', [
            'title' => 'YOUR SHOPPING CART',
            'data' => $products
        ]);
    }

    public function store($id, Request $request)
    {
        //Validating input
        $request->validate(
            [
                'qty' => 'required',
            ],
            [
                'qty.required' => 'Quantity harus diisi',
            ]
        );

        $product = Products::find($id);
        //dd($product);
        if (!$product) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak ditemukan"
            ]);
        }

        //add data to arr
        $data = [
            'user_id' => $request->user()->id,
            'product_id' => $id,
            'qty' => $request->qty,
        ];

        $existProduct = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();
        if ($existProduct) {
            //dd($existProduct);
            $existProduct->qty += $request->qty;
            $existProduct->save();
            return redirect()->intended('/shopping-cart');
        }
        $store = Cart::create($data);
        if (!$store) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak berhasil disimpan"
            ]);
        }
        return redirect()->intended('/shopping-cart');
    }

    public function update($id, Request $request)
    {
        //Validating input
        $request->validate(
            [
                'qty' => 'required',
            ],
            [
                'qty.required' => 'Quantity harus diisi',
            ]
        );

        $product = Products::find($id);
        //dd($product);
        if (!$product) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak ditemukan"
            ]);
        }

        $existProduct = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        //dd($existProduct);
        $existProduct->qty = $request->qty;
        $existProduct->save();
        return redirect()->intended('/shopping-cart');
    }

    public function delete($id, Request $request)
    {
        $product = Products::find($id);
        //dd($product);
        if (!$product) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak ditemukan"
            ]);
        }

        $existProduct = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        $existProduct->delete();
        return redirect(route('cart.index'));
    }
}
