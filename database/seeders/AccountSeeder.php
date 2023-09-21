<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = [
            'balance' => 100,
            'user_id' => 2,
            'account_number' => substr(str_shuffle('23456789ABCDEFGHJKLMNPQRSTUVWXYZ'),0,5)
        ];
        Account::updateOrCreate($account);
    }
}
