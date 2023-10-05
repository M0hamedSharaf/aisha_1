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
                    <form action="{{ route('admin.group.update', $group->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="group_id" value="{{ $group->id }}">

                        <x-form.text name="name" label="اسم المجموعة" :value="$group->name" />


                        <x-form.select-object name="teacher_id" label="اختر المعلم" :collection="$teachers" field="name"
                            :selected="$group->teacher_id" />
                        <x-form.select-array name="type" :array="getGroupTypes()" label="اختر النوع" :selected="$group->type" />


                        <x-form.textarea name="note" label="ملاحظة" :value="$group->note" />

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
