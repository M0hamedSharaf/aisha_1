@extends('admin.master')

@section('css')
@endsection

@section('content')
    <div class="row" style="direction: rtl;text-align:right">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-light" style="text-align: right">
                    الاختبار </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.exam.store') }}" method="post" class="form-horizontal">
                        @csrf


                        <x-form.select-object name="teacher_name" label="اختر المعلم" :collection="$teachers" field="name"
                            :selected="old('teacher_name')" />



                        <x-form.text name="title" label="العنوان" :value="old('title')" />


                        <x-form.number name="max_mark" label="اعلى درجة" :value="old('max_mark')" />


                        <x-form.number name="min_mark" label="اقل درجة" :value="old('min_mark')" />


                        <x-form.textarea name="note" label="ملاحظة" :value="old('note')" />

                </div>
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
