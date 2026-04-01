<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        @php
            $user = auth()->user();
            $isAdmin = $user?->isAdmin();
            $isWarga = $user?->isWarga();

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
                    'badge' => __('Segera'),
                ],
                [
                    'title' => __('Layanan Surat'),
                    'icon' => 'document-text',
                    'href' => '#',
                    'active' => false,
                    'badge' => __('Segera'),
                ],
                [
                    'title' => __('Berita Desa'),
                    'icon' => 'newspaper',
                    'href' => '#',
                    'active' => false,
                    'badge' => __('Segera'),
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
                    'title' => __('Ajukan Surat'),
                    'icon' => 'document-text',
                    'href' => '#',
                    'active' => false,
                    'badge' => __('Segera'),
                ],
                [
                    'title' => __('Riwayat Pengajuan'),
                    'icon' => 'clock',
                    'href' => '#',
                    'active' => false,
                    'badge' => __('Segera'),
                ],
                [
                    'title' => __('Profil'),
                    'icon' => 'user',
                    'href' => route('profile.edit'),
                    'active' => request()->routeIs('profile.edit'),
                ],
            ];
        @endphp

        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
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
                                        <span class="text-[11px] rounded-full bg-yellow-100 px-2 py-0.5 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
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
                                        <span class="text-[11px] rounded-full bg-yellow-100 px-2 py-0.5 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
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

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

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
                                    <flux:text class="truncate">{{ $user?->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
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
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
