@props(['title' => null, 'subtitle' => null, 'actions' => null])

<div {{ $attributes->merge(['class' => 'overflow-hidden      bg-white  dark: dark:bg-slate-900']) }}>
    @if($title || $subtitle || $actions)
        <div class="flex items-center justify-between  px-5 py-4 ">
            <div>
                @if($title)<h3 class="text-base font-semibold text-slate-800 dark:text-slate-200">{{ $title }}</h3>@endif
                @if($subtitle)<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $subtitle }}</p>@endif
            </div>
            @if($actions)
                <div class="flex items-center gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
            {{ $slot }}
        </table>
    </div>

    @isset($footer)
        <div class="flex items-center justify-between   bg-slate-50/50 px-5 py-3 text-sm text-slate-500  dark:bg-slate-800/50 dark:text-slate-400">
            {{ $footer }}
        </div>
    @endisset
</div>
