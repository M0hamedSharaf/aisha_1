<div class="modal fade" id="creatStudentModal" tabindex="-1" role="dialog" aria-labelledby="creatStudentModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="creatStudentModal">
                   {{trans('student.add_a_student')}}
                </h5>
            </div>
            <div class="modal-body ">
                <form action="{{ route('admin.student.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <x-text name="name"
                            :required="true"
                            label="{{trans('main.name')}}"
                            placeholder="{{trans('student.add_a_student')}}"
                            :value="old('name')"/>
                        </div>
                        <div class="col-6">
                            <x-text name="email"
                            :required="true"
                            label="{{trans('main.email')}}"
                            placeholder="{{trans('student.enter_the_e-mail')}}"
                            :value="old('email')"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-text name="password"
                            :required="true"
                            label="{{trans('main.password')}}"
                            placeholder="{{trans('student.enter_password')}}"
                            :value="old('password')"/>
                        </div>
                        <div class="col-6">
                            <x-text name="password_confirmation"
                            :required="true"
                            label="{{trans('student.confirm_password')}}"
                            placeholder="{{trans('student.confirm_password')}}" />
                        </div>
                    </div>
                   
                    <div class="form-group my-2">
                        <label
                            class="font-weight-bold text-capitalize text-muted"> {{ trans('roles.choose_role') }} </label>
                            <i class="fa-solid fa-star-of-life required-star"></i>
                        <select class="form-control my-2 role_create" style="width: 100%;"
                                name="role"
                                id="role" data-select2-id="role_create">
                            <option value="">
                                {{ trans('roles.choose_role') }}
                            </option>
                            @forelse($roles as $role)
                                <option value="{{$role->name}}">
                                    {{$role->name}}
                                </option>
                            @empty
                                <option value="">
                                    No Roles Founded
                                </option>
                            @endforelse
                        </select>
                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <x-date name="birthday"
                            label="{{trans('main.birthday')}}"
                            :value="old('birthday')"/>
                        </div>
                        <div class="col-4">
                            <x-text name="phone"
                            :required="true"
                            label="{{trans('main.phone')}}"
                            placeholder="{{trans('student.enter_the_student\'s_phone')}}"
                            :value="old('phone')"/>
                        </div>
                        <div class="col-4">
                            <x-text name="qualification"
                            label="{{trans('main.qualification')}}"
                            placeholder="{{trans('student.enter_student_qualification')}}"
                            :value="old('qualification')"/>
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>
                            {{trans('main.avatar')}}
                            <a href="javascript:void(0)"
                               class="custom-file-container__image-clear"
                               title="Clear Image">
                            </a>
                        </label>
                        <label class="custom-file-container__custom-file">
                            <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                   accept="image/*" name="avatar">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
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
