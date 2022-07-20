<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $category = request('category');
        switch ($category) {
            case "shoes":
                $products = Products::where('product_cat', "0")->latest()->get();
                break;
            case "bags":
                $products = Products::where('product_cat', "1")->latest()->get();
                break;
            case "glasses":
                $products = Products::where('product_cat', "2")->latest()->get();
                break;
            case "men":
                $products = Products::where('product_gender', "0")->latest()->get();
                break;
            default:
                $products = Products::where('product_gender', "1")->latest()->get();
        }

        return view('item', [
            'title' => $category,
            'data' => $products,
        ]);
    }

    public function show($id, Products $product, Request $request)
    {
        if (!$request->user()) {
            return view('selected-item', [
                'title' => 'SELECTED ITEM',
                'data' => $product->find($id),
                'is_edit' => false
            ]);
        }
        $existProduct = Cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        if ($existProduct) {
            return view('selected-item', [
                'title' => 'Edit Item',
                'data' => $existProduct,
                'is_edit' => true
            ]);
        }
        return view('selected-item', [
            'title' => 'SELECTED ITEM',
            'data' => $product->find($id),
            'is_edit' => false
        ]);
    }

    public function store(Request $request)
    {
        //Validating input
        $request->validate(
            [
                'product_cat' => 'in:0,1,2',
                'product_gender' => 'in:0,1',
                'product_brand' => 'required',
                'product_title' => 'required',
                'product_harga' => 'required',
                'product_image' => 'required',
                'stock' => 'required'
            ],
            [
                'product_cat' => 'Product_cat harus diisi',
                'product_gender' => 'Product_gender harus diisi',
                'product_brand' => 'Product_brand harus diisi',
                'product_title' => 'Product_title harus diisi',
                'product_harga' => 'Product_harga harus diisi',
                'product_image' => 'Product_image harus diisi',
                'stock' => 'Stock harus diisi',
            ]
        );

        //add data to arr
        $data = [
            'product_cat' => $request->product_cat,
            'product_gender' => $request->product_gender,
            'product_brand' => $request->product_brand,
            'product_title' => $request->product_title,
            'product_harga' => $request->product_harga,
            'product_image' => $request->product_image,
            'product_desc' => $request->product_desc,
            'stock' => $request->stock,
        ];

        $store = Products::create($data);
        if (!$store) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak berhasil disimpan"
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
