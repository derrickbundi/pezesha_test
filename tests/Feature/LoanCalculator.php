<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanCalculator extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMonthlyRepaymentCalculator()
    {
        // Mock input values
        $loan_amount = 100000; // Loan amount
        $annual_interest_rate = 0.06; // Annual interest rate
        $total_repayments = 360; // Total number of repayments (30 years in months)

        // Call the function to calculate the monthly repayment
        $monthly_repayment = calculateMonthlyRepayment($loan_amount, $annual_interest_rate, $total_repayments);

        // Assert that the calculated monthly repayment is within an acceptable range of the expected value
        $expected_monthly_repayment = 599.55; // This is the expected value for the given inputs
        $acceptable_difference = 0.01; // We allow a small difference due to floating point imprecision

        $this->assertGreaterThanOrEqual($expected_monthly_repayment - $acceptable_difference, $monthly_repayment);
        $this->assertLessThanOrEqual($expected_monthly_repayment + $acceptable_difference, $monthly_repayment);
    }
    public function testMonthlyInterestCalculation()
    {
        // Mock input values
        $loan_amount = 100000; // Loan amount
        $annual_interest_rate = 0.06; // Annual interest rate

        // Call the function to calculate the monthly interest
        $monthly_interest = calculateMonthlyInterest($loan_amount, $annual_interest_rate);

        // Calculate the expected monthly interest
        $expected_monthly_interest = ($loan_amount * $annual_interest_rate) / 12;

        // Assert that the calculated monthly interest matches the expected value
        $this->assertEquals($expected_monthly_interest, $monthly_interest);
    }
}
