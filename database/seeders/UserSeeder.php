<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'  => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
          
        ];
        User::create($user);
    }
}
