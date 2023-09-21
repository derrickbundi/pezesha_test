<?php
use Symfony\Component\HttpFoundation\Response;

function repaymentCalculator($amount,$repayment_frequency,$loan_term,$monthly_interest_rate) {
    // get total repayments
    switch($repayment_frequency) {
        case 'monthly':
            $total_repayments = $loan_term;
            break;
        case 'bi_monthly':
            $total_repayments = $loan_term * 2;
            break;
        case 'weekly':
            $total_repayments = $loan_term * 4;
            break;
        default:
            $total_repayments = $loan_term;
            break;
    }

    // calculate monthly repayment
    $monthly_repayment = ($amount * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, - $total_repayments));

    $total_interest = 0;
    $balance = $amount;

    $repayment_plan = [];

    // calculate repayment breakdown
    for($i = 1; $i <= $total_repayments; $i++) {
        $interest = $balance * $monthly_interest_rate;        
        $principal = $monthly_repayment - $interest;
        $balance -= $principal;
        $total_interest += $interest;

        $repayment_plan[] = [
            'id' => $i,
            'amount' => $monthly_repayment,
            'interest_amount' => $interest,
            'principal' => $principal,
            'balance' => max(0, $balance)
        ];
    }

    $total_amount_due = $amount + $total_interest;

    return [
        'total_interest' => $total_interest,
        'total_amount_to_repay' => $total_amount_due,
        'repayment_plan' => $repayment_plan
    ];
}

function calculateMonthlyRepayment($amount, $interest_rate, $repayment) {
    $monthly_interest_rate = $interest_rate / 12 / 100;
    return ($amount * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, -$repayment));
}