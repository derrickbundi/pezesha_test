<?php

namespace App\Services;
use App\Models\Account;
use Carbon\Carbon;
use Auth;

class AccountService
{
    public function create($balance) {
        $account = Account::create([
            'account_number' => substr(str_shuffle('23456789ABCDEFGHJKLMNPQRSTUVWXYZ'),0,5),
            'balance' => $balance,
            'user_id' => Auth::id()
        ]);        
        return $account;
    }
}