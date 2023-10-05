<div class="form-group row mb-4">

    <label for="note"
           class="col-xl-12 col-md-6 col-form-label  font-weight-bold text-capitalize {{$labelClass ?? 'text-muted'}}  ">
           {{ $label }}
           @if ($required)
            <i class="fa-solid fa-star-of-life required-star"></i>
           @endif
    </label>

    <div class="col-md-12">

        <textarea class="form-control font-weight-bold text-muted" cols="30" rows="10" name="{{ $name }}" id="{{ $name }}">{{ $value }}</textarea>
        @error($name)
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
</div>