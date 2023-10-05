@extends('master')

@section('title')
    Dashboard Home
@endsection

@push('css')
    <!-- BEGIN THEME GLOBAL STYLES -->
   

    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{asset('adminRtl/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset('adminAssets/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
    @endif

    <link href="{{asset('adminAssets/plugins/fullcalendar/custom-fullcalendar.advance.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('adminAssets/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('adminAssets/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('adminAssets/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('adminAssets/assets/css/components/custom-counter.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <!-- END THEME GLOBAL STYLES -->
@endpush

@section('breadcrumb')
<div class="col-md-12">
    <div class="breadcrumb bg-transparent">

        <div class="breadcrumb-four">
            <ul class="breadcrumb">
                <li class="active">
                    <a href="{{route('admin.home')}}"
                       class="d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-house mx-2 fa-2x"></i>
                        <span class="font-weight-bold mt-1">
                            {{trans('main.home_page')}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="text-center w-100">



        <div class="row mb-5">
            <div class="col-12">

                @include('pages.home.partials.statistics')
            
            </div>
        </div>



        <div class="row mb-5">
            <div class="col-12">
                @include('pages.home.partials.calendar')
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card" style="min-height: 550px">
                    <div class="card-header card__header__for_tables">
                        <h3 class="text-white">{{trans('group.group_ages')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="" id="groupAgesChart" data-href="{{ route('admin.group.groupAgesChartData') }}">

                            <div class="" id="groupAgesChartCanvaParent" style="position: relative;height: 500px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="card" style="min-height: 550px">
                    <div class="card-header card__header__for_tables">
                        <h3 class="text-white"> {{trans('payment.total_payments')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="" id="totalPaymentsChart" data-href="{{ route('admin.payment.totalPaymentsChartData') }}">

                            <div class="" id="totalPaymentsChartCanvaParent" style="position: relative;height: 500px;">
                                {{-- <canvas id="totalPaymentsChartCanva"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        {{-- <div class="px-3" id="paymentsThisMonthContainer"
            data-href="{{ route('admin.payment.getPaymentPerMonthThisYear') }}">

            <div class="row align-items-center">
                <div class="col-8 layout-spacing" id="canvas">
                    <div id="content-tables-search">
                        <!-- content tables search -->
                    </div>
                    <canvas id="paymentsThisMonthChart">
                        <!-- payments this month chart -->
                    </canvas>
                </div>

                <div class="col-4 layout-spacing">
                    
                </div>
            </div>

        </div> --}}


    </div>
@endsection

@vite(['resources/js/home/home.js'])

@push('js')
    
    <script src="{{asset('adminAssets/plugins/fullcalendar/moment.min.js')}}"></script>

    <script src="{{ asset('adminAssets/plugins/flatpickr/flatpickr.js') }}"></script>

    <script src="{{asset('adminAssets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <script src="{{asset('adminAssets/plugins/fullcalendar/locale/ar.js')}}"></script>
    @endif

    <script src="{{asset('adminAssets/plugins/counter/jquery.countTo.js')}}"></script>

    <script type="module" src="{{asset('js/home/home.js')}}"></script>
@endpush
