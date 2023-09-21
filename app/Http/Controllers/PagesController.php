<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view('index');
    }
    public function calculator(Request $request) {
        // calculate interest rate per month
        $monthly_interest_rate = $request->interest_rate / 12 / 100;
        // repayment calculator function
        $result = repaymentCalculator($request->amount,$request->repayment_frequency,$request->loan_term,$monthly_interest_rate);
        return view('calculator',compact('result'));
    }
}
