<div class="row form-group">
    <div class="col col-md-6">
        <div class="input-group">
            <div class="input-group-addon">{{ $label }}</div>
            <input class="mr-4" type="checkbox" {{ $check ?? '' }} id="{{ $name }}" name="{{ $name }}"
                value="1">
        </div>
        @error($name)
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
