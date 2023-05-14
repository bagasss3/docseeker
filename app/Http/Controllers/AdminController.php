<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Products;
use App\Http\Controllers\ImageController;
use App\Models\Address;
use App\Models\Image;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\User;
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
            'user' => Auth::guard('admin')->user(),
            "products" => Products::latest()->get(),
            "active_link" => "/admin/product",
        ]);
    }

    public function dashboard()
    {
        // return response()->json([
        //     'success' => true,
        //     'data' => Products::all()->count(),
        // ]);
        return view('dashboard.main', [
            'user' => Auth::guard('admin')->user(),
            'title' => 'Dashboard',
            "products" => Products::all()->count(),
            "users" => User::all()->count(),
            "ordersNow" => Orders::all()
                ->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
                ->count(),
            "Income" => Payments::where('payment_status', '=', 2)->sum(
                'total_price'
            ),
            "active_link" => "/admin/dashboard",
        ]);
    }

    public function profile()
    {
        return view('dashboard.profile', [
            'title' => 'Profile',
            'user' => Auth::guard('admin')->user(),
            "active_link" => "/admin/profile",
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
                'product_cat' => 'required|in:0,1,2',
                'product_gender' => 'required|in:0,1',
                'product_brand' => 'required',
                'product_title' => 'required',
                'product_harga' => 'required',
                'image' => 'required',
                'stock' => 'required',
                'weight' => 'required',
            ],
            [
                'product_cat.required' => 'Product_cat harus diisi',
                'product_cat.in' => 'Product_cat kategori 0,1,2',
                'product_gender.required' => 'Product_gender harus diisi',
                'product_gender.in' => 'Product_gender kategori 0,1',
                'product_brand.required' => 'Product_brand harus diisi',
                'product_title.required' => 'Product_title harus diisi',
                'product_harga.required' => 'Product_harga harus diisi',
                'image.required' => 'image harus diisi',
                'stock.required' => 'Stock harus diisi',
                'weight.required' => 'weight harus diisi',
            ]
        );

        $productCustomId = custom_id('products');
        //add data to arr
        $data = [
            'custom_id' => $productCustomId,
            'product_cat' => $request->product_cat,
            'product_gender' => $request->product_gender,
            'product_brand' => $request->product_brand,
            'product_title' => $request->product_title,
            'product_harga' => $request->product_harga,
            'product_desc' => $request->product_desc,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ];

        $store = Products::create($data);
        if (!$store) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menyimpan product',
            ]);
        }
        $cloudinary = ImageController::store(
            $request->file('image'),
            $store->id
        );
        if (!$cloudinary) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menyimpan product',
            ]);
        }

        return back()->with([
            'success' => 'Berhasil menyimpan product baru',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Products $product)
    {
        $category = [
            (object) ["id" => 0, "name" => "Shoes"],
            (object) ["id" => 1, "name" => "Glasses"],
            (object) ["id" => 2, "name" => "Bags"],
        ];
        $gender = [
            (object) ["id" => 0, "name" => "Women"],
            (object) ["id" => 1, "name" => "Men"],
        ];
        $findProduct = $product->where('custom_id', $id)->first();
        if (!$findProduct) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mencari product',
            ]);
        }
        $findImageProduct = Image::where('product_id', $findProduct->id)->get();
        if (!$findImageProduct) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mencari product',
            ]);
        }
        return view('dashboard.update-produk', [
            'title' => 'Update Product #' . $id,
            'user' => Auth::guard('admin')->user(),
            'product' => $findProduct,
            'category' => $category,
            'gender' => $gender,
            'image1' => $findImageProduct[0],
            'image2' => $findImageProduct[1],
            "active_link" => "/admin/product",
        ]);
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
                'weight' => 'required',
            ],
            [
                'product_cat' => 'Product_cat harus diisi',
                'product_gender' => 'Product_gender harus diisi',
                'product_brand' => 'Product_brand harus diisi',
                'product_title' => 'Product_title harus diisi',
                'product_harga' => 'Product_harga harus diisi',
                // 'product_image' => 'Product_image harus diisi',
                'stock' => 'Stock harus diisi',
                'weight' => 'weight harus diisi',
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
            'weight' => $request->weight,
        ];

        if (!$product::find($id)->update($data)) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menyimpan product',
            ]);
        }
        return back()->with([
            'success' => 'Berhasil mengupdate product',
        ]);
    }

    public function updatePicture1(Request $request, $id)
    {
        //add data to arr
        $prodImage = Image::find($id);
        $cloudinary = ImageController::update(
            $request->file('image1'),
            $prodImage
        );
        if (!$cloudinary) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat merubah gambar product',
            ]);
        }

        return back()->with([
            'success' => 'Berhasil mengupdate gambar pertama product',
        ]);
    }

    public function updatePicture2(Request $request, $id)
    {
        //add data to arr
        $prodImage = Image::find($id);
        $cloudinary = ImageController::update(
            $request->file('image2'),
            $prodImage
        );
        if (!$cloudinary) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat merubah gambar product',
            ]);
        }

        return back()->with([
            'success' => 'Berhasil mengupdate gambar kedua product',
        ]);
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
            return back()->with([
                'info' => 'Terjadi kesalahan saat menghapus product',
            ]);
        }

        if (!$product->delete()) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menghapus product',
            ]);
        }
        return back()->with([
            'success' => 'Berhasil menghapus product',
        ]);
    }

    public function showOrderAsAdmin(Request $request)
    {
        $query = Orders::join(
            'transaction',
            'transaction.orders_id',
            '=',
            'orders.id'
        )
            ->join(
                'transaction_detail',
                'transaction.transaction_detail_id',
                '=',
                'transaction_detail.id'
            )
            ->join(
                'addresses',
                'transaction_detail.addresses_id',
                '=',
                'addresses.id'
            )
            ->join(
                'payments',
                'transaction_detail.payment_id',
                '=',
                'payments.id'
            )
            ->select(
                'orders.id',
                'orders.custom_id',
                'orders.status',
                'payments.custom_id as payment_id',
                'payments.total_price',
                'payments.payment_status',
                'payments.created_at',
                'addresses.email'
            )
            ->groupBy([
                'orders.id',
                'orders.custom_id',
                'orders.status',
                'payments.custom_id',
                'payments.total_price',
                'payments.payment_status',
                'payments.created_at',
                'addresses.email',
            ]);
        if (
            $request->input('fromDate') !== null &&
            $request->input('toDate') !== null
        ) {
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');
            // Filter orders by date range
            $query->whereBetween('payments.created_at', [$fromDate, $toDate]);
        }

        $orders = $query->get();
        return view('dashboard.status-pemesanan', [
            'title' => 'Status Pemesanan',
            'user' => Auth::guard('admin')->user(),
            'success' => true,
            'data' => $orders,
            "active_link" => "/admin/orders",
        ]);
    }

    public function showDetailAsAdmin($id, Request $request)
    {
        $status = [
            (object) ["status" => "Accepted"],
            (object) ["status" => "Send"],
            (object) ["status" => "Canceled"],
            (object) ["status" => "Returned"],
            (object) ["status" => "Packed"],
            (object) ["status" => "Finished"],
        ];
        $getIdByCustomId = Orders::where('custom_id', $id)->first();
        $order = Orders::join(
            'transaction',
            'orders.id',
            '=',
            'transaction.orders_id'
        )
            ->where([
                'orders.id' => $getIdByCustomId->id,
            ])
            ->join(
                'transaction_detail',
                'transaction.transaction_detail_id',
                '=',
                'transaction_detail.id'
            )
            ->join('products', 'transaction.product_id', '=', 'products.id')
            ->get([
                'orders.id',
                'orders.custom_id',
                'orders.status',
                'orders.resi',
                'transaction.product_id',
                'products.product_title',
                'products.deleted_at',
                'transaction.qty',
                'products.product_harga',
                'transaction.transaction_detail_id',
            ]);
        if (!$order) {
            return back()->with([
                'info' => 'Data order tidak ditemukan',
            ]);
        }

        $transactionDetail = Transaction_Detail::find(
            $order[0]->transaction_detail_id
        );
        $addresses = Address::find($transactionDetail->addresses_id);
        $payment = Payments::find($transactionDetail->payment_id);

        return view('dashboard.detail-order', [
            'title' => 'Detail Order #' . $order[0]->custom_id,
            'data' => $order,
            'buyer' => $addresses,
            'payment' => $payment,
            'total' => 0,
            'status' => $status,
            'user' => Auth::guard('admin')->user(),
            "active_link" => "/admin/orders",
        ]);
    }

    public function editStatusOrder($id, Request $request, Orders $orders)
    {
        $request->validate(
            [
                'status' =>
                    'in:Accepted,Send,Canceled,Returned,Packed,Finished',
            ],
            [
                'status' => 'Status tidak ada pada pilihan',
            ]
        );

        $data = [
            'status' => $request->status,
            'resi' => $request->resi,
            'updated_by' => Auth::user()->id,
        ];

        if (!$orders::find($id)->update($data)) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mengupdate status order',
            ]);
        }
        return back()->with([
            'success' => 'Berhasil mengupdate status pemesanan',
        ]);
    }
}
