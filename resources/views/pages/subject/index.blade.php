@extends('master')

@section('title')
    Subjects Table
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
                        <a href="{{route('admin.subject.index')}}"
                           class="d-flex justify-content-center align-items-center">

                            <i class="fa-solid fa-book fa-2x mx-2"></i>
                            <span class="font-weight-bold ">
                                {{trans('subject.prescribed_curriculum')}}
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
        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables">
                        <h3 class="text-capitalize text-white">
                            {{trans('main.subjects')}}
                        </h3>
                        @check_permission('store-subject')
                        <a class="icon text-white" href="{{ route('admin.subject.create') }}">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                        </a>
                        @endcheck_permission
                    </div>
                    <div class="card-body">
                        <table id="style-3" class="table table-striped dt-table-hover dataTabl" style="width:100%">
                            <thead>
                            <tr>
                                <th class="checkbox-column text-center"> Id</th>
                                <th class="text-center">
                                    {{trans('subject.subject_image')}}
                                </th>
                                <th class="text-center">
                                    {{trans('main.name')}}
                                </th>
                                <th class="text-center">
                                    {{trans('subject.pages_count')}} 
                                </th>
                                <th class="text-center">
                                    {{trans('main.book')}}
                                </th>
                                
                                @check_permission('update-subject')
                                <th class="text-center">
                                    {{trans('main.edit')}}
                                </th>
                                @endcheck_permission

                                @check_permission('delete-subject')
                                <th class="text-center">
                                    {{trans('main.delete')}}
                                </th>
                                @endcheck_permission

                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($subjects as $subject)
                                <tr role="row">
                                    <td class="checkbox-column text-center sorting_1">
                                        {{ $subject->id }} </td>
                                    <td>
                                        <img src="{{ $subject->avatar }}" alt=""
                                             class="avatar-image">
                                    </td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->pages_count }}</td>
                                    <td>
                                        <a href="{{ $subject->book }}" target="__blank">
                                            <svg viewBox="0 0 24 24" width="24" height="24"
                                                 stroke="currentColor" stroke-width="2" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="css-i6dzq1">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                </path>
                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                <line x1="12" y1="15" x2="12"
                                                      y2="3"></line>
                                            </svg>
                                        </a>
                                    </td>

                                    @check_permission('update-subject')
                                    <td class="text-center">
                                        <div class="links--ul text-center">
                                            <x-edit-link
                                                    :route="route('admin.subject.edit', $subject->id)"/>
                                        </div>
                                    </td>
                                    @endcheck_permission


                                    @check_permission('delete-subject')
                                    <td class="text-center">
                                        <div class="links--ul text-center">
                                            <x-delete-link
                                                    :route="route('admin.subject.delete', $subject->id)"/>
                                        </div>
                                    </td>
                                    @endcheck_permission

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

    <script src="{{ asset('adminAssets/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        // var e;
        c3 = $('#style-3').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5,
        });

        multiCheck(c3);
    </script>

@endpush
