<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Orders;
use App\Services\Midtrans\CallbackService;

use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService();

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $payments = $callback->getPayments();

            if ($callback->isSuccess()) {
                Payments::where('id', $payments->id)->update([
                    'payment_status' => 2,
                ]);
                $transactions = Transaction::join(
                    'transaction_detail',
                    'transaction.transaction_detail_id',
                    '=',
                    'transaction_detail.id'
                )
                    ->join(
                        'payments',
                        'transaction_detail.payment_id',
                        '=',
                        'payments.id'
                    )
                    ->where([
                        ['user_id', '=', 3],
                        ['payment_id', '=', $payments->id],
                    ])
                    ->get(['transaction.id']);

                $data_transaction = [];
                foreach ($transactions as $transaction) {
                    $data_transaction[] = [
                        'transaction_id' => $transaction->id,
                        'status' => 'Accepted',
                    ];
                }
                Orders::insert($data_transaction);
                Cart::where('user_id', 3)->delete();
            }

            if ($callback->isExpire()) {
                Payments::where('id', $payments->id)->update([
                    'payment_status' => 3,
                ]);
            }

            if ($callback->isCancelled()) {
                Payments::where('id', $payments->id)->update([
                    'payment_status' => 4,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil diproses',
            ]);
        } else {
            return response()->json(
                [
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ],
                403
            );
        }
    }
}
