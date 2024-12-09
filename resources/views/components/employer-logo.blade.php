@props(["employer", "width" => 90])

@if (filter_var($employer->logo, FILTER_VALIDATE_URL))
    <img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">

@else
    <img src="{{ asset('storage/' . $employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">

@endif



<!-- <img src="{{ asset('storage/'.$employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}"> -->