<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payments;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
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

        $province = Province::pluck('name', 'province_id');
        return view('checkout', [
            'title' => 'Your Order',
            'data' => $products,
            'province' => $province,
        ]);
    }

    public function show(Payments $payments, Request $request)
    {
        $snapToken = $payments->snap_token;
        if (empty($snapToken)) {
            $products = Cart::join(
                'products',
                'cart.product_id',
                '=',
                'products.id'
            )
                ->where('user_id', $request->user_id)
                ->get([
                    'cart.*',
                    'products.product_title',
                    'products.product_cat',
                    'products.product_harga',
                    'products.weight',
                ]);
            if (count($products) < 1) {
                return response()->json([
                    'success' => false,
                    'msg' => "Produk kosong",
                ]);
            }
            $order_id = rand();
            $data = [
                'order_id' => $order_id,
                'gross_amount' => (int) $request->gross_amount,
                'ongkir_courier' => $request->ongkir_courier,
                'ongkir_service' => $request->ongkir_service,
                'ongkir_cost' => $request->ongkir_cost,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'postal_code' => $request->zip_code,
                'city' => $request->cities,
                'products' => $products,
            ];

            // Jika snap token masih NULL, buat token snap dan simpan ke database
            $midtrans = new CreateSnapTokenService($data);
            $snapToken = $midtrans->getSnapToken();
            $payments->snap_token = $snapToken;
            $payments->number = $order_id;
            $payments->total_price = (int) $request->gross_amount;
            $payments->save();

            //Save transaction detail
            $data_transaction_detail = [
                'user_id' => 3,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'street_address' => $request->address,
                'zip_code' => $request->zip_code,
                'city' => $request->cities,
                'province' => $request->province,
                'country' => $request->country,
                'payment_id' => $payments->id,
            ];
            $storeTransDetail = Transaction_Detail::create(
                $data_transaction_detail
            );
            if (!$storeTransDetail) {
                return response()->json([
                    'success' => false,
                    'msg' => "Data Transaksi Detail tidak berhasil disimpan",
                ]);
            }

            $data_transaction = [];
            foreach ($products as $product) {
                $data_transaction[] = [
                    'transaction_detail_id' => $storeTransDetail->id,
                    'product_id' => $product->product_id,
                    'qty' => $product->qty,
                ];
            }
            $storeTransaction = Transaction::insert($data_transaction);
            if (!$storeTransaction) {
                return response()->json([
                    'success' => false,
                    'msg' => "Data Transaksi tidak berhasil disimpan",
                ]);
            }
        }
        return response()->json([
            'token' => $snapToken,
            'redirect-url' =>
                "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken,
        ]);
        //return view('orders.show', compact('payments', 'snapToken'));
    }
}
