@extends('master')

@section('title')
    Edit Role {{$role->name}}
@endsection

@push('css')
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        {{--BreadCrumb--}}
        <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
        {{--Tabs--}}
        <link href="{{asset('adminRtl/assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet"
              type="text/css">
    @else
        {{--BreadCrumb--}}
        <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
        {{--Tabs--}}
        <link href="{{asset('adminAssets/assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet"
              type="text/css">
    @endif
    <link rel="stylesheet" href="{{asset('css/myCheckbox.css')}}">

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
                        <li>
                            <a href="{{route('admin.role.index')}}"
                               class="d-flex justify-content-center align-items-center">

                               <i class="fa-solid fa-fingerprint fa-2x mx-2"></i>
                                <span class="font-weight-bold ">
                                    {{trans('main.roles')}}
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#"
                               class="d-flex justify-content-center align-items-center">

                                <i class="fa-solid fa-users-gear fa-2x mx-2"></i>
                                <span class="font-weight-bold ">
                                    {{trans('roles.update_role')}}
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
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header create__form__header">
                        <h3 class="font-weight-bold text-capitalize text-light">
                            {{trans('roles.update_role')}}
                        </h3>
                    </div>
                    <form action="{{ route('admin.role.update' ,$role->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active"
                                       id="animated-underline-home-tab"
                                       data-toggle="tab"
                                       href="#animated-underline-home"
                                       role="tab"
                                       aria-controls="animated-underline-home"
                                       aria-selected="true">
                                        <i class="fa-solid fa-user-gear fa-2x"></i>

                                        <span class="font-weight-bold">
                                            {{trans('roles.role_info')}}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       id="animated-underline-permission-tab"
                                       data-toggle="tab"
                                       href="#animated-underline-permission"
                                       role="tab"
                                       aria-controls="animated-underline-permission"
                                       aria-selected="false">

                                        <i class="fa-solid fa-gears fa-2x"></i>

                                        <span class="font-weight-bold">
                                            {{trans('roles.add_permissions')}}
                                        </span>

                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content " id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
                                     aria-labelledby="animated-underline-home-tab">
                                    <div class="modal-body  my-5 rounded border border-solid b-1 bg-light">

                                        @include('pages.role.partials.form')
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="animated-underline-permission" role="tabpanel"
                                     aria-labelledby="animated-underline-permission-tab">
                                    <div
                                        class="d-flex justify-content-between align-items-center mx-2 my-3 p-3 rounded bg-light">
                                        <h4 class="font-weight-bold text-capitalize
                                     text-dark">
                                     {{trans('roles.give_this_role_all_permissions')}}
                                    </h4>
                                        <a> <i class="far fa-check-circle fa-2x" id="giveAllPermissions"></i></a>

                                    </div>
                                    <div class="media">
                                        <div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4 text-center">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('main.tables')}}</th>
                                                    <th>{{trans('roles.index_roles')}}</th>
                                                    <th>{{trans('roles.create_Page')}}</th>
                                                    <th>{{trans('roles.edit_Page')}}</th>
                                                    <th>{{trans('roles.store_roles')}}</th>
                                                    <th>{{trans('roles.update_roles')}}</th>
                                                    <th>{{trans('roles.delete_roles')}}</th>
                                                    <th>{{trans('roles.show_roles')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody id="permissionBody">
                                                @foreach (getPermissionsForView() as $table => $permissions)
                                                    <tr>
                                                        <td>
                                                            <label class="control control-checkbox">
                                                                {{getPermissionTables()[$table]}}
                                                                <input type="checkbox"
                                                                       name="permissions[{{$table}}][]"
                                                                       id="{{$table}}"
                                                                       class="checkAll auto"
                                                                       data-table="{{$table}}"/>

                                                                <div class="control_indicator"></div>
                                                            </label>
                                                        </td>

                                                        @foreach ($permissions as $permission)

                                                            <td>
                                                                <label class="control control-checkbox">
                                                                    <span class="opacity-0">Hello</span>

                                                                    <input
                                                                        type="checkbox"
                                                                        class="permissionCheckbox"
                                                                        name="permissions[{{$table}}][]"
                                                                        value="{{$permission['value'] }}"
                                                                        data-table="{{$table}}"
                                                                        {{in_array($permission['value'], $rolePermissions) ? 'checked' : ''}}
                                                                        />

                                                                    <div class="control_indicator"></div>
                                                                </label>
                                                            </td>

                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                            <div class="card-footer">
                                                <button type="button"
                                                        class="btn btn-outline-danger"
                                                        data-dismiss="modal">
                                                        {{trans('main.close')}}
                                                </button>
                    
                                                <button type="submit"
                                                        class="btn btn-outline-success">
                                                        {{trans('main.update')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                       

                    </form>

                </div>


            </div>
        </div>
    </div>

@endsection

@push('js')

<script type="module" src="{{asset('js/role/editPage.js')}}"></script>

@endpush

