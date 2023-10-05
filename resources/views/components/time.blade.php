<div class="form-group row mb-4">
    <label for="from"
        class="col-xl-12 col-form-label   font-weight-bold text-capitalize {{ $class ?? '' }}">
        {{ $label }}
        @if ($required)
            <i class="fa-solid fa-star-of-life required-star"></i>
        @endif
    </label>
    <div class="col-xl-12">
        <input id="{{ $id ?? $name }}" value="{{ $value }}" class="form-control flatpickr flatpickr-input active"
            type="time" name="{{ $name }}">
        @error($name)
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>
</div>
