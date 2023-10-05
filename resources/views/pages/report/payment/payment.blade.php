@extends('master')

@push('css')
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
                            <span class="font-weight-bold mt-1">{{__('global.home')}}</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.report.payment')}}"
                           class="d-flex justify-content-center align-items-center">

                            <i class="fa-solid fa-users-gear fa-2x mx-2"></i>
                            <span class="font-weight-bold ">Payments Report</span>
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
                            تقارير المدفوعات
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="" id="totalPaymentsChartCanvaParent" style="position: relative;height: 500px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@vite(['resources/js/report/payment.js'])

@push('js')

@endpush

