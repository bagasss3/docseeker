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
        $products = Cart::with(['images'])
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('user_id', $request->user()->id)
            ->get([
                'cart.*',
                'products.product_title',
                'products.product_cat',
                'products.product_harga',
                'products.weight',
            ]);

        if (!$products) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mengambil data product',
            ]);
        }
        return view('shopping-cart', [
            'title' => 'YOUR SHOPPING CART',
            'data' => $products,
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
            return back()->with([
                'info' => 'Data product tidak ditemukan',
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
            return back()->with([
                'info' => 'Terjadi kesalahan saat menyimpan product',
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
            return back()->with([
                'info' => 'Data product tidak ditemukan',
            ]);
        }

        $existProduct = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        if (!$existProduct) {
            return back()->with([
                'info' => 'Data product tidak ditemukan',
            ]);
        }
        //dd($existProduct);
        $existProduct->qty = $request->qty;
        if (!$existProduct->save()) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mengupdate jumlah roduct',
            ]);
        }
        return redirect()->intended('/shopping-cart');
    }

    public function delete($id, Request $request)
    {
        $product = Products::find($id);
        //dd($product);
        if (!$product) {
            return back()->with([
                'info' => 'Data product tidak ditemukan',
            ]);
        }

        $existProduct = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        if (!$existProduct) {
            return back()->with([
                'info' => 'Data product tidak ditemukan',
            ]);
        }

        if (!$existProduct->delete()) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menghapus product',
            ]);
        }
        return redirect(route('cart.index'));
    }
}
