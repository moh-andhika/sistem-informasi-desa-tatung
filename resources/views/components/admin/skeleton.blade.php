@props([
    'variant' => 'table',
    'rows' => 5,
    'columns' => 4,
])

@if ($variant === 'table')
    <div {{ $attributes->merge(['class' => 'animate-pulse space-y-4']) }}>
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="h-10 w-64 bg-slate-200 dark:bg-slate-700 rounded-lg"></div>
            <div class="h-10 w-32 bg-slate-200 dark:bg-slate-700 rounded-lg"></div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
            <div class="border-b border-slate-100 dark:border-slate-800 px-6 py-4 flex flex-col gap-2">
                <div class="h-5 w-48 bg-slate-200 dark:bg-slate-700 rounded"></div>
                <div class="h-3 w-32 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
            <div class="p-0">
                <div class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                    <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-3 flex gap-4">
                        @for ($i = 0; $i < $columns; $i++)
                            <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded flex-1"></div>
                        @endfor
                    </div>
                    @for ($i = 0; $i < $rows; $i++)
                        <div class="px-6 py-4 flex gap-4">
                            @for ($j = 0; $j < $columns; $j++)
                                <div class="h-4 bg-slate-100 dark:bg-slate-800 rounded flex-1"></div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
            <div class="border-t border-slate-100 dark:border-slate-800 px-6 py-4">
                <div class="h-8 w-full bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
        </div>
    </div>
@elseif ($variant === 'stats')
    <div {{ $attributes->merge(['class' => 'animate-pulse grid gap-6 md:grid-cols-3']) }}>
        @for ($i = 0; $i < 3; $i++)
            <div class="h-32 bg-slate-200 dark:bg-slate-800 rounded-sm relative overflow-hidden">
                <div class="p-4 space-y-3">
                    <div class="h-8 w-16 bg-slate-300 dark:bg-slate-700 rounded"></div>
                    <div class="h-4 w-32 bg-slate-300 dark:bg-slate-700 rounded"></div>
                </div>
                <div class="absolute bottom-0 inset-x-0 h-6 bg-slate-400/20"></div>
            </div>
        @endfor
    </div>
@else
    <div {{ $attributes->merge(['class' => 'animate-pulse space-y-4']) }}>
        <div class="h-8 w-1/3 bg-slate-200 dark:bg-slate-700 rounded"></div>
        <div class="h-4 w-1/2 bg-slate-100 dark:bg-slate-800 rounded"></div>
        <div class="h-64 bg-slate-100 dark:bg-slate-800 rounded-xl"></div>
    </div>
@endif
