@php use Mcamara\LaravelLocalization\Facades\LaravelLocalization; @endphp
@extends('master')

@section('title')
    Subjects Table
@endsection


@push('css')
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminRtl/plugins/file-upload/file-upload-with-preview.min.css') }}"
        />
        <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @else
        <link rel="stylesheet"
              type="text/css"
              href="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.css') }}"/>
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
                        <a href="{{route('admin.subject.index')}}"
                           class="d-flex justify-content-center align-items-center">
                            
                           <i class="fa-solid fa-book fa-2x mx-2"></i>
                           <span class="font-weight-bold ">
                               {{trans('subject.prescribed_curriculum')}}
                           </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.subject.create')}}"
                           class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-book-open fa-2x mx-2"></i>
                            <span class="font-weight-bold "> 
                                {{trans('subject.add_a_new_curriculum')}}
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
            <div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 card-header create__form__header">
                                <h4 class="text-center font-weight-bold text-capitalize text-light">
                                    {{trans('subject.add_a_new_curriculum')}}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{ route('admin.subject.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <x-text name="name" :required="true" 
                                 label="{{trans('subject.subject_name')}}" :value="old('name')"/>

                            <div class="form-group row mb-4">
                                <label for="book"
                                       class="col-xl-12 col-md-6 col-form-label text-dark text-capitalize font-weight-bold">
                                       {{trans('subject.book_pdf')}}
                                       <i class="fa-solid fa-star-of-life required-star"></i>
                                    </label>
                                <div class="col-xl-12 col-md-6">
                                    <div class="custom-file-container" data-upload-id="myFirstImage1">
                                        <label><a href="javascript:void(0)"
                                                         class="custom-file-container__image-clear" title="Clear Image"></a></label>
                                        <label class="custom-file-container__custom-file">

                                            <input type="file"
                                                   class="custom-file-container__custom-file__custom-file-input"
                                                   accept="application/pdf"
                                                   name="book">

                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>

                                            <span class="custom-file-container__custom-file__custom-file-control"></span>

                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    @error('book')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="book"
                                       class="col-xl-12 col-md-6 col-form-label text-dark text-capitalize font-weight-bold">
                                       {{trans('subject.book_cover_photo')}}
                            </label>
                                <div class="col-xl-12 col-md-6">
                                    <div class="custom-file-container" data-upload-id="myFirstImage2">
                                        <label> <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                                   title="Clear Image"></a></label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file"
                                                   class="custom-file-container__custom-file__custom-file-input"
                                                   accept="image/*" name="avatar">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-outline-dark">
                                        {{trans('subject.download_the_book')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script>
        var firstUpload1 = new FileUploadWithPreview('myFirstImage1')
        var firstUpload2 = new FileUploadWithPreview('myFirstImage2')
    </script>

@endpush