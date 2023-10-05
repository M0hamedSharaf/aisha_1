@extends('master')

@section('title')
    Teacher | {{$teacher->name}}
@endsection


@push('css')
      @if (LaravelLocalization::getCurrentLocale() == 'ar')
            <link href="{{ asset('adminRtl/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/myStylesAr.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/elements/breadcrumb.css') }}" rel="stylesheet" type="text/css">
            <link rel="stylesheet" type="text/css"
                  href="{{ asset('adminRtl/plugins/file-upload/file-upload-with-preview.min.css') }}" />
      @else
            <link href="{{ asset('adminAssets/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/elements/breadcrumb.css') }}" rel="stylesheet" type="text/css">
            <link rel="stylesheet" type="text/css"
                  href="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.css') }}" />
      @endif
      <link href="{{ asset('adminAssets/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />

      <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/plugins/select2/select2.min.css') }}">

      <link rel="stylesheet" href="{{ asset('css/student.css') }}">
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
                            <a href="{{route('admin.teacher.index')}}"
                               class="d-flex justify-content-center align-items-center">
    
                                <i class="fa-solid fa-users fa-2x mx-2"></i>
                                <span class="font-weight-bold ">
                                    {{trans('teacher.teaching_staff')}}                                
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{route('admin.teacher.index')}}"
                               class="d-flex justify-content-center align-items-center">
    
                                 <i class="fa-solid fa-user-check fa-2x mx-2"></i>
                                <span class="font-weight-bold ">{{ $teacher->name }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
      </div>
@endsection

@section('content')
      @include('pages.errorCreate')

      <!-- Start Content -->
      <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing"
            data-href="{{ route('admin.teacher.getTeacherShowDataAjax', $teacher->id) }}" id="showTeacherAjaxContainer">

            @include('pages.teacher.partials.profile')

      </div>
      <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            @include('pages.teacher.partials.statistics')

            @include('pages.teacher.partials.experienceChart')

      </div>

      @include('pages.teacher.partials.experience')

      @include('pages.teacher.partials.students')

      @include('pages.teacher.editModal')

      @include('pages.teacher.partials.studentLessonsModal')

      @include('pages.teacher.partials.addStudentLessonsModal')

      @include('pages.student.partials.showLesson')
@endsection


@vite(['resources/js/teacher/experience.js'])

@push('js')
      <script src="{{ asset('adminAssets/plugins/pdf/pdf.js') }}"></script>
      <script src="{{ asset('js/invoice-list.js') }}"></script>
      <script src="{{ asset('js/experience.js') }}"></script>

      <script type="module" src="{{ asset('js/teacher/show.js') }}"></script>

      <script>
            initEditeTeacherModal()
      </script>

      <script src="{{ asset('adminAssets/plugins/select2/select2.min.js') }}"></script>

      <script>
            $('.role_edit').select2({
                  dropdownParent: $('#editTeacher'),
            });
      </script>

      <script src="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
      <script>
            var image_edit = new FileUploadWithPreview('image_edit')
      </script>
@endpush
