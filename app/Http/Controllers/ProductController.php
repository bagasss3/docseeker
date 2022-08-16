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
        
    }
}
