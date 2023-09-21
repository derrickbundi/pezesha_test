<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
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
        $users = [
            [
                'name' => 'Joe',
                'email' => 'joe@website.com',
                'password' => Hash::make(123456)
            ],
            [
                'name' => 'Doe',
                'email' => 'doe@website.com',
                'password' => Hash::make(123456)
            ]
        ];
        foreach($users as $user) {
            User::updateOrCreate($user);
        }
    }
}
