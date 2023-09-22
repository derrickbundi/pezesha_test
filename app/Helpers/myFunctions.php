<?php
use Symfony\Component\HttpFoundation\Response;

// Amortization calculator
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

    // loan amortization
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
            'amount' => round($monthly_repayment,2),
            'interest_amount' => round($interest,2),
            'principal' => round($principal,2),
            'balance' => round(max(0, $balance), 2)
        ];
    }

    $total_amount_due = $amount + $total_interest;

    return [
        'total_interest' => round($total_interest,2),
        'total_amount_to_repay' => round($total_amount_due,2),
        'repayment_plan' => $repayment_plan
    ];
}

// monthly repayment function
function calculateMonthlyRepayment($amount,$interest,$repayment) {
    $monthly_interest_rate = $interest / 12 / 100;
    return ($amount * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, - $repayment));
}

// monthly interest function
function calculateMonthlyInterest($amount,$interest) {
    return ($amount * $interest) / 12 / 100;
}