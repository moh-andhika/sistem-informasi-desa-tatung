@props([
    'title',
    'breadcrumbs' => []
])

<section class="border-b-2 border-slate-200 relative overflow-hidden pt-4 pb-5 tracking-wide bg-white">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumbs --}}
        <nav class="mb-1 flex overflow-x-auto pb-1 no-scrollbar" aria-label="Breadcrumb">
            <ol class="inline-flex min-w-max items-center gap-2  text-slate-500  sm:text-lg">
                <li>
                    <a href="{{ route('home') }}" class="flex items-center gap-1.5 rounded-full px-1.5 py-1 text-slate-600 transition-colors hover:text-[#1B5E20] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">
                        <flux:icon.home class="size-3.5" />
                        <span>Beranda</span>
                    </a>
                </li>
                @foreach($breadcrumbs as $label => $url)
                    <li class="flex items-center gap-2 whitespace-nowrap">
                        <flux:icon.chevron-right class="size-3 text-slate-300" />
                        @if($loop->last)
                            <span class=" px-2.5 py-1 text-black" aria-current="page">{{ $label }}</span>
                        @else
                            <a href="{{ $url }}" class="rounded-full px-1 py-1 text-slate-600 transition-colors hover:text-[#1B5E20] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F9A825] focus-visible:ring-offset-2">{{ $label }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="max-w-3xl">
            <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 mb-2 leading-tight">
                {{ $title }}
            </h1>
        </div>
    </div>
</section>
