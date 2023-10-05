@extends('admin.master')

@section('css')
@endsection

@section('content')
    <div class="row" style="direction: rtl;text-align:right">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-light" style="text-align: right">
                    المجموعات </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.group.store') }}" method="post" class="form-horizontal">
                        @csrf


                        <x-form.text name="name" label="اسم المجموعة" :value="old('name')" />


                        <x-form.select-object name="teacher_id" label="اختر المعلم" :collection="$teachers" field="name"
                            :selected="old('teacher_id')" />
                        <x-form.select-array name="type" :array="getGroupTypes()" label="اختر النوع" :selected="old('type')" />



                        <x-form.textarea name="note" label="ملاحظة" :value="old('note')" />


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
