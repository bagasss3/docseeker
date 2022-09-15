<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Payments;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'number' => 12345678,
                'total_price' => 25000,
                'payment_status' => 1,
            ],
            [
                'number' => 23456789,
                'total_price' => 200000,
                'payment_status' => 1,
            ],
        ];

        Payments::insert($data);
    }
}
