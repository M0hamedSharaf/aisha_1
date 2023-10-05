<div class="modal fade" id="creatTeacherModal" tabindex="-1" role="dialog" aria-labelledby="creatTeacherModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="creatTeacherModal">
                    {{trans('teacher.create_teacher')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <x-text name="name" 
                                    :required="true" 
                                    placeholder="{{trans('teacher.enter_the_teachername')}}" 
                                    label="{{trans('main.name')}}" 
                                    :value="old('name')" 
                                    :required="true" />
                        </div>
                        <div class="col-6">
                            <x-text name="email" 
                                    :required="true" 
                                    placeholder="{{trans('teacher.enter_the_e-mail')}}" 
                                    label="{{trans('main.email')}}" 
                                    :value="old('email')" 
                                    :required="true" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-text name="password" 
                                    :required="true" 
                                    placeholder="{{trans('teacher.enter_password')}}"  
                                    label="{{trans('main.password')}}" 
                                    :value="old('password')" 
                                    :required="true" />
                        </div>
                        <div class="col-6">
                            <x-text name="password_confirmation" 
                                    :required="true" 
                                    label="{{trans('teacher.confirm_password')}}" 
                                    placeholder="{{trans('teacher.confirm_password')}}"
                                    :required="true" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-text name="qualification" 
                                    :required="true"  
                                    placeholder="{{trans('teacher.Enter_teacher_qualification')}}" 
                                    label="{{trans('main.qualification')}}" 
                                    :value="old('qualification')" />
                        </div>
                        <div class="form-group col-6">
                            <label for="role" class="text-capitalize font-weight-bold text-muted">
                                {{trans('user.choose_roles')}}
                                <i class="fa-solid fa-star-of-life required-star"></i>
                            </label>
                            <select class="form-control basic role_create"
                                    name="role"
                                    id="role" data-select2-id="role_create">
                                <option >
                                    {{trans('main.roles')}}
                                </option>
    
                                @foreach ($roles as $role)
    
                                    <option  class="active" value="{{$role->name}}">{{$role->name}}</option>
    
                                @endforeach
                            </select>
                            @error('role')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-date name="birthday" 
                                    label="{{trans('main.birthday')}}" 
                                    :value=" old('birthday')" />
                                   
                        </div>
                        <div class="col-6">
                            <x-text name="phone" 
                                    :required="true" 
                                    placeholder="{{trans('teacher.enter_the_teacher\'s_phone')}}" 
                                    label="{{trans('main.phone')}}" 
                                    :value="old('phone')" />
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="image_create">
                        <label>
                            {{trans('main.avatar')}}
                            <a href="javascript:void(0)"
                                class="custom-file-container__image-clear"
                               title="Clear Image">

                            </a>
                        </label>
                        <label class="custom-file-container__custom-file">

                            <input type="file"
                                   class="custom-file-container__custom-file__custom-file-input"
                                accept="image/*"
                                   name="avatar">

                            <input type="hidden"
                                   name="MAX_FILE_SIZE"
                                   value="10485760" />

                            <span class="custom-file-container__custom-file__custom-file-control"></span>

                        </label>

                        <div class="custom-file-container__image-preview"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark">
                            {{trans('main.save')}}
                        </button>
                        <button class="btn btn-outline-danger" data-dismiss="modal"><i
                                class="flaticon-cancel-12"></i>
                            {{trans('main.discard')}}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
