<?php


namespace App\Http\Traits;


use App\Models\Payment;

trait PaymentTrait
{
    private function getPaymentsDesc()
    {
        return Payment::orderBy('id', 'DESC')->get();
    }
}
