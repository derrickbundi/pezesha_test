<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{AccountDetailResource};
use App\Services\AccountService;
use Illuminate\Support\Facades\{Validator,Log,Auth,DB};
use App\Models\{Account,User};

class AccountController extends Controller
{
    public function __construct(AccountService $accountservice) {
        $this->accountservice = $accountservice;
    }
    public function create_account(Request $request) {
        // validate data
        $validator = Validator::make($request->all(), [
            'balance'       => 'required|gt:0' // ensures field is required and greater than zero
        ]);

        if ($validator->fails()) {
            return _httpBadRequest($validator->errors()->first(),$validator->errors());
        }

        try {
            // check if user account exist -- if exist return account detail
            if(Auth::user()->account != null) {
                $account = Account::where('user_id',Auth::id())->first();
                return _httpOk('Account Details', new AccountDetailResource($account));
            }

            // create account with a service that handles account creation
            $account = $this->accountservice->create($request->balance);
            return _httpCreated('Account created successfully');
        } catch (\Exception $e) {
            // log error message
            Log::critical($e->getMessage());
            return _httpBadRequest('Oops, something went wrong',$e->getMessage());
        }
    }
    public function account_detail($id) {
        try {
            $account = Account::findOrFail($id);
            // format data with account_detail_resource and return to request
            return _httpOk('Account Details', new AccountDetailResource($account));
        } catch (\Exception $e) {
            return _httpBadRequest('Oops, something went wrong',$e->getMessage());
        }
    }
    public function transfer(Request $request) {
        // validate data
        $validator = Validator::make($request->all(), [
            'destination_account_id'     => 'required|exists:accounts,id', // ensures field is required & exists
            'amount'       => 'required|gt:0' // ensures field is required and greater than zero
        ]);

        if ($validator->fails()) {
            return _httpBadRequest($validator->errors()->first(),$validator->errors());
        }

        // get source account and lock for update
        $source_account = Account::where('user_id',Auth::id())->lockForUpdate()->first();

        if($source_account->balance < $request->amount) {
            return _httpBadRequest('Transaction failed. Insuffiecient account balance!');
        }

        try {
            // database transaction to handle concurrency
            DB::transaction(function() use($request,$source_account) {
                // get destination account and lock for update                
                $destination_account = Account::lockForUpdate()->find($request->destination_account_id);

                // update accounts balances
                $source_account->balance -= $request->amount;
                $source_account->save();
                
                $destination_account->balance += $request->amount;
                $destination_account->save();
            });
            return _httpOk('Transaction completed successfully');
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return _httpBadRequest('Oops, something went wrong',$e->getMessage());
        }
    }
}
