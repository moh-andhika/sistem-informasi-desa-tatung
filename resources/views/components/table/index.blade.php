@props(['title' => null, 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm shadow-black/5 dark:border-neutral-700 dark:bg-neutral-900']) }}>
    @if($title || $subtitle)
        <div class="flex items-center justify-between border-b border-neutral-200 px-4 py-3 text-sm font-semibold text-neutral-700 dark:border-neutral-700 dark:text-neutral-200">
            @if($title)<span>{{ $title }}</span>@endif
            @if($subtitle)<span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ $subtitle }}</span>@endif
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
            {{ $slot }}
        </table>
    </div>

    @isset($footer)
        <div class="flex items-center justify-between border-t border-neutral-200 bg-neutral-50 px-4 py-3 text-xs text-neutral-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
            {{ $footer }}
        </div>
    @endisset
</div>
