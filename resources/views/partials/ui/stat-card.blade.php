@props([
    'title',
    'value' => '-',
    'description' => null,
    'icon' => null,
    'trend' => null,
    'trendColor' => 'green', // green, red, yellow, blue
])

@php
    $trendColors = [
        'green' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300',
        'red' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300',
        'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200',
        'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300',
    ];

    $trendClass = $trend ? ($trendColors[$trendColor] ?? $trendColors['green']) : null;
@endphp

<div class="flex flex-col gap-3   bg-white p-4 shadow-black/5 dark: dark:bg-neutral-900">
    <div class="flex items-start justify-between gap-3">
        <div class="flex flex-col gap-1">
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ $title }}</p>
            <p class="text-3xl font-semibold text-neutral-900 dark:text-white leading-tight">{{ $value }}</p>
            @if ($description)
                <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $description }}</p>
            @endif
        </div>

        @if ($icon)
            <div class="flex size-10 items-center justify-center  bg-neutral-100 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-300">
                <flux:icon :name="$icon" class="size-5" variant="outline" />
            </div>
        @endif
    </div>

    @if ($trend)
        <div class="inline-flex items-center gap-2 self-start  px-3 py-1 text-xs font-medium {{ $trendClass }}">
            <span class="inline-block size-2  bg-current"></span>
            <span>{{ $trend }}</span>
        </div>
    @endif
</div>
