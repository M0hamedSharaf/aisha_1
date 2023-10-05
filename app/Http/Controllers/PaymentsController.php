<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\PaymentsDeleteRequest;
use App\Http\Requests\Payments\PaymentsStoreRequest;
use App\Http\Requests\Payments\PaymentsUpdateRequest;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\StudentTrait;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentsController extends Controller
{

    use PaymentTrait;
    use StudentTrait;

    public function index()
    {

        $payments = $this->getPaymentsDesc();
        return view('admin.pages.Payment.index', [
            'payments' => $payments,
        ]);
    }

    public function create()
    {

        $students = $this->getStudents();
        return view('admin.pages.Payment.create', [
            'students' => $students,
        ]);
    }

    public function store(PaymentsStoreRequest $request)
    {

        Payment::create([

            'student_id' => $request->student_id,
            'payed'      => $request->payed,
            'month'      => $request->month,
            'onte'       => $request->onte

        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.Payment.index'));
    }

    public function edit(Payment $payment)
    {
        $students = $this->getStudents();

        return view('admin.pages.Payment.edit', [
            'students' => $students,
            'payment' => $payment

        ]);
    }

    public function update(PaymentsUpdateRequest $request, Payment $payment)
    {





        $payment->update([
            'student_id' => $request->student_id,
            'payed'      => $request->payed,
            'month'      => $request->month,
            'onte'       => $request->onte

        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.Payment.index'));
    }

    public function delete(PaymentsDeleteRequest $request, Payment $payment)
    {

        $payment->delete();


        Alert::success('نجاح', 'تمت العملية بنجاح');

        return redirect()->back();
    }
}
