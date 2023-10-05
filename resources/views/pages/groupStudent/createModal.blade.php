<div class="modal fade" id="creatGroupStudentModal" tabindex="-1" role="dialog" aria-labelledby="creatGroupStudentModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-titlefont-weight-bold text-capitalize text-light" id="creatGroupStudentModalTitle">
                    {{trans('group.create_group_student')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.group_students.store') }}" method="post">
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
                                    {{trans('student.choose_student')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic student_create" 
                                            style="width: 100%;" 
                                            name="student_id"  data-href="{{ route('admin.group_students.getStudentGroups') }}"
                                            id="student_id" data-select2-id="student_create">
                                        <option value=""> 
                                            {{trans('student.choose_student')}}
                                        </option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}"
                                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
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
                                    <select class="form-control basic" style="width: 100%;" name="group_id" id="group_id"
                                            data-href="{{ route('admin.group_students.getGroupStudents') }}">
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
