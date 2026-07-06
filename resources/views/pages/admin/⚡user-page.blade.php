<?php

use App\Models\User;
use App\Models\penduduk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Flux\Flux;

new #[Layout('layouts.app'), Title('Manajemen Pengguna')] class extends Component {
    use WithPagination;

    public string $searchAdmin = '';
    public string $searchWarga = '';

    // Modal state
    public bool $showModal = false;
    public ?int $userId = null;

    // Form fields
    public string $nik = '';
    public string $name = '';
    public string $no_hp = '';
    public string $password = '';
    public string $role = 'Warga';
    public bool $is_edit = false;
    public bool $is_admin_form = false;

    // Search Penduduk State
    public string $searchPenduduk = '';
    public array $searchResults = [];

    // Detail Modal state
    public bool $showDetailModal = false;
    public ?penduduk $detailPenduduk = null;

    public function updatedSearchAdmin(): void
    {
        $this->resetPage('adminPage');
    }

    public function updatedSearchWarga(): void
    {
        $this->resetPage('wargaPage');
    }

    public function updatedSearchPenduduk()
    {
        if (strlen($this->searchPenduduk) >= 3) {
            // Cek apakah data penduduk tersebut sudah punya user
            $registeredNiks = User::whereNotNull('nik')->pluck('nik')->toArray();

            $this->searchResults = penduduk::where(function($q) {
                    $q->where('nik', 'like', "%{$this->searchPenduduk}%")
                      ->orWhere('nama', 'like', "%{$this->searchPenduduk}%");
                })
                ->take(5)
                ->get()
                ->map(function ($p) use ($registeredNiks) {
                    return [
                        'nik' => $p->nik,
                        'nama' => $p->nama,
                        'is_registered' => in_array($p->nik, $registeredNiks)
                    ];
                })
                ->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    public function selectPenduduk($nik, $nama)
    {
        $this->nik = $nik;
        $this->name = $nama;
        $this->searchPenduduk = '';
        $this->searchResults = [];
        $this->resetErrorBag('nik');
    }

    public function createWarga()
    {
        $this->resetForm();
        $this->is_edit = false;
        $this->is_admin_form = false;
        $this->role = 'Warga';
        $this->showModal = true;
    }

    public function createAdmin()
    {
        $this->resetForm();
        $this->is_edit = false;
        $this->is_admin_form = true;
        $this->role = 'Admin Kependudukan'; // Default role for admin form
        $this->showModal = true;
    }

    public function showDetail($id)
    {
        $user = User::findOrFail($id);
        if ($user->nik) {
            $this->detailPenduduk = penduduk::where('nik', $user->nik)->first();

            if (!$this->detailPenduduk) {
                Flux::toast('Data penduduk tidak ditemukan untuk NIK ini.', variant: 'danger');
                return;
            }

            $this->showDetailModal = true;
        } else {
            Flux::toast('Pengguna ini belum memiliki NIK.', variant: 'warning');
        }
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->is_edit = true;

        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->nik = $user->nik ?? '';
        $this->name = $user->name;
        $this->no_hp = $user->no_hp ?? '';

        $userRole = $user->roles->first()?->name ?? 'Warga';
        $this->role = $userRole;
        $this->is_admin_form = ($userRole !== 'Warga');

        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ];

        // NIK rules
        if ($this->is_admin_form) {
            $rules['nik'] = 'nullable|numeric|digits:16|unique:users,nik,' . $this->userId;
            $rules['role'] = 'required|string|exists:roles,name';
        } else {
            $rules['nik'] = 'required|numeric|digits:16|unique:users,nik,' . $this->userId;
        }

        if (!$this->is_edit || $this->password) {
            $rules['password'] = 'required|string|min:8';
        }

        $this->validate($rules);

        // Validasi khusus Warga (harus terdaftar di penduduk)
        if (!$this->is_admin_form && !$this->is_edit) {
            $penduduk = penduduk::where('nik', $this->nik)->first();
            if (!$penduduk) {
                $this->addError('nik', 'NIK tidak terdaftar sebagai penduduk desa.');
                return;
            }
        }

        $data = [
            'nik' => $this->nik ?: null,
            'name' => $this->name,
            'no_hp' => $this->no_hp,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->is_edit) {
            $user = User::findOrFail($this->userId);
            $user->update($data);

            // Sync role if admin form
            if ($this->is_admin_form) {
                $user->syncRoles([$this->role]);
            }

            Flux::toast('Akun berhasil diperbarui.', variant: 'success');
        } else {
            $user = User::create($data);
            $user->assignRole($this->is_admin_form ? $this->role : 'Warga');
            Flux::toast('Akun berhasil dibuat.', variant: 'success');
        }

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self or super admin
        if ($user->id === auth()->id() || $user->hasRole('Super Admin')) {
            Flux::toast('Tidak dapat menghapus akun ini.', variant: 'danger');
            return;
        }

        $user->delete();
        Flux::toast('Akun berhasil dihapus.', variant: 'success');
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->nik = '';
        $this->name = '';
        $this->no_hp = '';
        $this->password = '';
        $this->role = 'Warga';
        $this->resetErrorBag();
    }

    public function with(): array
    {
        $adminQuery = User::query()
            ->whereHas('roles', fn ($q) => $q->where('name', '!=', 'Warga'))
            ->with('roles');

        if (trim($this->searchAdmin) !== '') {
            $term = '%' . trim($this->searchAdmin) . '%';
            $adminQuery->where(fn ($q) => $q->where('name', 'like', $term)
                ->orWhere('nik', 'like', $term));
        }

        $wargaQuery = User::query()
            ->whereHas('roles', fn ($q) => $q->where('name', 'Warga'))
            ->with('roles');

        if (trim($this->searchWarga) !== '') {
            $term = '%' . trim($this->searchWarga) . '%';
            $wargaQuery->where(fn ($q) => $q->where('name', 'like', $term)
                ->orWhere('nik', 'like', $term));
        }

        return [
            'admins'     => $adminQuery->latest()->paginate(10, pageName: 'adminPage'),
            'wargas'     => $wargaQuery->latest()->paginate(10, pageName: 'wargaPage'),
            'totalAdmin' => User::whereHas('roles', fn ($q) => $q->where('name', '!=', 'Warga'))->count(),
            'totalWarga' => User::whereHas('roles', fn ($q) => $q->where('name', 'Warga'))->count(),
            'availableRoles' => Role::where('name', '!=', 'Warga')->pluck('name')->toArray(),
        ];
    }
}; ?>

<div class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">Manajemen Pengguna</h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Daftar akun admin pengelola desa dan warga yang terdaftar di sistem layanan mandiri.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <flux:button variant="subtle" wire:click="createAdmin" icon="user-plus">Tambah Admin</flux:button>
            <flux:button variant="primary" wire:click="createWarga" icon="plus">Tambah Warga</flux:button>
        </div>
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
            tabSelected: 2,
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
        x-init="setTimeout(() => tabRepositionMarker($refs.tabButtons.children[1]), 100);"
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
        </div>

        {{-- Tab Content --}}
        <div class="relative mt-3 w-full">

            {{-- TAB 1: Admin --}}
            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative flex flex-col gap-4" x-cloak>
                <div wire:loading.flex class="hidden flex-col gap-4">
                    <x-admin.skeleton variant="table" columns="5" />
                </div>

                <div wire:loading.remove class="flex flex-col gap-4">
                    <div class="w-full sm:max-w-xs">
                        <flux:input wire:model.live="searchAdmin" icon="magnifying-glass" placeholder="Cari nama atau NIK..." />
                    </div>

                    <x-table title="Daftar Admin & Pengelola" subtitle="Total: {{ $admins->total() }} akun">
                        <x-slot:footer>{{ $admins->links() }}</x-slot:footer>

                        <x-table.thead>
                            <x-table.th>Nama</x-table.th>
                            <x-table.th>NIK</x-table.th>
                            <x-table.th>No. HP</x-table.th>
                            <x-table.th>Role</x-table.th>
                            <x-table.th>Bergabung</x-table.th>
                            <x-table.th class="text-right">Aksi</x-table.th>
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
                                    <x-table.td class="font-mono text-xs">{{ $user->nik ?? '-' }}</x-table.td>
                                    <x-table.td>{{ $user->no_hp ?? '-' }}</x-table.td>
                                    <x-table.td>
                                        @foreach($user->roles as $userRole)
                                            <flux:badge color="{{ $userRole->name === 'Super Admin' ? 'red' : 'orange' }}" size="sm">
                                                {{ $userRole->name }}
                                            </flux:badge>
                                        @endforeach
                                    </x-table.td>
                                    <x-table.td class="text-xs text-neutral-500">{{ $user->created_at->format('d M Y') }}</x-table.td>
                                    <x-table.td class="text-right">
                                        @if($user->id !== auth()->id() && !$user->hasRole('Super Admin'))
                                        <div class="flex justify-end gap-2">
                                            <flux:button variant="ghost" size="sm" icon="pencil-square" wire:click="edit({{ $user->id }})" />
                                            <flux:button variant="ghost" size="sm" icon="trash" class="text-red-500 hover:text-red-600 hover:bg-red-50" wire:click="confirmDelete({{ $user->id }})" wire:confirm="Yakin ingin menghapus admin ini?" />
                                        </div>
                                        @endif
                                    </x-table.td>
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
            </div>

            {{-- TAB 2: Warga --}}
            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative flex flex-col gap-4">
                <div wire:loading.flex class="hidden flex-col gap-4">
                    <x-admin.skeleton variant="table" columns="5" />
                </div>

                <div wire:loading.remove class="flex flex-col gap-4">
                    <div class="w-full sm:max-w-xs">
                        <flux:input wire:model.live="searchWarga" icon="magnifying-glass" placeholder="Cari nama atau NIK..." />
                    </div>

                    <x-table title="Daftar Warga Terdaftar" subtitle="Total: {{ $wargas->total() }} akun">
                        <x-slot:footer>{{ $wargas->links() }}</x-slot:footer>

                        <x-table.thead>
                            <x-table.th>Nama</x-table.th>
                            <x-table.th>NIK</x-table.th>
                            <x-table.th>No. HP</x-table.th>
                            <x-table.th>Bergabung</x-table.th>
                            <x-table.th class="text-right">Aksi</x-table.th>
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
                                    <x-table.td class="font-mono text-xs">{{ $user->nik ?? '-' }}</x-table.td>
                                    <x-table.td>{{ $user->no_hp ?? '-' }}</x-table.td>
                                    <x-table.td class="text-xs text-neutral-500">{{ $user->created_at->format('d M Y') }}</x-table.td>
                                    <x-table.td class="text-right">
                                        <div class="flex justify-end gap-2">
                                            <flux:button variant="ghost" size="sm" icon="eye" wire:click="showDetail({{ $user->id }})" />
                                            <flux:button variant="ghost" size="sm" icon="pencil-square" wire:click="edit({{ $user->id }})" />
                                            <flux:button variant="ghost" size="sm" icon="trash" class="text-red-500 hover:text-red-600 hover:bg-red-50" wire:click="confirmDelete({{ $user->id }})" wire:confirm="Yakin ingin menghapus akun login warga ini? Data aslinya di tabel kependudukan tidak akan terhapus." />
                                        </div>
                                    </x-table.td>
                                </x-table.tr>
                            @empty
                                <x-table.tr>
                                    <x-table.td colspan="5" class="py-8 text-center text-neutral-500">
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

    {{-- Modal Tambah / Edit --}}
    <flux:modal wire:model="showModal" class="md:w-[450px]">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-4 text-slate-900 dark:text-white flex items-center gap-2">
                @if($is_admin_form)
                    <flux:icon.shield-check class="size-5 text-blue-600" />
                    {{ $is_edit ? 'Edit Admin' : 'Tambah Admin' }}
                @else
                    <flux:icon.users class="size-5 text-blue-600" />
                    {{ $is_edit ? 'Edit Akun Warga' : 'Tambah Akun Warga' }}
                @endif
            </h2>

            <form wire:submit.prevent="save" class="flex flex-col gap-4">

                @if ($errors->any())
                    <div class="rounded-sm bg-red-50 border border-red-200 p-3 mb-2">
                        <div class="flex">
                            <flux:icon.exclamation-triangle class="size-5 text-red-500 mr-2 shrink-0" variant="mini" />
                            <div class="text-sm text-red-600 font-medium">
                                <ul class="list-disc pl-4 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if($is_admin_form)
                    <flux:input
                        wire:model="name"
                        label="Nama Lengkap"
                        placeholder="Nama staff / pengelola"
                        required
                    />

                    <flux:select wire:model="role" label="Peran (Role)" required>
                        @foreach($availableRoles as $r)
                            <flux:select.option value="{{ $r }}">{{ $r }}</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        wire:model="nik"
                        label="NIK (Opsional)"
                        placeholder="16 digit NIK"
                        type="number"
                        inputmode="numeric"
                        maxlength="16"
                    />
                @else
                    @if(!$is_edit)
                        <div class="relative" x-data="{ showDropdown: false }">
                            <flux:input
                                wire:model.live.debounce.500ms="searchPenduduk"
                                x-on:input="showDropdown = true"
                                x-on:focus="showDropdown = true"
                                x-on:click.outside="showDropdown = false"
                                label="Cari Data Penduduk (Berdasarkan NIK atau Nama)"
                                placeholder="Ketik nama atau NIK minimal 3 huruf..."
                                icon="magnifying-glass"
                            />

                            @if(!empty($searchResults))
                                <div class="absolute z-[9999] w-full mt-1 bg-white dark:bg-slate-800 rounded-md shadow-xl border border-slate-200 dark:border-slate-700 max-h-60 overflow-y-auto" x-show="showDropdown" x-transition x-cloak>
                                    <ul class="py-1">
                                        @foreach($searchResults as $result)
                                            <li>
                                                <button
                                                    type="button"
                                                    class="w-full text-left px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors {{ $result['is_registered'] ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    @if(!$result['is_registered'])
                                                        wire:click="selectPenduduk('{{ $result['nik'] }}', '{{ $result['nama'] }}')"
                                                        x-on:click="showDropdown = false"
                                                    @endif
                                                    {{ $result['is_registered'] ? 'disabled' : '' }}
                                                >
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <p class="font-bold text-slate-900 dark:text-white">{{ $result['nama'] }}</p>
                                                            <p class="font-mono text-xs text-slate-500">{{ $result['nik'] }}</p>
                                                        </div>
                                                        @if($result['is_registered'])
                                                            <span class="text-[10px] font-bold px-2 py-0.5 bg-red-100 text-red-700 rounded-sm">Sudah Terdaftar</span>
                                                        @else
                                                            <flux:icon.check-circle class="size-4 text-emerald-500 opacity-0 group-hover:opacity-100" />
                                                        @endif
                                                    </div>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif(strlen($searchPenduduk) >= 3)
                                <div class="absolute z-[9999] w-full mt-1 bg-white dark:bg-slate-800 rounded-md shadow-xl border border-slate-200 dark:border-slate-700 p-4 text-center" x-show="showDropdown" x-transition x-cloak>
                                    <p class="text-sm text-slate-500">Pencarian "<b>{{ $searchPenduduk }}</b>" tidak ditemukan di data penduduk.</p>
                                </div>
                            @endif
                        </div>                    @endif

                    <flux:input
                        wire:model="nik"
                        label="NIK Warga Terpilih"
                        placeholder="Otomatis terisi dari pencarian..."
                        :disabled="$is_edit || true"
                        type="number"
                        inputmode="numeric"
                        maxlength="16"
                        required
                    />

                    <flux:input
                        wire:model="name"
                        label="Nama Lengkap"
                        placeholder="Otomatis terisi..."
                        disabled
                    />
                @endif

                <flux:input
                    wire:model="no_hp"
                    label="Nomor HP"
                    placeholder="0812xxxxxxxx"
                />

                <flux:input
                    wire:model="password"
                    type="password"
                    label="{{ $is_edit ? 'Kata Sandi Baru (Opsional)' : 'Kata Sandi' }}"
                    placeholder="{{ $is_edit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
                    viewable
                />

                <div class="flex justify-end gap-3 mt-4">
                    <flux:button type="button" variant="ghost" wire:click="$set('showModal', false)">Batal</flux:button>
                    <flux:button type="submit" variant="primary" :disabled="!$is_admin_form && !$name">{{ $is_edit ? 'Simpan Perubahan' : 'Simpan Akun' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    {{-- Modal Detail Penduduk --}}
    <flux:modal wire:model="showDetailModal" class="md:w-[600px]">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-6 text-slate-900 dark:text-white flex items-center gap-2 border-b border-slate-200 pb-3">
                <flux:icon.identification class="size-5 text-blue-600" />
                Detail Data Kependudukan
            </h2>

            @if($detailPenduduk)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nomor Induk Kependudukan</span>
                    <p class="font-mono text-sm font-semibold text-slate-900 mt-1">{{ $detailPenduduk->nik }}</p>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nomor Kartu Keluarga</span>
                    <p class="font-mono text-sm font-semibold text-slate-900 mt-1">{{ $detailPenduduk->no_kk }}</p>
                </div>

                <div class="md:col-span-2">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Lengkap</span>
                    <p class="text-base font-bold text-slate-900 mt-1">{{ $detailPenduduk->nama }}</p>
                </div>

                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tempat Lahir</span>
                    <p class="text-sm font-medium text-slate-900 mt-1">{{ $detailPenduduk->tempat_lahir }}</p>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tanggal Lahir</span>
                    <p class="text-sm font-medium text-slate-900 mt-1">
                        {{ \Carbon\Carbon::parse($detailPenduduk->tanggal_lahir)->format('d F Y') }}
                        <span class="text-xs text-slate-500 ml-1">({{ \Carbon\Carbon::parse($detailPenduduk->tanggal_lahir)->age }} Tahun)</span>
                    </p>
                </div>

                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Jenis Kelamin</span>
                    <p class="text-sm font-medium text-slate-900 mt-1">{{ $detailPenduduk->jenis_kelamin }}</p>
                </div>

                <div class="md:col-span-2">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Alamat Lengkap</span>
                    <p class="text-sm font-medium text-slate-900 mt-1 leading-relaxed">
                        {{ $detailPenduduk->alamat }}<br>
                        RT {{ str_pad($detailPenduduk->no_rt, 2, '0', STR_PAD_LEFT) }} / RW {{ str_pad($detailPenduduk->no_rw, 2, '0', STR_PAD_LEFT) }}<br>
                        Desa Tatung, Kecamatan Balong
                    </p>
                </div>
            </div>
            @endif

            <div class="flex justify-end mt-8 pt-4 border-t border-slate-100">
                <flux:button type="button" variant="primary" wire:click="$set('showDetailModal', false)">Tutup</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
