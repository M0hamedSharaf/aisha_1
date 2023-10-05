<?php

namespace App\Services\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentChartService
{

    private $query;

    public function sumOfAmountAndMonth()
    {
        $this->query = Payment::select(
            DB::raw("(SUM(amount)) as month_amount"),
            'month'
        );

        return $this;
    }

    public function paid()
    {
        $this->query->where('paid', 1);
        return $this;
    }

    public function fromGroup(int $group_id)
    {
        $this->query->where('group_id', '=', $group_id);
        return $this;
    }

    public function from(string $startTime = null)
    {
        $startTime && $this->query->where('created_at', '>=', date('Y-m-d', strtotime($startTime)));
        return $this;
    }

    public function to(string $endTime = null)
    {
        $endTime && $this->query->where('created_at', '<=', date('Y-m-d', strtotime($endTime)));
        return $this;
    }

    public function year(string $year = null)
    {
        $year && $this->query->whereYear('created_at', $year);
        return $this;
    }

    public function getForChart()
    {
        $paymentsChart =  $this->query->groupBy('month')->get();

        return $this->getDataEachMonth($paymentsChart);
    }

    private function getDataEachMonth($paymentsChart)
    {
        $data = [];
        foreach (getMonthNames() as $monthName) {
            $data[$monthName] = $paymentsChart->where('month', $monthName)->first()->month_amount ?? 0;
        }
        return $data;
    }

    public function getAllPossibleYears()
    {
        return Payment::select(DB::raw("YEAR(created_at) as year"))
            ->where('paid', 1)
            ->groupBy('year')
            ->get();
    }
}