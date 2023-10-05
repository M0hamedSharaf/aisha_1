@extends('master')

@section('title')
    Student Lesson Show
@endsection


@push('css')

    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/plugins/table/datatable/datatables.css') }}">

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/users/user-profile.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/scrollspyNav.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/components/timeline/custom-timeline.css') }}"/>

              <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @else

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/plugins/table/datatable/datatables.css') }}">

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/users/user-profile.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/scrollspyNav.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/components/timeline/custom-timeline.css') }}"/>

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
                        <li class="">
                            <a href="{{route('admin.group.index')}}"
                               class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-users-rays fa-2x mx-2"></i>
                                <span class="font-weight-bold ">المجموعات</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.student.show', $studentLesson->student_id) }}"
                               class="d-flex justify-content-center align-items-center">
                                <i class="fa-regular fa-folder-open fa-2x mx-2"></i>
                                <span class="font-weight-bold ">{{$studentLesson->student->name}}</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('admin.student.show', $studentLesson->student_id) }}"
                               class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-file-circle-check fa-2x mx-2"></i>
                                <span class="font-weight-bold ">
                                    {{ $studentLesson->lesson->title ?? '' }}
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
                <div class="row">
                    <div class="col-xl-6 col-sm-12">


                        @include('pages.studentLesson.partials.sectionOne')

                    </div>
                    <div class="col-xl-6 col-sm-12">


                        @include('pages.studentLesson.partials.sectionTwo')

                    </div>
                </div>
                <div class="row">

                    
                    @include('pages.studentLesson.partials.sectionThird')
                    @include('pages.studentLesson.partials.newLessons')
                    @if ($studentLessonReview)
                    @include('pages.studentLesson.partials.studentLessonReview')
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection



    {{-- <script src="{{ asset('adminAssets/plugins/table/datatable/datatables.js') }}"></script> --}}
