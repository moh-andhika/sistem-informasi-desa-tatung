@php
    $isLanding = request()->routeIs('home');
@endphp

<header
    x-data="{ mobileMenuOpen: false }"
    class="sticky top-0 z-50 w-full transition-all duration-300"
    x-bind:class="{
        ' bg-white/95 py-3 backdrop-blur-md': !@json($isLanding),
        ' bg-white/70 py-3  shadow-blue-900/10 backdrop-blur-xl ring-1 ring-white/40': scrolled && @json($isLanding),
        ' bg-transparent py-4 shadow-none backdrop-blur-0': !scrolled && @json($isLanding)
    }"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 transition-all duration-300 sm:px-6 lg:px-8">
        {{-- Logo & Brand --}}
        <div class="flex items-center gap-3">
            <a
                href="{{ route('home') }}"
                wire:navigate
                class="group flex items-center gap-3  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
            >
                <img
                    src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}"
                    alt="Logo Kabupaten Ponorogo"
                    class="h-10 w-auto transition-transform duration-300 group-hover:scale-105"
                />
                <div class="flex flex-col leading-tight">
                    <span
                        class="text-sm font-bold tracking-tight transition-colors duration-300"
                        x-bind:class="(scrolled || !@json($isLanding)) ? 'text-slate-900' : 'text-white '"
                    >
                        Pemerintah Desa
                    </span>
                    <span
                        class="text-xs font-bold uppercase tracking-[0.18em] transition-colors duration-300"
                        x-bind:class="(scrolled || !@json($isLanding)) ? 'text-prt-primary' : 'text-prt-accent'"
                    >
                        Tatung
                    </span>
                </div>
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <nav class="hidden items-center gap-2 lg:flex" aria-label="Navigasi utama desktop">
            @foreach($navigationService->getPublicMenu() as $item)
                @php
                    $isActive = request()->routeIs($item['active_pattern']);
                    $desktopLinkScrolledClasses = $isActive
                        ? 'text-prt-secondary underline decoration-prt-accent decoration-2 underline-offset-8'
                        : 'text-slate-700 hover:text-prt-secondary hover:underline hover:decoration-prt-accent hover:decoration-2 hover:underline-offset-8';
                    $desktopLinkLandingClasses = $isActive
                        ? 'text-white underline decoration-prt-accent decoration-2 underline-offset-8'
                        : 'text-white/95 hover:text-white hover:underline hover:decoration-prt-accent hover:decoration-2 hover:underline-offset-8';
                @endphp

                @if(empty($item['subitems']))
                    <a
                        href="{{ route($item['route']) }}"
                        wire:navigate
                        class=" px-3.5 py-2.5 text-[15px] font-semibold leading-5 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                        x-bind:class="(scrolled || !@json($isLanding)) ? @js($desktopLinkScrolledClasses) : @js($desktopLinkLandingClasses)"
                    >
                        {{ $item['label'] }}
                    </a>
                @else
                    <div
                        class="relative"
                        x-data="{ open: false }"
                        x-id="['desktop-submenu']"
                        x-on:mouseenter="open = true"
                        x-on:mouseleave="open = false"
                        x-on:click.outside="open = false"
                        x-on:focusin="open = true"
                        x-on:focusout="if (!$el.contains($event.relatedTarget)) open = false"
                        x-on:keydown.escape.stop="open = false"
                    >
                        <button
                            type="button"
                            x-on:click="open = !open"
                            :aria-controls="$id('desktop-submenu')"
                            :aria-expanded="open"
                            aria-haspopup="true"
                            class="flex items-center gap-1.5  px-3.5 py-2.5 text-[15px] font-semibold leading-5 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                            x-bind:class="(scrolled || !@json($isLanding)) ? @js($desktopLinkScrolledClasses) : @js($desktopLinkLandingClasses)"
                        >
                            <span>{{ $item['label'] }}</span>
                            <flux:icon.chevron-down
                                class="size-3.5 transition-transform duration-200"
                                x-bind:class="open ? '-rotate-180' : ''"
                            />
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            :id="$id('desktop-submenu')"
                            class="absolute left-0 top-full z-50 w-60 pt-2"
                            x-cloak
                        >
                            <div class="flex flex-col  bg-white p-1.5 shadow-xl shadow-blue-100/50 ring-1 ring-black/5">
                                @foreach($item['subitems'] as $sub)
                                    @if(isset($sub['is_divider']) && $sub['is_divider'])
                                        <div class="my-1   aria-hidden="true"></div>
                                    @else
                                        <a
                                            href="{{ route($sub['route']) }}"
                                            wire:navigate
                                            x-on:click="open = false"
                                            class="block  px-3 py-2.5 text-sm font-medium text-slate-700 transition-colors hover:bg-blue-50 hover:text-prt-secondary focus-visible:bg-blue-50 focus-visible:text-prt-secondary focus-visible:outline-none"
                                        >
                                            {{ $sub['label'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        {{-- Actions & Mobile Toggle --}}
        <div class="flex items-center gap-3">
            @auth
                @php
                    $dashboardRoute = auth()->user()->hasAnyRole(['Super Admin', 'Admin Kependudukan'])
                        ? route('admin.dashboard')
                        : route('dashboard');
                    $roleLabel = auth()->user()->hasRole('Super Admin')
                        ? 'Super Admin'
                        : (auth()->user()->hasRole('Admin Kependudukan') ? 'Admin Kependudukan' : 'Warga');
                @endphp

                {{-- Desktop User Menu --}}
                <div class="hidden sm:block">
                    <flux:dropdown position="bottom" align="end">
                        <button
                            type="button"
                            class="flex items-center gap-2  border py-1 pl-1 pr-3 text-sm font-semibold transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                            x-bind:class="(scrolled || !@json($isLanding))
                                ? ' bg-blue-50 text-prt-secondary hover: hover:bg-blue-100'
                                : ' bg-white/10 text-white hover:bg-white/15'"
                        >
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" size="xs" />
                            <span class="max-w-25 truncate">{{ auth()->user()->name }}</span>
                            <flux:icon.chevron-down class="size-3 opacity-60" />
                        </button>

                        <flux:menu class="w-52">
                            <div class="px-2 py-1.5 text-xs font-medium text-slate-500">
                                {{ $roleLabel }}
                            </div>
                            <flux:menu.separator />
                            <flux:menu.item icon="layout-grid" href="{{ $dashboardRoute }}" wire:navigate>
                                Dasbor
                            </flux:menu.item>
                            <flux:menu.item icon="user" href="{{ route('profile.edit') }}" wire:navigate>
                                Profil Saya
                            </flux:menu.item>
                            <flux:menu.separator />
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item
                                    as="button"
                                    type="submit"
                                    icon="arrow-right-start-on-rectangle"
                                    class="w-full text-red-600 hover:text-red-700"
                                >
                                    Keluar
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            @else
                <a
                    href="{{ route('login') }}"
                    wire:navigate
                    class="hidden items-center justify-center  border px-4 py-2 text-sm font-semibold transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2 sm:inline-flex"
                    x-bind:class="(scrolled || !@json($isLanding))
                        ? ' text-slate-700 hover: hover:bg-blue-50 hover:text-prt-secondary'
                        : ' bg-white/10 text-white hover:bg-white/15'"
                >
                    Masuk
                </a>
                <a
                    href="{{ route('register') }}"
                    wire:navigate
                    class="hidden items-center justify-center  bg-prt-accent px-4 py-2 text-sm font-semibold text-prt-navy-dark transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2 sm:inline-flex"
                    x-bind:class="(scrolled || !@json($isLanding))
                        ? 'hover:bg-prt-gold'
                        : ' shadow-black/10 hover:bg-prt-gold'"
                >
                    Buat Akun
                </a>
            @endauth

            {{-- Mobile Menu Button --}}
            <button
                type="button"
                x-on:click="mobileMenuOpen = !mobileMenuOpen"
                :aria-expanded="mobileMenuOpen"
                :aria-label="mobileMenuOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'"
                aria-controls="mobile-menu"
                aria-haspopup="true"
                class="inline-flex items-center justify-center  p-2 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2 lg:hidden"
                x-bind:class="(scrolled || !@json($isLanding))
                    ? 'text-slate-700 hover:bg-blue-50 hover:text-prt-secondary'
                    : 'text-white hover:bg-white/10'"
            >
                <flux:icon.bars-3 x-show="!mobileMenuOpen" class="size-6" aria-hidden="true" />
                <flux:icon.x-mark x-show="mobileMenuOpen" class="size-6" x-cloak aria-hidden="true" />
            </button>
        </div>
    </div>

    {{-- Mobile Navigation Menu --}}
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute inset-x-0 top-full  bg-white shadow-xl lg:hidden"
        x-cloak
    >
        <div class="mx-auto max-h-[calc(100vh-4.5rem)] max-w-7xl space-y-1 overflow-y-auto px-4 py-4 sm:px-6">
            {{-- Mobile User Header --}}
            @auth
                <div class="mb-2 flex items-center gap-3  bg-blue-50 px-3 py-4">
                    <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                    <div class="flex min-w-0 flex-col">
                        <span class="truncate text-sm font-bold text-slate-900">{{ auth()->user()->name }}</span>
                        <span class="truncate text-xs font-semibold uppercase tracking-wide text-prt-primary">{{ $roleLabel }}</span>
                        <span class="truncate text-xs text-slate-500">NIK {{ auth()->user()->nik }}</span>
                    </div>
                </div>
            @endauth

            @foreach($navigationService->getPublicMenu() as $item)
                @php
                    $isMobileActive = request()->routeIs($item['active_pattern']);
                @endphp

                @if(empty($item['subitems']))
                    <a
                        href="{{ route($item['route']) }}"
                        wire:navigate
                        x-on:click="mobileMenuOpen = false"
                        class="{{ $isMobileActive ? 'bg-blue-50 text-prt-secondary' : 'text-slate-900 hover:bg-blue-50 hover:text-prt-secondary' }} block  px-3 py-3 text-base font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                    >
                        {{ $item['label'] }}
                    </a>
                @else
                    <div x-data="{ open: false }" x-id="['mobile-submenu']" class="space-y-1">
                        <button
                            type="button"
                            x-on:click="open = !open"
                            :aria-controls="$id('mobile-submenu')"
                            :aria-expanded="open"
                            aria-haspopup="true"
                            class="{{ $isMobileActive ? 'bg-blue-50 text-prt-secondary' : 'text-slate-900 hover:bg-blue-50 hover:text-prt-secondary' }} flex w-full items-center justify-between  px-3 py-3 text-base font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                        >
                            <span>{{ $item['label'] }}</span>
                            <flux:icon.chevron-down
                                class="size-5 text-slate-500 transition-transform duration-200"
                                x-bind:class="open ? '-rotate-180' : ''"
                            />
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            :id="$id('mobile-submenu')"
                            class="space-y-1 pb-2 pl-4 pr-3"
                            x-cloak
                        >
                            @foreach($item['subitems'] as $sub)
                                @if(isset($sub['is_divider']) && $sub['is_divider'])
                                    <div class="my-2   aria-hidden="true"></div>
                                @else
                                    <a
                                        href="{{ route($sub['route']) }}"
                                        wire:navigate
                                        x-on:click="mobileMenuOpen = false"
                                        class="block  px-3 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-blue-50 hover:text-prt-secondary focus-visible:bg-blue-50 focus-visible:text-prt-secondary focus-visible:outline-none"
                                    >
                                        {{ $sub['label'] }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- Mobile Actions --}}
            <div class="mt-4 flex flex-col gap-2  pb-2 pt-4">
                @auth
                    <a
                        href="{{ $dashboardRoute }}"
                        wire:navigate
                        x-on:click="mobileMenuOpen = false"
                        class="flex items-center justify-center gap-2  bg-prt-secondary px-4 py-3 text-base font-semibold text-white transition-colors hover:bg-prt-navy-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                    >
                        <flux:icon.layout-grid class="size-5" />
                        <span>Masuk ke Dasbor</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2   bg-red-50 px-4 py-3 text-base font-semibold text-red-700 transition-colors hover:bg-red-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                        >
                            <flux:icon.arrow-right-start-on-rectangle class="size-5" />
                            <span>Keluar</span>
                        </button>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        x-on:click="mobileMenuOpen = false"
                        class="flex items-center justify-center   px-4 py-3 text-base font-semibold text-slate-700 transition-colors hover:bg-blue-50 hover:text-prt-secondary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                    >
                        Masuk
                    </a>
                    <a
                        href="{{ route('register') }}"
                        wire:navigate
                        x-on:click="mobileMenuOpen = false"
                        class="flex items-center justify-center  bg-prt-accent px-4 py-3 text-base font-semibold text-prt-navy-dark transition-colors hover:bg-prt-gold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-prt-accent focus-visible:ring-offset-2"
                    >
                        Buat Akun
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
