<?php

namespace App\Http\Controllers;
use App\Mail\OrderNotification;
use App\Models\Payments;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Orders;
use App\Models\User;
use App\Services\Midtrans\CallbackService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                    ->where([['payment_id', '=', $payments->id]])
                    ->get(['transaction.id', 'transaction_detail.user_id']);
                $data_transaction = [];
                foreach ($transactions as $transaction) {
                    $data_transaction[] = [
                        'transaction_id' => $transaction->id,
                        'status' => 'Accepted',
                    ];
                }
                $user = $transactions[0]->user_id;
                $orderId = Orders::insert($data_transaction);
                Cart::where('user_id', $user)->delete();
                $findUser = User::find($user);
                Mail::to($findUser->email)->send(
                    new OrderNotification(
                        $findUser->email,
                        'Success',
                        $transaction->id
                    )
                );
            }

            if ($callback->isExpire()) {
                Payments::where('id', $payments->id)->update([
                    'payment_status' => 3,
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
                    ->where([['payment_id', '=', $payments->id]])
                    ->get(['transaction.id', 'transaction_detail.user_id']);
                $user = $transactions[0]->user_id;
                $findUser = User::find($user);
                Mail::to($findUser->email)->send(
                    new OrderNotification(
                        $findUser->email,
                        'Expired',
                        $transaction->id
                    )
                );
            }

            if ($callback->isCancelled()) {
                Payments::where('id', $payments->id)->update([
                    'payment_status' => 4,
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
                    ->where([['payment_id', '=', $payments->id]])
                    ->get(['transaction.id', 'transaction_detail.user_id']);
                $user = $transactions[0]->user_id;
                $findUser = User::find($user);
                Mail::to($findUser->email)->send(
                    new OrderNotification(
                        $findUser->email,
                        'Canceled',
                        $transaction->id
                    )
                );
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
