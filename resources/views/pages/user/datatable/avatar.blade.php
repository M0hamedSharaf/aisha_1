@if ($avatar)
    <img src="{{ $avatar }}" alt="" class="avatar-image">
@else
    <img src="{{ asset('images/Spare.jpg') }}" alt="" class="avatar-image">
@endif
