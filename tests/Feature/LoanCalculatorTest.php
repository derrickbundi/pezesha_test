<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanCalculatorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_monthly_repayment()
    {
        // input values
        $amount = 10000;
        $interest_rate_pa = 13;
        $repayments = 5;

        // call function to calculate monthly repayment
        $monthly_repayment = calculateMonthlyRepayment($amount,$interest_rate_pa,$repayments);

        // assert repayment values within expected range
        $expected_monthly_repayment = 2065.47;
        $acceptable_diff = 0.01;

        $this->assertGreaterThanOrEqual($expected_monthly_repayment - $acceptable_diff, $monthly_repayment);
        $this->assertLessThanOrEqual($expected_monthly_repayment + $acceptable_diff, $monthly_repayment);
    }

    public function test_monthly_interest()
    {
        $amount = 10000;
        $interest_rate_pa = 13;

        //call function to calculate monthly_interest_rate
        $monthly_interest = calculateMonthlyInterest($amount,$interest_rate_pa);

        // expected value
        $expected_monthly_interest = ($amount * $interest_rate_pa) / 12 / 100;

        $this->assertEquals($expected_monthly_interest, $monthly_interest);
    }
}
