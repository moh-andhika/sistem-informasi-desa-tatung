@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Desa Tatung" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center bg-transparent">
            <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo" class="size-7 object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Desa Tatung" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center bg-transparent">
            <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo" class="size-7 object-contain" />
        </x-slot>
    </flux:brand>
@endif
