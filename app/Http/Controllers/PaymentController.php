<?php

namespace App\Http\Controllers;


use App\DataTables\PaymentDataTable;
use App\Http\Requests\Payment\getPaymentCountOfGroupByMonth;
use App\Http\Requests\Payment\getPaymentsOfGroupByMonth;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Models\Payment;
use App\Services\Payment\PaymentChartService;
use App\Services\Payment\PaymentService;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    private PaymentChartService $paymentChartService;
    private PaymentService $PaymentService;
    private PermissionService $permissionService;

    public function __construct(
        PaymentChartService $paymentChartService,
        PaymentService      $PaymentService,
        PermissionService $permissionService
    )
    {
        $this->paymentChartService = $paymentChartService;
        $this->PaymentService = $PaymentService;
        $this->permissionService = $permissionService;

        $this->permissionService->handlePermissions($this,[
            'index' => 'index-payment',
            'store' => 'store-payment',
            'create' => 'create-payment',
            'delete' => 'delete-payment',
        ]);
    }

    public function index(PaymentDataTable $paymentDataTable)
    {
        return $paymentDataTable->render('pages.payment.index');
    }

    public function create()
    {
        return view('pages.payment.create');
    }

    public function store(StorePaymentRequest $request)
    {
        if ($request->paid == "true") {
            $this->PaymentService->updateOrCreatePaid($request);
        } else {
            $this->PaymentService->updateOrCreateNotPaid($request);
        }

        return response()->json([
            'status' => 200
        ]);
    }

    public function delete(Payment $payment)
    {
         $payment->delete();
         Alert::toast('تمت العملية بنجاح', 'success');
         return redirect()->back();
    }

    public function getPaymentsOfGroupByMonth(getPaymentsOfGroupByMonth $request)
    {
        $payments = $this->PaymentService->getPaymentsOfGroupByMonth($request->group_id, $request->month);
        return response()->json([
            'payments' => $payments,
            'paidCount' => $payments->where('paid',true)->count()
        ]);
    }

    public function getPaymentCountOfGroupByMonth(getPaymentCountOfGroupByMonth $request)
    {
        return response()->json([
            'paymentsCount' => $this->PaymentService->getPaymentCountOfGroupByMonth($request->group_id, $request->month)
        ]);
    }

    public function totalPaymentsChartData(Request $request)
    {
        $data = $this->paymentChartService->sumOfAmountAndMonth()
            ->paid()
            ->getForChart();

        return response()->json([
            'months' => getMonthsAccordingToLocalization(array_keys($data)),
            'values' => array_values($data),
            'words' => [
                'totalPayments' => trans('payment.total_payments') . " " . array_sum(array_values($data)),
                'payments' => trans('main.payment')
            ]
        ]);
    }
}
