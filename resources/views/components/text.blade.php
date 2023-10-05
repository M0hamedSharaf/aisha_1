<div class="form-group row mb-4">
    <label for="name"
           class="col-xl-12 col-form-label  font-weight-bold text-capitalize {{$labelClass ?? 'text-muted'}}">{{ $label }}
           @if ($required)
            <i class="fa-solid fa-star-of-life required-star"></i>
           @endif
        </label>
    <div class="col-xl-12">
        <input type="text"
               class="form-control {{$class ?? ''}}"
               id="{{$id ?? $name}}"
               placeholder="{{$placeholder ?? ''}}"
               name="{{ $name }}"
               value="{{$value ?? ''}}">

              
        @error($name)
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
</div>
