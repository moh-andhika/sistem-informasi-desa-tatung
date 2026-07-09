<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-100 dark:bg-slate-900">
        @php
            $user = auth()->user();
            $isAdmin = $user?->hasAnyRole(['Super Admin', 'Admin Kependudukan']);
            $isWarga = $user?->hasRole('Warga');

            $baseMenu = [
                [
                    'title' => __('Dashboard'),
                    'icon' => 'layout-grid',
                    'href' => route('dashboard'),
                    'active' => request()->routeIs('dashboard'),
                ],
            ];

            $adminMenu = [
                [
                    'title' => __('Dashboard Admin'),
                    'icon' => 'home',
                    'href' => route('admin.dashboard'),
                    'active' => request()->routeIs('admin.dashboard'),
                ],
                [
                    'title' => __('Data Penduduk'),
                    'icon' => 'users',
                    'href' => route('admin.penduduk'),
                    'active' => request()->routeIs('admin.penduduk'),
                ],
                [
                    'title' => __('Manajemen Pengguna'),
                    'icon' => 'user-circle',
                    'href' => route('admin.pengguna'),
                    'active' => request()->routeIs('admin.pengguna'),
                ],
                [
                    'title' => __('Layanan Surat'),
                    'icon' => 'document-text',
                    'href' => route('admin.permohonan'),
                    'active' => request()->routeIs('admin.permohonan'),
                ],
                [
                    'title' => __('Berita Desa'),
                    'icon' => 'newspaper',
                    'href' => route('admin.berita'),
                    'active' => request()->routeIs('admin.berita'),
                ],
                [
                    'title' => __('Manajemen Galeri'),
                    'icon' => 'photo',
                    'href' => route('admin.galeri'),
                    'active' => request()->routeIs('admin.galeri'),
                ],
                [
                    'title' => __('Perangkat Desa'),
                    'icon' => 'identification',
                    'href' => route('admin.perangkat-desa'),
                    'active' => request()->routeIs('admin.perangkat-desa'),
                ],
                [
                    'title' => __('Pengumuman'),
                    'icon' => 'megaphone',
                    'href' => route('admin.pengumuman'),
                    'active' => request()->routeIs('admin.pengumuman'),
                ],
                [
                    'title' => __('Pengaturan'),
                    'icon' => 'cog-6-tooth',
                    'href' => route('profile.edit'),
                    'active' => request()->routeIs('profile.edit'),
                ],
            ];

            $wargaMenu = [
                [
                    'title' => __('Dashboard Warga'),
                    'icon' => 'home',
                    'href' => route('warga.dashboard'),
                    'active' => request()->routeIs('warga.dashboard'),
                ],
                [
                    'title' => __('Layanan Surat'),
                    'icon' => 'document-text',
                    'href' => route('warga.dashboard'),
                    'active' => false,
                ],
                [
                    'title' => __('Profil'),
                    'icon' => 'user',
                    'href' => route('profile.edit'),
                    'active' => request()->routeIs('profile.edit'),
                ],
            ];
        @endphp

        <style>
            .adminlte-sidebar [data-flux-sidebar-item][data-current] {
                background-color: var(--color-prt-primary) !important;
                color: white !important;
            }
        </style>

        <flux:sidebar sticky collapsible="mobile" class="adminlte-sidebar dark   bg-slate-800 text-slate-300">
            <flux:sidebar.header class="  pb-4 mb-2">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="text-white" />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Umum')" class="grid gap-1">
                    @foreach ($baseMenu as $item)
                        <flux:sidebar.item
                            :icon="$item['icon']"
                            :href="$item['href']"
                            :current="$item['active']"
                            wire:navigate
                        >
                            {{ $item['title'] }}
                        </flux:sidebar.item>
                    @endforeach
                </flux:sidebar.group>

                @if ($isAdmin)
                    <flux:sidebar.group :heading="__('Admin')" class="grid gap-1">
                        @foreach ($adminMenu as $item)
                            <flux:sidebar.item
                                :icon="$item['icon']"
                                :href="$item['href']"
                                :current="$item['active']"
                                wire:navigate
                            >
                                <div class="flex items-center justify-between w-full">
                                    <span>{{ $item['title'] }}</span>
                                    @isset($item['badge'])
                                        <span class="text-[11px] bg-prt-accent/10 px-2 py-0.5 text-prt-accent">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endisset
                                </div>
                            </flux:sidebar.item>
                        @endforeach
                    </flux:sidebar.group>
                @endif

                @if ($isWarga)
                    <flux:sidebar.group :heading="__('Warga')" class="grid gap-1">
                        @foreach ($wargaMenu as $item)
                            <flux:sidebar.item
                                :icon="$item['icon']"
                                :href="$item['href']"
                                :current="$item['active']"
                                wire:navigate
                            >
                                <div class="flex items-center justify-between w-full">
                                    <span>{{ $item['title'] }}</span>
                                    @isset($item['badge'])
                                        <span class="text-[11px] bg-prt-accent/10 px-2 py-0.5 text-prt-accent">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endisset
                                </div>
                            </flux:sidebar.item>
                        @endforeach
                    </flux:sidebar.group>
                @endif
            </flux:sidebar.nav>

            <flux:spacer />

            <x-desktop-user-menu class="hidden lg:block" :name="$user?->name ?? ''" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="$user?->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="$user?->name"
                                    :initials="$user?->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ $user?->name }}</flux:heading>
                                    <flux:text class="truncate">NIK {{ $user?->nik }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group x-data>
                        <flux:menu.item
                            icon="moon"
                            x-show="!$flux.dark"
                            x-on:click="$flux.dark = true"
                        >
                            {{ __('Mode Gelap') }}
                        </flux:menu.item>
                        <flux:menu.item
                            icon="sun"
                            x-show="$flux.dark"
                            x-on:click="$flux.dark = false"
                            x-cloak
                        >
                            {{ __('Mode Terang') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>

                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Pengaturan') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Keluar') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        <flux:toast />
        <livewire:confirm-modal />

        @fluxScripts
    </body>
</html>
