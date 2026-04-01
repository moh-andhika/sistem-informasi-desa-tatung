<?php

use Illuminate\Support\Facades\Route;

// Landing page
Route::view("/", "landing")->name("home");

// Halaman publik berita & infografis
Route::view("/berita", "pages.berita")->name("berita");
Route::view("/infografis", "pages.infografis")->name("infografis");

// Redirect setelah login: hanya admin ke dashboard, selain itu kembali ke home
Route::middleware(["auth", "verified"])
    ->get("dashboard", function () {
        return auth()->user()->isAdmin()
            ? redirect()->route("admin.dashboard")
            : redirect()->route("home");
    })
    ->name("dashboard");

// Route khusus Admin
Route::middleware(["auth", "verified", "role:admin"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::livewire("dashboard", "pages::admin.dashboard")->name(
            "dashboard",
        );
        Route::livewire("penduduk", "pages::admin.penduduk")->name("penduduk");
    });

// Route khusus Warga (opsional, langsung akses via prefix warga)
Route::middleware(["auth", "verified", "role:warga"])
    ->prefix("warga")
    ->name("warga.")
    ->group(function () {
        Route::livewire("dashboard", "pages::warga.dashboard")->name(
            "dashboard",
        );
    });

require __DIR__ . "/settings.php";
