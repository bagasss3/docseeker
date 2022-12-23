<?php

namespace App\Http\Controllers;

use App\Mail\OrderNotification;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    //
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

        if (count($products) < 1) {
            return back()->with([
                'info' => 'Tidak ada product',
            ]);
        }
        $address = Address::join(
            'provinces',
            'addresses.province_id',
            '=',
            'provinces.province_id'
        )
            ->join('cities', 'addresses.city_id', '=', 'cities.city_id')
            ->where(['user_id' => $request->user()->id, 'is_active' => true])
            ->get([
                'addresses.*',
                'provinces.province_id',
                'provinces.name as province_name',
                'cities.city_id',
                'cities.name as city_name',
            ])
            ->first();
        return view('checkout', [
            'title' => 'Your Order',
            'data' => $products,
            'address' => $address,
        ]);
    }

    public function show(Payments $payments, Orders $orders, Request $request)
    {
        $snapToken = $payments->snap_token;
        if (empty($snapToken)) {
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
            if (count($products) < 1) {
                return response()->json([
                    'success' => false,
                    'msg' => "Produk kosong",
                ]);
            }
            $addresses = Address::find($request->addresses_id);
            $order_id = rand();
            $data = [
                'order_id' => $order_id,
                'gross_amount' => (int) $request->gross_amount,
                'ongkir_courier' => $request->ongkir_courier,
                'ongkir_service' => $request->ongkir_service,
                'ongkir_cost' => $request->ongkir_cost,
                'first_name' => $addresses->first_name,
                'last_name' => $addresses->last_name,
                'email' => $addresses->email,
                'phone' => $addresses->phone,
                'address' => $addresses->address,
                'postal_code' => $addresses->zip_code,
                'city' => $addresses->cities,
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
                'user_id' => $request->user()->id,
                'addresses_id' => $request->addresses_id,
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
            $order = Orders::insertGetId([
                'status' => 'Accepted',
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $data_transaction = [];
            foreach ($products as $product) {
                $data_transaction[] = [
                    'transaction_detail_id' => $storeTransDetail->id,
                    'product_id' => $product->product_id,
                    'qty' => $product->qty,
                    'orders_id' => $order,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
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

    public function deleteToken(Request $request)
    {
        $token = $request->token;
        $payments = Payments::where('snap_token', $token)->first();
        $transaction_detail = Transaction_Detail::where(
            'payment_id',
            $payments->id
        )->first();
        $transaction = Transaction::where(
            'transaction_detail_id',
            $transaction_detail->id
        )->first();
        $order = Orders::where('id', $transaction->orders_id)->first();
        $payments->delete();
        $order->delete();
        return response()->json([
            'success' => 'true',
            'msg' => 'token berhasil di delete',
        ]);
    }

    public function testEmail(Request $request)
    {
        $email = $request->email;
        Mail::to($email)->send(new OrderNotification($email, 'Success', ''));
        return response()->json([
            'success' => true,
            'msg' => 'Success send Mail',
        ]);
    }
}
