<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $status, $transactionId)
    {
        $this->email = $email;
        $this->status = $status;
        $this->transactionId = $transactionId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $status = $this->status;
        $transactionId = $this->transactionId;
        return $this->subject('Transaction Notification')
            ->markdown('emails.ordernotification')
            ->with([
                'email' => $email,
                'status' => $status,
                'transactionId' => $transactionId,
            ]);
    }
}
