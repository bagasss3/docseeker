<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
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
                'role_id' => "0",
                'first_name' => 'MOHAMMAD',
                'last_name' => "AKBAR",
                'email' => "akbar891@gmail.com",
                'password' => Hash::make("asdd"),
            ],
            [
                'role_id' => "0",
                'first_name' => 'DANIEL',
                'last_name' => "AKBAR",
                'email' => "asdd@gmail.com",
                'password' => Hash::make("asdd"),
            ]
        ];

        User::insert($data);
    }
}
