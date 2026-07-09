<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        <div x-data="{ isNavigating: false }" 
             x-on:livewire:navigating.window="isNavigating = true" 
             x-on:livewire:navigated.window="isNavigating = false"
             class="w-full">
            
            <div x-show="isNavigating" x-cloak class="flex flex-col gap-6 animate-pulse">
                <div class="flex flex-col gap-2 mb-4">
                    <div class="h-8 w-48 bg-slate-200 dark:bg-slate-700 "></div>
                    <div class="h-4 w-72 bg-slate-100 dark:bg-slate-800 "></div>
                </div>
                <x-admin.skeleton variant="table" columns="5" />
            </div>

            <div x-show="!isNavigating">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
