<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($data)
    {
        parent::__construct();

        $this->data = $data;
    }

    public function getSnapToken()
    {
        $item_details = [];
        foreach ($this->data['products'] as $product) {
            $item_details[] = [
                'id' => rand(),
                'price' => $product->product_harga,
                'quantity' => $product->qty,
                'name' => $product->product_title,
            ];
        }
        array_push($item_details, [
            'id' => rand(),
            'price' => $this->data['ongkir_cost'],
            'quantity' => 1,
            'name' =>
                $this->data['ongkir_courier'] .
                ' ' .
                $this->data['ongkir_service'],
        ]);
        $params = [
            'transaction_details' => [
                'order_id' => $this->data['order_id'],
                'gross_amount' => $this->data['gross_amount'],
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
                "shipping_address" => [
                    "first_name" => $this->data['first_name'],
                    "last_name" => $this->data['last_name'],
                    "email" => $this->data['email'],
                    "phone" => $this->data['phone'],
                    "address" => $this->data['address'],
                    "city" => $this->data['city'],
                    "postal_code" => $this->data['postal_code'],
                    "country_code" => "IDN",
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
