<?php


namespace App\Services;


class FeeService
{
    public function getDeliveryFee($amount)
    {
        if(!$amount) {
            return 0;
        }

        if($amount <= 50) {
            return 25;
        }

        if($amount > 50 && $amount <= 100) {
            return 35;
        }

        return 45;
    }
}