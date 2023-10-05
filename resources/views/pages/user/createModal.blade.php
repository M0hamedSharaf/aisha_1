<div class="modal fade" id="creatUserModal" tabindex="-1" role="dialog" aria-labelledby="creatUserModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="creatUserModalTitle">{{trans('user.add_user')}}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <x-text name="name" 
                                    :required="true" 
                                    placeholder="{{trans('user.enter_the_username')}}" 
                                    label="{{trans('main.name')}}" 
                                    :value="old('name')"/>
                           
                        </div>
                        <div class="col-6">
                            <x-text name="email" 
                                    :required="true" 
                                    placeholder="{{trans('user.enter_the_e-mail')}}" 
                                    label="{{trans('main.email')}}" 
                                    :value="old('email')" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="text-capitalize font-weight-bold text-muted">
                            {{trans('main.role')}}
                            <i class="fa-solid fa-star-of-life required-star"></i>
                        </label>
                        <select class="form-control basic role_create"
                                name="role"
                                id="role" data-select2-id="role_create">
                            <option >
                                {{trans('roles.choose_role')}}
                            </option>

                            @foreach ($roles as $role)

                                <option  class="active" value="{{$role->name}}">{{$role->name}}</option>

                            @endforeach
                        </select>
                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-text name="password" 
                                    :required="true" 
                                    placeholder="{{trans('user.enter_password')}}" 
                                    label="{{trans('main.password')}}" 
                                    :value="old('password')" />
                        </div>
                        <div class="col-6">
                            <x-text name="password_confirmation" 
                                    :required="true" 
                                    placeholder="{{trans('user.confirm_password')}}" 
                                    label="{{trans('user.confirm_password')}}" />
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
                        <button type="submit" class="btn btn-outline-primary">
                            {{trans('main.save')}}
                        </button>
                        <button class="btn btn-outline-danger" data-dismiss="modal">
                            {{trans('main.discard')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
