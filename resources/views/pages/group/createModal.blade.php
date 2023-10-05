<div class="modal fade" id="creatGroupModal" tabindex="-1" role="dialog" aria-labelledby="creatGroupModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light"
                    id="creatGroupModal">
                   {{trans('group.create_group')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.group.store') }}" method="post">
                    @csrf

                    <x-text name="name" id="from_create" 
                        :required="true" 
                        placeholder="{{trans('group.enter_the_group_name')}}" 
                        label="{{trans('group.group_name')}}" :value="old('name')"/>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row mb-4">
                                <label for="age_type"
                                       class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">
                                    {{trans('group.choose_teacher')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic teacher_create" 
                                            style="width: 100%;" 
                                            name="teacher_id" 
                                            id="teacher_id" data-select2-id="teacher_create">
                                        <option value="">
                                            {{trans('group.choose_teacher')}}
                                        </option>
                                        @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('teacher_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
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
                                    <select class="form-control basic group_type_create" 
                                            style="width: 100%;" 
                                            name="group_type_id"
                                            id="groupTypeId" data-select2-id="group_type_create">
                                        <option value="">
                                            {{trans('group.choose_type_of_group')}}
                                        </option>
        
                                        @foreach ($groupTypes as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('group_type_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
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
                                    <select class="form-control basic group_age_create" 
                                            style="width: 100%;" 
                                            name="age_type" 
                                            id="ageType" data-select2-id="group_age_create">
                                        <option value="">
                                            {{trans('group.age_type')}}
                                        </option>
                                        <option value="Kid" {{ old('age_type') == 'Kid' ? 'selected' : '' }}>
                                             {{trans('main.kids')}}
                                        </option>
                                        <option value="Adult" {{ old('age_type') == 'Adult' ? 'selected' : '' }}>
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