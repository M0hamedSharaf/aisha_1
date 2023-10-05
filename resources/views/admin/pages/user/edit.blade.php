@extends('admin.master')

@section('css')
@endsection

@section('content')
    <div class="row" style="direction: rtl;text-align:right">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-light" style="text-align: right">
                    إضافة مستخدم
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <x-form.text name="name" label="الإسم" :value="$user->name" />

                        <x-form.email name="email" label="البريد الالكتروني" :value="$user->email" />


                        <div class="m-3">
                            <p class="text-danger">

                                سوف يتم وضع تعديل علي كلمه السر قريبا

                            </p>
                            <div class="m-3">
                                <button type="submit" class="btn btn-success float-right">
                                    Submit
                                </button>
                            </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('javascript')
@endsection
