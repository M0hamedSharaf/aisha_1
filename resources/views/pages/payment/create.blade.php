@extends('master')

@section('title')
    Payments Create
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/plugins/select2/select2.min.css') }}">
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('adminAssets/assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('adminAssets/assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('adminAssets/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link rel="{{ asset('adminAssets/stylesheet" type="text/css') }}" href="plugins/select2/select2.min.css">
    <!--  END CUSTOM STYLE FILE  -->
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
       <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @else
       <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
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
                    <li class="">
                        <a href="{{route('admin.payment.index')}}"
                           class="d-flex justify-content-center align-items-center">

                           <i class="fa-solid fa-file-invoice-dollar fa-2x mx-2"></i>
                            <span class="font-weight-bold ">
                                {{trans('payment.payment_statement')}}
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.payment.create')}}"
                           class="d-flex justify-content-center align-items-center">

                            <i class="fa-solid fa-circle-dollar-to-slot fa-2x mx-2"></i>
                            <span class="font-weight-bold ">
                                {{trans('payment.payment_registration')}}
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
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row invoice layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="app-hamburger-container">
                        <div class="hamburger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="doc-container">
                        <div class="tab-title">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="search">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                    <ul class="nav nav-pills inv-list-container d-block ps ps--active-y groupsContainer" id="pills-tab"
                                        role="tablist" data-href="{{route('admin.group.getAllGroupsForPayment')}}">
                                        


                                        





                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 409px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 112px;">
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-container">
                            <div class="invoice-inbox ps ps--active-y" style="height: calc(100vh - 215px);">





                                <div id="ct" class="" style="display: block;">
                                    





                                </div>






                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 50px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 3px;"></div>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 50px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 3px;"></div>
                                </div>
                            </div>

                            <div class="inv--thankYou" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <p class="">Thank you for doing Business with us.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com">DesignReset</a>,
                    All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-heart">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                        </path>
                    </svg>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module" src="{{ asset('js/payment/payment.js') }}"></script>
@endpush
