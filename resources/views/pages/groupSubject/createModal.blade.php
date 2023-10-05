<div class="modal fade" id="creatGroupSubjectModal" tabindex="-1" role="dialog" aria-labelledby="creatGroupSubjectModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-titlefont-weight-bold text-capitalize text-light" id="creatGroupSubjectModal">
                  {{trans('subject.add_subject_to_group')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.group_subjects.store') }}" method="post">
                    @csrf
                    <div class="row">
                        @if (!isset($group))
                            <div class="col-6">
                        @else
                            <div class="col-12">
                        @endif
                            <div class="form-group row mb-4">
                                <label for="age_type"
                                       class="col-xl-12 col-form-label text-dark text-capitalize font-weight-bold">
                                  {{trans('subject.choose_subject')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic group_subject_create" 
                                            style="width: 100%;" 
                                            name="subject_id" 
                                            id="subject_id" data-select2-id="group_subject_create">
                                        <option value="">
                                            {{trans('subject.choose_subject')}}
                                        </option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            @if (!isset($group))
                            <div class="form-group row mb-4">
                                <label for="age_type"
                                       class="col-xl-12 col-form-label text-dark text-capitalize font-weight-bold">
                                       {{trans('group.choose_group')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic group_create" 
                                    style="width: 100%;" 
                                    name="group_id" 
                                    id="group_id" data-select2-id="group_create"
                                            data-href="{{ route('admin.group_subjects.getGroupSubjects') }}">
                                        <option value="">
                                            {{trans('group.choose_group')}}
                                        </option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"
                                                    {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                                {{ $group->name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="group_id" id="group_id" value="{{ $group->id }}"
                                   data-groupid="{{ $group->id }}">
                        @endif
                        </div>
                       
                    </div>

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
