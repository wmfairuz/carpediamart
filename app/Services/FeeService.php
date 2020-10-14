<?php


namespace App\Services;


class FeeService
{
    public function getDeliveryFee($amount)
    {
        if(!$amount) {
            return 0;
        }

        if($amount <= 100) {
            return 25;
        }

        if($amount > 100 && $amount <= 200) {
            return 35;
        }

        if($amount > 200 && $amount <= 300) {
            return 45;
        }

        return 50;
    }

    public function getDeposit($amount)
    {
        if(!$amount) {
            return 0;
        }

        if($amount <= 100) {
            return 30;
        }

        return 50;
    }
}