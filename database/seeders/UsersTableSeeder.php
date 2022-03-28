<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'fz050799@gmail.com',
                'phone'              => '971561267009',
                'password'           => bcrypt('12341234'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2022-02-24 17:43:25',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'User',
                'email'              => 'user@admin.com',
                'phone'              => '971561267009',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2022-02-24 17:43:25',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}