<?php

namespace App\Livewire\Admin;

use App\Enums\Role;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public int $totalPengguna = 0;

    public int $totalAdmin = 0;

    public int $totalWarga = 0;

    public function mount(): void
    {
        $this->totalPengguna = User::count();
        $this->totalAdmin = User::where('role', Role::Admin->value)->count();
        $this->totalWarga = User::where('role', Role::Warga->value)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
