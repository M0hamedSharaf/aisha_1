@extends('master')

@section('title')
    Users Table
@endsection

@push('css')

    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" 
              rel="stylesheet" 
              type="text/css">
    @else
        <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @endif

    <link href="{{asset('adminAssets/assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
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
                            <a href="{{route('admin.user.index')}}"
                               class="d-flex justify-content-center align-items-center">

                                <i class="fa-solid fa-user-lock fa-2x mx-2"></i>
                                <span class="font-weight-bold ">
                                    {{trans('main.users')}}
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
                                {{trans('main.settings')}}
                            </h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.setting.store', $setting->id)}}" enctype="multipart/form-data">
                                @csrf

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4" style="min-width: 800px">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('main.name') }}</th>
                                                <th>{{ trans('main.value') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ trans('main.logo') }}</td>
                                                <td>
                                                    <input type="file" name="logo" id="logo">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('site.welcome_text_1') }}</td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_text_1_en" placeholder="{{ trans('site.welcome_text_1_english') }}" value="{{$setting->welcome_text_1->en ?? old('welcome_text_1_en')}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_text_1_ar" placeholder="{{ trans('site.welcome_text_1_arabic') }}" value="{{$setting->welcome_text_1->ar ?? old('welcome_text_1_ar')}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('site.welecom_text_2') }}</td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_text_2_en" placeholder="{{ trans('site.welecom_text_2_english') }}" value="{{$setting->welcome_text_2->en ?? old('welcome_text_2_en')}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_text_2_ar" placeholder="{{ trans('site.welecom_text_2_arabic') }}" value="{{$setting->welcome_text_2->ar ?? old('welcome_text_2_ar')}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('site.welcome_btn_1') }}</td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_btn_1_en" placeholder="{{ trans('site.welcome_btn_1_english') }}" value="{{$setting->welcome_btn_1->en ?? old('welcome_btn_1_en')}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_btn_1_ar" placeholder="{{ trans('site.welcome_btn_1_arabic') }}" value="{{$setting->welcome_btn_1->ar ?? old('welcome_btn_1_ar')}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('site.welcome_btn_2') }}</td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_btn_2_en" placeholder="{{ trans('site.welcome_btn_2_english') }}" value="{{$setting->welcome_btn_2->en ?? old('welcome_btn_2_en')}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="welcome_btn_2_ar" placeholder="{{ trans('site.welcome_btn_2_arabic') }}" value="{{$setting->welcome_btn_2->ar ?? old('welcome_btn_2_ar')}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('site.welcome_img') }}</td>
                                                <td>
                                                    <input type="file" name="welcome_img" id="welcome_img">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="card-footer">
                                    <button class="btn btn-primary">
                                        {{ trans('main.submit') }}
                                    </button>
                                </div>
                        </form>

                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('js')
@endpush
