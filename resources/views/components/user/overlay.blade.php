@props(['background'])

{{-- Background & Overlay --}}
<div class="absolute h-screen w-screen" id="overlay">
    <div class="absolute inset-0 bg-black/20 backdrop-blur-[2px] z-2"></div>
    <img src="{{ asset($background) }}" alt="Background" class="absolute z-1 top-0 left-0 w-full h-full object-cover object-center">
</div>