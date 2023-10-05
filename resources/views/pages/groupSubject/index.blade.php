@extends('master')

@section('title')
    Group Subjects Table
@endsection

@push('css')

    @if(LaravelLocalization::getCurrentLocale() == 'ar')

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/plugins/table/datatable/datatables.css') }}">

              <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/forms/theme-checkbox-radio.css') }}">

    @else

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/plugins/table/datatable/datatables.css') }}">

              <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/forms/theme-checkbox-radio.css') }}">
    @endif

        <link rel="stylesheet"
        type="text/css"
        href="{{ asset('adminAssets/plugins/select2/select2.min.css') }}">
@endpush


@section('breadcrumb')
<div class="row my-3 ">
    <div class="col-md-12">
        <div class="breadcrumb bg-transparent">

            <div class="breadcrumb-four">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"
                           class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-house mx-2 fa-2x"></i>
                            <span class="font-weight-bold mt-1">
                             {{trans('main.home_page')}}
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.group_subjects.index')}}"
                           class="d-flex justify-content-center align-items-center">

                            <i class="fa-solid fa-users-viewfinder fa-2x mx-2"></i>
                            <span class="font-weight-bold "> 
                                {{trans('group.groups_subject')}}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection



@section('content')
    <div class="container-fluid">

        @include('pages.errorCreate')

        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables">
                        <h3 class="text-capitalize text-white">
                            {{trans('group.groups_subject')}}
                        </h3>
                        @check_permission('store-groupSubject')
                        <a class="icon text-white" data-toggle="modal"
                        data-target="#creatGroupSubjectModal">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                        </a>
                        @endcheck_permission
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table
                            ([
                                     'class' => 'table table-striped dt-table-hover dataTable ',
                                     'style' => 'width:100%'
                                 ],true,
                            )
                        !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.groupSubject.createModal')
@endsection


@push('js')
    {{--Begin Data_Table--}}
    <script src="{{ asset('adminAssets/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('adminAssets/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
    {{--End Data_Table--}}

    <script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
    <script src="{{ asset('adminAssets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $('#group_id').on('change', function () {
            let href = $(this).data('href');
            let group_id = $(this).val();
            $(`option`).removeAttr('disabled').css({
                'color': 'black'
            });
            $.ajax({
                url: href,
                data: {
                    group_id
                },
                success: function (response) {

                    let groupSubjects = response.groupSubjects

                    groupSubjects.forEach(element => {
                        let subject = element.subject_id

                        $(`#subject_id option[value=${subject}]`).attr('disabled', true).css({
                            'color': 'red'
                        })
                    });
                },
                error: function () {
                }
            })
        })
    </script>

    <script>
        $('.group_create').select2({
            dropdownParent: $('#creatGroupSubjectModal'),
        });
        $('.group_subject_create').select2({
            dropdownParent: $('#creatGroupSubjectModal'),
        });
       
    </script>
@endpush
