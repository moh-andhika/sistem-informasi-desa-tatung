<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app'), Title('Manajemen Pengguna')] class extends Component {
    use WithPagination;

    public string $searchAdmin = '';
    public string $searchWarga = '';

    public function updatedSearchAdmin(): void
    {
        $this->resetPage('adminPage');
    }

    public function updatedSearchWarga(): void
    {
        $this->resetPage('wargaPage');
    }

    public function with(): array
    {
        $adminQuery = User::query()
            ->whereHas('roles', fn ($q) => $q->where('name', 'Super Admin')->orWhere('name', 'Admin Kependudukan'))
            ->with('roles');

        if (trim($this->searchAdmin) !== '') {
            $term = '%' . trim($this->searchAdmin) . '%';
            $adminQuery->where(fn ($q) => $q->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('nik', 'like', $term));
        }

        $wargaQuery = User::query()
            ->whereHas('roles', fn ($q) => $q->where('name', 'Warga'))
            ->with('roles');

        if (trim($this->searchWarga) !== '') {
            $term = '%' . trim($this->searchWarga) . '%';
            $wargaQuery->where(fn ($q) => $q->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('nik', 'like', $term));
        }

        return [
            'admins'     => $adminQuery->latest()->paginate(10, pageName: 'adminPage'),
            'wargas'     => $wargaQuery->latest()->paginate(10, pageName: 'wargaPage'),
            'totalAdmin' => User::whereHas('roles', fn ($q) => $q->where('name', 'Super Admin')->orWhere('name', 'Admin Kependudukan'))->count(),
            'totalWarga' => User::whereHas('roles', fn ($q) => $q->where('name', 'Warga'))->count(),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Manajemen Pengguna</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">
            Daftar akun admin pengelola desa dan warga yang terdaftar di sistem layanan mandiri.
        </p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex size-10 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400">
                <flux:icon.shield-check class="size-5" variant="outline" />
            </div>
            <div>
                <p class="text-xs text-neutral-500 dark:text-neutral-400">Total Admin</p>
                <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $totalAdmin }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex size-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                <flux:icon.users class="size-5" variant="outline" />
            </div>
            <div>
                <p class="text-xs text-neutral-500 dark:text-neutral-400">Total Warga Terdaftar</p>
                <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $totalWarga }}</p>
            </div>
        </div>
    </div>

    {{-- Pines Tabs --}}
    <div
        x-data="{
            tabSelected: 1,
            tabId: $id('tabs'),
            tabButtonClicked(tabButton) {
                this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
                this.tabRepositionMarker(tabButton);
            },
            tabRepositionMarker(tabButton) {
                this.$refs.tabMarker.style.width  = tabButton.offsetWidth + 'px';
                this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
                this.$refs.tabMarker.style.left   = tabButton.offsetLeft + 'px';
            },
            tabContentActive(tabContent) {
                return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
            }
        }"
        x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);"
        class="relative w-full"
    >
        {{-- Tab Buttons --}}
        <div x-ref="tabButtons" class="relative inline-grid w-full grid-cols-2 items-center justify-center rounded-lg border border-neutral-200 bg-neutral-50 p-1 text-neutral-500 select-none dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400">
            <button
                :id="$id(tabId)"
                @click="tabButtonClicked($el)"
                type="button"
                class="relative z-20 inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-all duration-200 whitespace-nowrap cursor-pointer"
                :class="tabSelected == 1 ? 'text-neutral-900 dark:text-white' : 'hover:text-neutral-700 dark:hover:text-neutral-200'"
            >
                <flux:icon.shield-check class="size-4" variant="outline" />
                Admin &amp; Pengelola
            </button>
            <button
                :id="$id(tabId)"
                @click="tabButtonClicked($el)"
                type="button"
                class="relative z-20 inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-all duration-200 whitespace-nowrap cursor-pointer"
                :class="tabSelected == 2 ? 'text-neutral-900 dark:text-white' : 'hover:text-neutral-700 dark:hover:text-neutral-200'"
            >
                <flux:icon.users class="size-4" variant="outline" />
                Warga Terdaftar
            </button>

            {{-- Sliding Marker --}}
            <div x-ref="tabMarker" class="absolute left-0 z-10 h-full duration-300 ease-out" x-cloak>
                <div class="h-full w-full rounded-md bg-white shadow-sm dark:bg-neutral-700"></div>
            </div>
        </div>  1`

        {{-- Tab Content --}}
        <div class="relative mt-3 w-full">

            {{-- TAB 1: Admin --}}
            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative flex flex-col gap-4">
                <div class="w-full sm:max-w-xs">
                    <flux:input wire:model.live="searchAdmin" icon="magnifying-glass" placeholder="Cari nama, email, atau NIK..." />
                </div>

                <x-table title="Daftar Admin & Pengelola" subtitle="Total: {{ $admins->total() }} akun">
                    <x-slot:footer>{{ $admins->links() }}</x-slot:footer>

                    <x-table.thead>
                        <x-table.th>Nama</x-table.th>
                        <x-table.th>Email</x-table.th>
                        <x-table.th>NIK</x-table.th>
                        <x-table.th>No. HP</x-table.th>
                        <x-table.th>Role</x-table.th>
                        <x-table.th>Bergabung</x-table.th>
                    </x-table.thead>

                    <x-table.tbody>
                        @forelse ($admins as $user)
                            <x-table.tr wire:key="admin-{{ $user->id }}">
                                <x-table.td>
                                    <div class="flex items-center gap-3">
                                        <div class="flex size-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-xs font-bold text-red-700 dark:bg-red-900/40 dark:text-red-400">
                                            {{ $user->initials() }}
                                        </div>
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $user->name }}</span>
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-neutral-500">{{ $user->email }}</x-table.td>
                                <x-table.td class="font-mono text-xs">{{ $user->nik ?? '-' }}</x-table.td>
                                <x-table.td>{{ $user->no_hp ?? '-' }}</x-table.td>
                                <x-table.td>
                                    @foreach($user->roles as $role)
                                        <flux:badge color="{{ $role->name === 'Super Admin' ? 'red' : 'orange' }}" size="sm">
                                            {{ $role->name }}
                                        </flux:badge>
                                    @endforeach
                                </x-table.td>
                                <x-table.td class="text-xs text-neutral-500">{{ $user->created_at->format('d M Y') }}</x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="6" class="py-8 text-center text-neutral-500">
                                    Tidak ada admin yang cocok dengan pencarian.
                                </x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table>
            </div>

            {{-- TAB 2: Warga --}}
            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" x-cloak class="relative flex flex-col gap-4">
                <div class="w-full sm:max-w-xs">
                    <flux:input wire:model.live="searchWarga" icon="magnifying-glass" placeholder="Cari nama, email, atau NIK..." />
                </div>

                <x-table title="Daftar Warga Terdaftar" subtitle="Total: {{ $wargas->total() }} akun">
                    <x-slot:footer>{{ $wargas->links() }}</x-slot:footer>

                    <x-table.thead>
                        <x-table.th>Nama</x-table.th>
                        <x-table.th>Email</x-table.th>
                        <x-table.th>NIK</x-table.th>
                        <x-table.th>No. HP</x-table.th>
                        <x-table.th>Status Email</x-table.th>
                        <x-table.th>Bergabung</x-table.th>
                    </x-table.thead>

                    <x-table.tbody>
                        @forelse ($wargas as $user)
                            <x-table.tr wire:key="warga-{{ $user->id }}">
                                <x-table.td>
                                    <div class="flex items-center gap-3">
                                        <div class="flex size-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700 dark:bg-blue-900/40 dark:text-blue-400">
                                            {{ $user->initials() }}
                                        </div>
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $user->name }}</span>
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-neutral-500">{{ $user->email }}</x-table.td>
                                <x-table.td class="font-mono text-xs">{{ $user->nik ?? '-' }}</x-table.td>
                                <x-table.td>{{ $user->no_hp ?? '-' }}</x-table.td>
                                <x-table.td>
                                    @if($user->email_verified_at)
                                        <flux:badge color="green" size="sm">Terverifikasi</flux:badge>
                                    @else
                                        <flux:badge color="zinc" size="sm">Belum Verifikasi</flux:badge>
                                    @endif
                                </x-table.td>
                                <x-table.td class="text-xs text-neutral-500">{{ $user->created_at->format('d M Y') }}</x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="6" class="py-8 text-center text-neutral-500">
                                    Tidak ada warga yang cocok dengan pencarian.
                                </x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table>
            </div>

        </div>
    </div>

</div>
