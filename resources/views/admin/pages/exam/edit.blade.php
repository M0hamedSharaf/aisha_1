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
                    <form action="{{ route('admin.exam.update',$exam->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')


                        <x-form.select-object name="teacher_name" label="اختر المعلم" :collection="$teachers" field="name"
                            :selected="$exam->id" />


                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">




                        <x-form.text name="title" label="العنوان" :value="$exam->title" />


                        <x-form.number name="max_mark" label="اعلى درجة" :value="$exam->max_mark" />


                        <x-form.number name="min_mark" label="اقل درجة" :value="$exam->min_mark" />


                        <x-form.textarea name="note" label="ملاحظة" :value="$exam->note" />

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
