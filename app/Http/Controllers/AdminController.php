<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Products;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.crudProduct', [
            'title' => 'Product',
            "products" => Products::all(),
            "active_link" => "/admin/product",
        ]);
    }

    public function dashboard()
    {
        return view('dashboard.main', [
            'title' => 'Dashboard',
            "products" => Products::all(),
            "active_link" => "/admin/dashboard",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:100',
                'password' => 'required|max:20',
            ],
            [
                'name.required' => 'First name harus diisi',
                'name.min' => 'Minimal 3 karakter',
                'name.max' => 'Maksimal 100 karakter',
                'password.required' => 'Password harus diisi',
                'password.max' => 'Password Maksimal 20 karakter',
            ]
        );

        $data = [
            'role_id' => 1,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];
        $store = Admin::create($data);

        if (!$store) {
            return response()->json([
                'success' => false,
                'msg' => "Admin tidak berhasil disimpan",
            ]);
        }
        return response()->json([
            'success' => true,
            'msg' => "Admin berhasil dibuat",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                // 'product_image' => 'required',
                'stock' => 'required',
            ],
            [
                'product_cat' => 'Product_cat harus diisi',
                'product_gender' => 'Product_gender harus diisi',
                'product_brand' => 'Product_brand harus diisi',
                'product_title' => 'Product_title harus diisi',
                'product_harga' => 'Product_harga harus diisi',
                // 'product_image' => 'Product_image harus diisi',
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
            'product_image' => "default",
            'product_desc' => $request->product_desc,
            'stock' => $request->stock,
        ];

        $store = Products::create($data);
        if (!$store) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak berhasil disimpan",
            ]);
        }
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Products $product)
    {
        //Validating input
        $request->validate(
            [
                'product_cat' => 'in:0,1,2',
                'product_gender' => 'in:0,1',
                'product_brand' => 'required',
                'product_title' => 'required',
                'product_harga' => 'required',
                // 'product_image' => 'required',
                'stock' => 'required',
            ],
            [
                'product_cat' => 'Product_cat harus diisi',
                'product_gender' => 'Product_gender harus diisi',
                'product_brand' => 'Product_brand harus diisi',
                'product_title' => 'Product_title harus diisi',
                'product_harga' => 'Product_harga harus diisi',
                // 'product_image' => 'Product_image harus diisi',
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
            // 'product_image' => $request->product_image,
            'product_desc' => $request->product_desc,
            'stock' => $request->stock,
        ];

        if (!$product::find($id)->update($data)) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak berhasil disimpan",
            ]);
        }
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $product = Products::find($id);
        //dd($product);
        if (!$product) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak ditemukan",
            ]);
        }

        if (!$product->delete()) {
            return response()->json([
                'success' => false,
                'msg' => "Data gagal didelete",
            ]);
        }
        return redirect('/admin/product');
    }
}