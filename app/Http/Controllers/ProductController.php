<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $category = request('category');
        switch ($category) {
            case "shoes":
                $products = Products::where('product_cat', "0")
                    ->latest()
                    ->simplePaginate(6)
                    ->withQueryString();
                break;
            case "bags":
                $products = Products::where('product_cat', "1")
                    ->latest()
                    ->simplePaginate(6)
                    ->withQueryString();
                break;
            case "glasses":
                $products = Products::where('product_cat', "2")
                    ->latest()
                    ->simplePaginate(6)
                    ->withQueryString();
                break;
            case "men":
                $products = Products::where('product_gender', "1")
                    ->latest()
                    ->simplePaginate(6)
                    ->withQueryString();
                break;
            default:
                $products = Products::where('product_gender', "0")
                    ->latest()
                    ->simplePaginate(6)
                    ->withQueryString();
                break;
        }
        return view('item', [
            'title' => $category,
            'data' => $products,
        ]);
    }

    public function show($id, Products $product, Request $request)
    {
        if (!$request->user()) {
            $product = $product->find($id);
            $images = Image::where('product_id', $product->id)->get();
            return view('selected-item', [
                'title' => 'SELECTED ITEM',
                'data' => $product->find($id),
                'image1' => $images[0]->image,
                'image2' => $images[1]->image,
                'is_edit' => false,
            ]);
        }

        $existProduct = Cart::join(
            'products',
            'cart.product_id',
            '=',
            'products.id'
        )
            ->where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->first();

        if ($existProduct) {
            $images = Image::where('product_id', $existProduct->id)->get();
            return view('selected-item', [
                'title' => 'Edit Item',
                'data' => $existProduct,
                'image1' => $images[0]->image,
                'image2' => $images[1]->image,
                'is_edit' => true,
            ]);
        }
        $product = $product->find($id);
        $images = Image::where('product_id', $product->id)->get();
        return view('selected-item', [
            'title' => 'SELECTED ITEM',
            'data' => $product,
            'image1' => $images[0]->image,
            'image2' => $images[1]->image,
            'is_edit' => false,
        ]);
    }

    public function store(Request $request)
    {
    }
}
