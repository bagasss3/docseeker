<?php

namespace App\Services\Midtrans;

use App\Models\Payments;
use App\Services\Midtrans\Midtrans;
use Midtrans\Notification;

class CallbackService extends Midtrans
{
    protected $notification;
    protected $payments;
    protected $serverKey;

    public function __construct()
    {
        parent::__construct();

        $this->serverKey = config('midtrans.server_key');
        $this->_handleNotification();
    }

    public function isSignatureKeyVerified()
    {
        return $this->_createLocalSignatureKey() ==
            $this->notification->signature_key;
    }

    public function isSuccess()
    {
        $statusCode = $this->notification->status_code;
        $transactionStatus = $this->notification->transaction_status;
        $fraudStatus = !empty($this->notification->fraud_status)
            ? $this->notification->fraud_status == 'accept'
            : true;

        return $statusCode == 200 &&
            $fraudStatus &&
            ($transactionStatus == 'capture' ||
                $transactionStatus == 'settlement');
    }

    public function isExpire()
    {
        return $this->notification->transaction_status == 'expire';
    }

    public function isCancelled()
    {
        return $this->notification->transaction_status == 'cancel';
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getPayments()
    {
        return $this->payments;
    }

    protected function _createLocalSignatureKey()
    {
        $paymentId = $this->payments->number;
        $statusCode = $this->notification->status_code;
        $grossAmount = $this->payments->total_price;
        $serverKey = $this->serverKey;
        $input = $paymentId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        return $signature;
    }

    protected function _handleNotification()
    {
        $notification = new Notification();

        $paymentsNumber = $notification->order_id;
        $payments = Payments::where('number', $paymentsNumber)->first();

        $this->notification = $notification;
        $this->payments = $payments;
    }
}
