@extends('master')

@section('title')
    Students Note
@endsection

@push('css')

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{asset('adminRtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('adminAssets/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css">
    @endif


    <link href="{{asset('adminAssets/assets/css/apps/notes.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />

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
                            <span class="font-weight-bold mt-1">
                                {{trans('main.home_page')}}
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.note.studentIndex')}}"
                           class="d-flex justify-content-center align-items-center">

                            <i class="fa-solid fa-note-sticky mx-2 fa-2x"></i>
                            <span class="font-weight-bold ">
                                {{trans('student.student_notes')}}
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

        @include('pages.errorCreate')
        

        <div class="app-container">
            
            <div class="app-note-container">

                <div class="app-note-overlay"></div>

                <div class="tab-title">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 text-center">
                            @check_permission('store-studentNotes')
                            <a id="btn-add-notes" data-toggle="modal"
                            data-target="#createNoteModal" class="btn btn-primary">
                                {{trans('main.add')}}
                            </a>
                            @endcheck_permission
                        </div>
                        <div class="col-md-12 col-sm-12 col-12 mt-5">
                            <ul class="nav nav-pills d-block" id="pills-tab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link list-actions active" id="all-notes">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                            </path>
                                        </svg> 
                                            {{trans('student.all_notes')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link list-actions" id="note-fav">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                        </svg> 
                                        {{trans('main.favourites')}}
                                    </a>
                                </li>
                            </ul>

                            <hr/>

                            <p class="group-section">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                        </path>
                                        <line x1="7" y1="7" x2="7" y2="7"></line>
                                </svg>
                                         {{trans('main.tags')}}
                            </p>

                            <ul class="nav nav-pills d-block group-list" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link list-actions g-dot-primary" id="note-personal">
                                        {{trans('main.personal')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link list-actions g-dot-warning" id="note-work">
                                        {{trans('main.work')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link list-actions g-dot-success" id="note-social">
                                        {{trans('main.social')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link list-actions g-dot-danger" id="note-important">
                                        {{trans('main.important')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div id="ct" class="note-container note-grid">
                    
                    @foreach ($notes as $note)
                        <div class="note-item all-notes {{$note->is_favorite ? 'note-fav' : ''}} {{$note->type ? "note-$note->type" : ''}}">
                            <div class="note-inner-content">
                                <div class="note-content">
                                    <p class="note-title"> 
                                        <span>{{$note->title}}</span> 
                                    </p>
                                    <p class="note-title"> 
                                        {{trans('main.from')}}: 
                                        <span class="badge bg-secondary">{{$note->byText}}</span> 
                                    </p>
                                    <p class="meta-time">{{$note->created_at->diffForHumans()}}</p>
                                    <div class="note-description-content">
                                        <p class="note-description" data-noteDescription="Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.">{{$note->note}}</p>
                                    </div>
                                </div>
                                <div class="note-action">

                                    @check_permission('update-studentNotes')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fav-note noteFavoriteButton" data-href="{{route('admin.note.toggleFavorite',$note->id)}}"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    @endcheck_permission

                                    @check_permission('delete-studentNotes')
                                    <a href="{{route('admin.note.delete',$note->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                    @endcheck_permission

                                </div>

                                <div class="note-footer">
                                    @check_permission('update-studentNotes')
                                    <div class="tags-selector btn-group">
                                        <a class="nav-link dropdown-toggle d-icon label-group" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                            <div class="tags">
                                                <div class="g-dot-personal"></div>
                                                <div class="g-dot-work"></div>
                                                <div class="g-dot-social"></div>
                                                <div class="g-dot-important"></div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right d-icon-menu" data-href="{{route('admin.note.updateNoteType',$note->id)}}">
                                            <a class="note-personal label-group-item label-personal dropdown-item position-relative g-dot-personal" href="javascript:void(0);"> 
                                                 {{trans('main.personal')}}
                                            </a>
                                            <a class="note-work label-group-item label-work dropdown-item position-relative g-dot-work" href="javascript:void(0);">
                                                  {{trans('main.work')}}
                                            </a>
                                            <a class="note-social label-group-item label-social dropdown-item position-relative g-dot-social" href="javascript:void(0);"> 
                                                 {{trans('main.social')}}
                                            </a>
                                            <a class="note-important label-group-item label-important dropdown-item position-relative g-dot-important" href="javascript:void(0);"> 
                                                 {{trans('main.important')}}
                                            </a> 
                                        </div>
                                    </div>
                                    @endcheck_permission
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
            
        </div>



        <div class="modal fade" id="createNoteModal" tabindex="-1" role="dialog" aria-labelledby="createNoteModal"
        aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header card-header create__form__header">
                        <h5 class="modal-title font-weight-bold text-capitalize text-light" id="createNoteModalTitle">{{trans('student.notable_addition')}}</h5>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ route('admin.note.studentStore') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="noteby_id" value="{{auth()->guard(getGuard())->user()->id}}">

                            <div class="row">
                                <div class="col-md-12">
                                    <x-text name="title"
                                    :required="true"
                                    label="{{trans('main.title')}}"
                                    placeholder="{{trans('student.title_notes')}} ...."
                                    :value="old('title')" />
                                </div>

                                <div class="col-md-12">
                                    <x-textarea name="note"
                                    :required="true"
                                    label="{{trans('main.note')}}"
                                    placeholder="{{trans('main.note')}} ...."
                                    :value="old('note')" />
                                </div>
                            </div>

                            @if (getGuard() != 'student')
                                <div class="form-group my-2">
                                    <label
                                        class="font-weight-bold text-capitalize text-muted">{{trans('student.choose_student')}}</label>
                                        <i class="fa-solid fa-star-of-life required-star"></i>




                                        
                                        <select class="form-control my-2" 
                                                style="width: 100%;" 
                                                name="student_id"
                                                id="student_id"
                                            >
                                            <option value="">{{trans('student.choose_student')}}</option>
                                            @foreach($students as $student)
                                                <option value="{{$student->id}}">
                                                    {{$student->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    
                                    


                                    @error('student_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            @else
                                <input type="hidden" name="student_id" value="{{auth()->guard(getGuard())->user()->id}}">
                            @endif



                            <div class="modal-footer">
                                <button type="submit"
                                        class="btn btn-outline-dark">
                                        {{trans('main.save')}}
                                </button>

                                <button class="btn btn-outline-danger" data-dismiss="modal">
                                    <i class="flaticon-cancel-12"></i>
                                    {{trans('main.discard')}}
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

    {{-- <script src="{{asset('adminAssets/assets/js/apps/notes.js')}}"></script> --}}

    <script src="{{asset('js/note/studentNote.js')}}"></script>

    <script src="{{ asset('adminAssets/plugins/select2/select2.min.js') }}"></script>

    <script>
         $('#student_id').select2({
            dropdownParent: $('#createNoteModal'),
        });
    </script>

@endpush

