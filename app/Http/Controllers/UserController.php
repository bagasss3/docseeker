<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Transaction;
use App\Models\Transaction_Detail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|min:3|max:100',
                'last_name' => 'required|min:3|max:100',
                'email' => 'required',
                'password' => 'required|max:20',
            ],
            [
                'first_name.required' => 'First name harus diisi',
                'first_name.min' => 'First Name minimal 3 karakter',
                'first_name.max' => 'First Name maksimal 100 karakter',
                'last_name.required' => 'Last name harus diisi',
                'last_name.min' => 'Last name minimal 3 karakter',
                'last_name.max' => 'Last name maksimal 100 karakter',
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',
                'password.max' => 'Password Maksimal 20 karakter',
            ]
        );

        $data = [
            'role_id' => 0,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail) {
            return back()->with(['info' => 'Email sudah terdaftar!']);
        }

        $store = User::create($data);
        if (!$store) {
            return back()->with([
                'info' => 'Terjadi kesalahan di server kami, coba lagi',
            ]);
        }
        return redirect('/login');
    }

    public function show(Request $request, User $user)
    {
        $status = [
            (object) ["status" => "Accepted"],
            (object) ["status" => "Send"],
            (object) ["status" => "Canceled"],
            (object) ["status" => "Returned"],
            (object) ["status" => "Packed"],
            (object) ["status" => "Finished"],
        ];
        $user = $user->find($request->user()->id);
        if (!$user) {
            redirect()
                ->back()
                ->with('message', 'Error load profile');
        }
        $orders = Orders::where('created_by', $request->user()->id)->get([
            'orders.id',
            'orders.custom_id',
            'orders.status',
            'orders.resi',
        ]);

        return view('profile', [
            'user' => $user,
            'data' => $orders,
            'status' => $status,
            'title' => 'PROFILE PAGE',
        ]);
    }

    public function showOrder(Request $request, User $user)
    {
        $condition = [
            'orders.created_by' => $request->user()->id,
        ];
        $filter = $request->input('status');
        switch ($filter) {
            case 'Send':
                $condition = array_merge($condition, [
                    'orders.status' => 'Send',
                ]);
                break;
            case 'Canceled':
                $condition = array_merge($condition, [
                    'orders.status' => 'Canceled',
                ]);
                break;
            case 'Returned':
                $condition = array_merge($condition, [
                    'orders.status' => 'Returned',
                ]);
                break;
            case 'Packed':
                $condition = array_merge($condition, [
                    'orders.status' => 'Packed',
                ]);
                break;
            case 'Finished':
                $condition = array_merge($condition, [
                    'orders.status' => 'Finished',
                ]);
                break;
            default:
                $condition = array_merge($condition, [
                    'orders.status' => 'Accepted',
                ]);
                break;
        }

        $orders = Orders::where($condition)->get([
            'orders.id',
            'orders.resi',
            'orders.status',
        ]);
        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    public function detailOrder($id, Request $request)
    {
        $getOrderId = Orders::where([
            'custom_id' => $id,
            'created_by' => $request->user()->id,
        ])->first();
        if (!$getOrderId) {
            return back()->with(['info' => 'Order tidak ada!']);
        }

        $order = Orders::join(
            'transaction',
            'orders.id',
            '=',
            'transaction.orders_id'
        )
            ->where([
                'orders.id' => $getOrderId->id,
            ])
            ->join(
                'transaction_detail',
                'transaction.transaction_detail_id',
                '=',
                'transaction_detail.id'
            )
            ->join('products', 'transaction.product_id', '=', 'products.id')
            ->where([
                'transaction_detail.user_id' => $request->user()->id,
            ])
            ->get([
                'orders.id',
                'transaction.product_id',
                'products.product_title',
                'products.deleted_at',
                'transaction.qty',
                'products.product_harga',
            ]);
        // dd($order);
        if (!$order) {
            return back()->with(['info' => 'Order tidak ada!']);
        }

        return view('detail-order', [
            'title' => 'detail-order',
            'success' => true,
            'data' => $order,
            'orderId' => $id,
        ]);
    }

    public function editOrder($id, Request $request, Orders $orders)
    {
        $request->validate(
            [
                'status' => 'in:Canceled,Returned,Finished',
            ],
            [
                'status' => 'Status tidak ada pada pilihan',
            ]
        );

        $data = [
            'status' => $request->status,
        ];

        $ordersID = $orders->find($id);
        $transactionID = Transaction::where('id', $ordersID->id)->get();
        $transactionDetailID = Transaction_Detail::where(
            'id',
            $transactionID->transaction_detail_id
        )->get();
        if ($transactionDetailID->user_id != $request->user()->id) {
            return response()->json([
                'success' => false,
                'msg' => "Orders Forbidden",
            ]);
        }
        if (!$orders::find($id)->update($data)) {
            return response()->json([
                'success' => false,
                'msg' => "Data tidak berhasil diupdate",
            ]);
        }
        return response()->json([
            'success' => true,
            'msg' => "Data berhasil diupdate",
        ]);
    }
}
