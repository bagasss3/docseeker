<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
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
                'role_id' => "1",
                'name' => 'superadmin@gmail.com',
                'password' => Hash::make("akuadmin"),
            ],
        ];

        Admin::insert($data);
    }
}
