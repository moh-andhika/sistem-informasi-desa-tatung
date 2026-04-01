<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Warga\Dashboard as WargaDashboard;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::view('/', 'welcome')->name('home');

// Redirect setelah login berdasarkan role
Route::middleware(['auth', 'verified'])
    ->get('dashboard', function () {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('warga.dashboard');
    })
    ->name('dashboard');

// Route khusus Admin
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard');
    });

// Route khusus Warga
Route::middleware(['auth', 'verified', 'role:warga'])
    ->prefix('warga')
    ->name('warga.')
    ->group(function () {
        Route::get('dashboard', WargaDashboard::class)->name('dashboard');
    });

require __DIR__.'/settings.php';
