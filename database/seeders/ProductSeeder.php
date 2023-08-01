<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_cat = [
            "shoes" => "0",
            "bags" => "1",
            "glasses" => "2",
        ];

        $product_gender = [
            "men" => "0",
            "women" => "1",
        ];

        echo $product_gender["men"];
        $data = [
            [
                "product_cat" => $product_cat["glasses"],
                "product_gender" => $product_gender["women"],
                "product_brand" => 12,
                "product_title" => "Kacamata terbaru",
                "product_harga" => "10000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["glasses"],
                "product_gender" => $product_gender["men"],
                "product_brand" => 12,
                "product_title" => "Kacamata Kurang bagus",
                "product_harga" => "100000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["glasses"],
                "product_gender" => $product_gender["men"],
                "product_brand" => 12,
                "product_title" => "Kacamata Bagus",
                "product_harga" => "90000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["shoes"],
                "product_gender" => $product_gender["men"],
                "product_brand" => 12,
                "product_title" => "Sepatu Bagus",
                "product_harga" => "1000000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["shoes"],
                "product_gender" => $product_gender["women"],
                "product_brand" => 12,
                "product_title" => "Sepatu Wanita",
                "product_harga" => "50000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["shoes"],
                "product_gender" => $product_gender["women"],
                "product_brand" => 12,
                "product_title" => "Sepatu Mantap",
                "product_harga" => "200000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["bags"],
                "product_gender" => $product_gender["women"],
                "product_brand" => 12,
                "product_title" => "Tas Mantap",
                "product_harga" => "25000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
            [
                "product_cat" => $product_cat["bags"],
                "product_gender" => $product_gender["men"],
                "product_brand" => 12,
                "product_title" => "Tas GG",
                "product_harga" => "40000",
                "product_desc" => "",
                "stock" => 100,
                "weight" => 10,
            ],
        ];
        Products::insert($data);
    }
}
