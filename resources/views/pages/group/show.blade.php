@extends('master')

@section('title')
    Group | {{$group->name}}
@endsection


@push('css')

    <link href="{{asset('adminAssets/assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('adminRtl/assets/css/forms/theme-checkbox-radio.css') }}">

    @if(LaravelLocalization::getCurrentLocale() =='ar')
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/users/user-profile.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/components/custom-modal.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/assets/css/components/cards/card.css') }}"/>
       <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">

       <link rel="stylesheet"
        type="text/css"
        href="{{ asset('adminRtl/plugins/file-upload/file-upload-with-preview.min.css') }}"/>
        
    @else
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/users/user-profile.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/components/custom-modal.css') }}"/>

        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/assets/css/components/cards/card.css') }}"/>
      <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">

      <link rel="stylesheet"
            type="text/css"
            href="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.css') }}"/>
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
                            <span class="font-weight-bold mt-1">{{trans('main.home')}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.group.index')}}"
                           class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-users-rays fa-2x mx-2"></i>
                            <span class="font-weight-bold ">
                                {{ trans('main.groups') }}
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.group.index')}}"
                           class="d-flex justify-content-center align-items-center">
                            <i class="fa-regular fa-folder-open fa-2x mx-2"></i>
                            <span class="font-weight-bold ">{{ $group->name }}</span>
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



                        @include('pages.group.partials.teacher')



                        
                    </div>
                    <div class="col-xl-6 col-sm-12">



                        @include('pages.group.partials.groupDays')




                    </div>
                </div>

                <div class="row">



                    @include('pages.group.partials.paymentChart')
                    @include('pages.group.partials.payment')
                    @include('pages.group.partials.students')
                    @include('pages.group.partials.subjects')



                </div>
               
            </div>
        </div>
    </div>

    @include('pages.groupStudent.createModal')
    @include('pages.groupSubject.createModal')
    @include('pages.groupDays.createModal')
    @include('pages.teacher.editModal')

@endsection

@vite(['resources/js/group/payment.js'])

@push('js')
    <script type="module" src="{{ asset('js/payment/groupShow.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/shared/chart.js') }}"></script>
    <script src="{{ asset('adminAssets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    
    <script>
        initEditeTeacherModal()
    </script>

    <script>
        $('#creatGroupDayModal').on('shown.bs.modal', function (e) {
            let href = $(this).data('href');
            let group_id = $('#group_id').data('groupid');
            $(`option`).removeAttr('disabled').css({
                'color': 'black'
            });

            console.log(href);
            $.ajax({
                url: href,
                data: {
                    group_id
                },
                success: function (response) {
                    let groupDays = response.groupDays
                    console.log(groupDays);
                    groupDays.forEach(element => {
                        let groupDay = element.day
                        $(`option[value=${groupDay}]`).attr('disabled', true).css({
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
        $('#creatGroupStudentModalInGroupShow').on('click', function () {

            let href = $(this).data('href');
            let group_id = $(this).data('group_id');

            $(`option`).removeAttr('disabled').css({
                'color': 'black'
            });
            $.ajax({
                url: href,
                data: {
                    group_id
                },
                success: function (response) {
                    let groupStudents = response.groupStudents

                    groupStudents.forEach(element => {
                        let student = element.student_id

                        $(`#student_id option[value=${student}]`).attr('disabled', true).addClass('text-danger')
                    });
                },
                error: function () {
                }
            })
        })
    </script>
    <script>
        $('#creatGroupSubjectModalInGroupShow').on('click', function () {

            let href = $(this).data('href');
            let group_id = $(this).data('group_id');

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
        $('.student_create').select2({
            dropdownParent: $('#creatGroupStudentModal'),
        });
        $('.role_edit').select2({
            dropdownParent: $('#editTeacher'),
        });
        $('.group_subject_create').select2({
            dropdownParent: $('#creatGroupSubjectModal'),
        });
    </script>

    <script>
        var image_edit = new FileUploadWithPreview('image_edit')
    </script>
@endpush
