@props([
    'name' => '',
    'title' => '',
    'image' => null,
    'alt' => '',
])

<div class="flex items-start gap-3 bg-[#F9FAFB] p-3">
    @if($image)
        <div class="shrink-0 overflow-hidden">
            <img src="{{ $image }}" alt="{{ $alt ?: $name }}" class="h-14 w-14 rounded bg-slate-100 object-cover">
        </div>
    @endif

    <div class="min-w-0">
        <p class="text-sm font-bold text-[#1a1a1a] leading-[1.5]">
            {{ $name }}
        </p>
        <p class="text-sm font-medium text-[#3d3d3d] leading-[1.5]">
            {{ $title }}
        </p>
    </div>
</div>
