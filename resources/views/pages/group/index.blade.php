@extends('master')

@section('title')
    Groups Table
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
                        <a href="{{route('admin.group.index')}}"
                           class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-users-rays fa-2x mx-2"></i>
                            <span class="font-weight-bold ">
                                {{trans('main.groups')}}
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
                           {{trans('main.groups')}}
                        </h3>
                        @check_permission('store-group')
                        <a class="icon text-white"  data-toggle="modal"
                        data-target="#creatGroupModal">
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


    @include('pages.group.createModal')

    @include('pages.group.editModal')
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
        $('.teacher_create').select2({
            dropdownParent: $('#creatGroupModal'),
        });
        $('.group_type_create').select2({
            dropdownParent: $('#creatGroupModal'),
        });
        $('.teacher_edit').select2({
            dropdownParent: $('#editGroup'),
        });
        $('.group_type_edit').select2({
            dropdownParent: $('#editGroup'),
        });
    </script>
@endpush
