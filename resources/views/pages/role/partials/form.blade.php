<div class="form-group mb-3 w-100">
    <label for="name" class="text-capitalize font-weight-bold ">
        {{trans('roles.role_name')}}
    </label>

    <input name="name"
           class="form-control w-100 text-capitalize text-muted "
           placeholder="{{trans('roles.role_name')}}"
           value=" {{old('name',$role->name ?? '')}}"/>
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3 w-100">
    <label for="display_name" class="text-capitalize font-weight-bold ">
        {{trans('roles.display_name')}}
    </label>
    <input name="display_name"
           class="form-control w-100 text-capitalize text-muted"
           placeholder="{{trans('roles.display_name')}}"
           value=" {{old('display_name',$role->display_name ?? '')}}"/>
    @error('display_name')
    <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="description" class="text-capitalize font-weight-bold ">
        {{trans('roles.role_description')}}
    </label>

    <textarea class="form-control text-capitalize text-muted"
              name="description"
              placeholder="{{trans('roles.role_description')}}">{{old('description',$role->description ?? '')}}</textarea>

    @error('description')
    <p class="text-danger">{{$message}}</p>
    @enderror
</div>