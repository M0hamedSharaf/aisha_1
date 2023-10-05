<div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="editGroup" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light"
                    id="editGroup">
                    {{trans('group.edite_group')}}
                </h5>
            </div>
            <div class="modal-body">
                <form id="editGroupForm" method="post">
                    @csrf
                    @method('PUT')

                    <x-text name="name" :required="true"  
                            label="{{trans('group.group_name')}}" 
                            id="name"/>
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row mb-4">
                                <label for="teacherId"
                                       class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                                       {{trans('group.choose_teacher')}}
                                       <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select id="teacherId" 
                                            class="form-control basic teacher_edit" 
                                            style="width: 100%;" 
                                            name="teacher_id" data-select2-id="teacher_edit">
                                        <option value="">
                                            {{trans('group.choose_teacher')}}
                                        </option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row mb-4">
                                <label for="age_type"
                                       class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                                       {{trans('group.choose_type_of_group')}}
                                       <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic group_type_edit" 
                                            style="width: 100%;" 
                                            name="group_type_id"
                                            id="groupTypeId" data-select2-id="group_type_edit">
                                        <option value="">
                                            {{trans('group.choose_type_of_group')}}
                                        </option>
                                        @foreach ($groupTypes as $groupType)
                                            <option value="{{ $groupType->id }}">
                                                {{ $groupType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('group_type_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row mb-4">
                                <label for="age_type"
                                       class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                                       {{trans('group.age_type')}}
                                       <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic" style="width: 100%;" name="age_type" id="ageType">
                                        <option value="kid">
                                            {{trans('main.kids')}}
                                        </option>
                                        <option value="adult">
                                            {{trans('main.adults')}}
                                        </option>
                                    </select>
                                    @error('age_type')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-outline-dark">
                                {{trans('main.update')}}
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
