<?php

namespace App\Services\Payment;

use App\Models\Payment;


class PaymentService
{
    public function updateOrCreatePaid(object $request)
    {
        $this->updateOrCreate($request , true);
    }

    public function updateOrCreateNotPaid(object $request)
    {
        $this->updateOrCreate($request , false);
    }

    private function updateOrCreate(object $request, bool $paid)
    {
        Payment::updateOrCreate([
            'student_id' => $request->student_id,
            'group_id' => $request->group_id,
            'month' => $request->month,
        ], [
            'paid' => $paid,
            'amount' => $request->amount,
        ]);
    }

    public function getPaymentsOfGroupByMonth(int $group_id,string $month)
    {
        return Payment::select(['id', 'paid', 'student_id', 'group_id', 'month'])
            ->where('month', $month)
            ->where('group_id', $group_id)
            ->get();
    }

    public function getPaymentCountOfGroupByMonth(int $group_id,string $month)
    {
        return Payment::where('group_id', $group_id)
            ->where('month',  $month)
            ->where('paid', true)
            ->count();
    }
}