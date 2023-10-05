<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="editUserTitle">{{trans('user.edit user')}}</h5>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <x-text name="name" 
                                    :required="true" 
                                    label="{{trans('main.name')}}" />
                        </div>
                        <div class="col-6">
                            <x-text name="email" 
                                    :required="true" 
                                    label="{{trans('main.email')}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="text-capitalize font-weight-bold text-muted">
                            {{trans('main.role')}}
                           <i class="fa-solid fa-star-of-life" style="color:rgba(255, 0, 0, 0.778)"></i>
                        </label>
                        <select class="form-control basic role_edit"
                                name="role"
                                id="role" data-select2-id="role_edit">

                            <option>
                                {{trans('user.choose_roles')}}
                            </option>

                            @foreach ($roles as $role)
                                <option  class="active" value="{{$role->name}}">
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <x-text name="password"  
                                   label="{{trans('main.password')}}"/>
                        </div>
                        <div class="col-6">
                            <x-text name="password_confirmation"  
                                   label="{{trans('user.confirm_password')}}" />
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="image_edit">
                        <label>
                            {{trans('main.avatar')}}
                            <a href="javascript:void(0)"
                                class="custom-file-container__image-clear" title="Clear Image"></a></label>
                        <label class="custom-file-container__custom-file">
                            <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                accept="image/*" name="avatar">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control">
                                {{-- here is center  html js but not work --}}
                            </span>
                        </label>
                        <div class="custom-file-container__image-preview">
                            {{-- here is center tag img but not work --}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success">
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
