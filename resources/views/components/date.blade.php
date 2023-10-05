<div class="form-group row mb-4">
    <label for="brithday" class="col-xl-12 col-form-label text-muted font-weight-bold text-capitalize">{{ $label }}
        @if ($required)
            <i class="fa-solid fa-star-of-life required-star"></i>
        @endif
    </label>
    <div class="col-xl-12">
        <input type="date" 
            class="form-control {{$class ?? ''}}"
            id="{{$id ?? $name}}"
            placeholder=""
            name="{{ $name }}"
            value="{{$value ?? ''}}">
            @error($name)
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
</div>