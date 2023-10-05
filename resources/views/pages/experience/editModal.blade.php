<div class="modal fade" id="editexperience" tabindex="-1" role="dialog" aria-labelledby="editexperience"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title text-white" id="editexperience">
                    {{trans('teacher.edite_teacher')}}
                </h5>
            </div>
            <div class="modal-body">
                <form id="editExperienceForm" method="post">
                    @csrf
                    @method('PUT')

                    <x-text name="title" 
                            :required="true" 
                            label="{{trans('main.experience')}}" 
                            id="title"/>

                    <div class="row">
                        <div class="col-6">
                            <x-date :required="true" 
                                    name="from" 
                                    label="{{trans('main.from')}}" 
                                    id="from"/>
                        </div>
                        <div class="col-6">
                            <x-date :required="true" 
                                    name="to" 
                                    label="{{trans('main.to')}}" 
                                    id="to"/>
                        </div>
                    </div>

                    @if (!isset($teacher))
                        <div class="form-group row mb-4">
                            <label for="age_type"
                                   class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                               {{trans('teacher.choose_the_teacher')}}
                                <i class="fa-solid fa-star-of-life" style="color:rgba(246, 14, 14, 0.866)"></i>
                        </label>
                            <div class="col-xl-12 ">
                                <select id="teacherId" class="form-control basic experience_edit" style="width: 100%;" name="teacher_id"
                                         data-select2-id="experience_edit">
                                    <option value="">
                                        {{trans('teacher.choose_the_teacher')}}
                                    </option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="teacher_id" id="teacherId" value="{{ $teacher->id }}">
                    @endif
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-outline-info">
                               {{trans('main.save')}}
                            </button>
                        <button class="btn btn-outline-dark" data-dismiss="modal">
                            <i class="flaticon-cancel-12"></i>
                           {{trans('main.discard')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
