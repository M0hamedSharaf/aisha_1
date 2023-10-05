<div class="modal fade" id="creatExperienceModal" tabindex="-1" role="dialog" aria-labelledby="creatExperienceModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title text-white" id="creatExperienceModal">
                    {{trans('experience.add_teacher_experience')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.experience.store') }}" method="post">
                    @csrf

                    <x-text name="title" 
                    :required="true" 
                    placeholder="{{trans('experience.add_teacher_experience')}}" 
                    label="{{trans('main.experience')}}"  
                    :value="old('title')"/>

                    <div class="row">
                        <div class="col-6">
                           <x-date name="from" 
                                   :required="true" 
                                   id="from" 
                                   label="{{trans('main.from')}}" 
                                   :value="old('from')"/>
                        </div>
                        <div class="col-6">
                            <x-date name="to" 
                                    :required="true" 
                                    id="to" 
                                    label="{{trans('main.to')}}" 
                                    :value="old('to')"/>
                        </div>
                    </div>

                    @if (!isset($teacher))
                        <div class="form-group row mb-4">
                            <label for="age_type" class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                                {{trans('teacher.choose_the_teacher')}}
                                 <i class="fa-solid fa-star-of-life" style="color:rgba(246, 14, 14, 0.866)"></i>
                                </label>
                            <div class="col-xl-12">
                                <select class="form-control basic experience_create" 
                                        name="teacher_id"
                                        id="teacher_id" data-select2-id="experience_create">
                                    <option value=""> {{trans('teacher.choose_the_teacher')}}</option>
                                    @foreach ($teachers as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('teacher_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
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
