@inject('navigationService', 'App\Services\NavigationService')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <title>{{ $title ?? config('app.name', 'Sistem Informasi Desa Tatung') }}</title>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased portal-page" 
      x-data="{ scrolled: false }"
      x-init="scrolled = window.pageYOffset > 20"
      @scroll.window="scrolled = (window.pageYOffset > 20)">
    
    {{-- Skip-to-content link (WCAG 2.4.1) --}}
    <a href="#main-content" class="prt-skip-link">
        Langsung ke konten utama
    </a>
    


    @include('partials.header')

    <main id="main-content" class="relative z-10 min-h-[60vh] outline-none" tabindex="-1">
        @yield('header_content')

        @if (View::hasSection('sidebar'))
            <div class="py-3">
                <x-public.container>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
                        <div class="lg:col-span-8">
                            @yield('content')
                        </div>
                        <aside class="lg:col-span-4 lg:sticky lg:top-24">
                            @yield('sidebar')
                        </aside>
                    </div>
                </x-public.container>
            </div>
        @else
            <x-public.container class="py-3">
                @yield('content')
            </x-public.container>
        @endif

        @yield('footer_content')
        {!! $slot ?? '' !!}
    </main>

    @include('partials.footer')

    <flux:toast />
    <livewire:confirm-modal />

    @vite(['resources/css/app.css', 'resources/css/portal.css', 'resources/js/app.js'])
    @fluxScripts
    
    <script>
        (function() {
            const dateEl = document.getElementById('gov-date');
            if (dateEl) {
                const fmt = new Intl.DateTimeFormat('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
                dateEl.textContent = fmt.format(new Date());
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
