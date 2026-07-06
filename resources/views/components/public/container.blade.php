@props([
    'as' => 'div',
    'clean' => false, // If true, removes default margins/paddings
])

<{{ $as }} {{ $attributes->merge(['class' => $clean ? '' : 'mx-auto max-w-7xl px-4 sm:px-6 lg:px-8']) }}>
    {{ $slot }}
</{{ $as }}>
