<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;

// ==========================================
// 1. LANDING PAGE
// ==========================================
Route::get("/", function () {
    $beritaTerbaru = \App\Models\Berita::where("is_published", true)
        ->latest("published_at")
        ->take(4)
        ->get();
    return view("landing", ["beritaTerbaru" => $beritaTerbaru]);
})->name("home");

// ==========================================
// 2. HALAMAN PUBLIK (FRONTEND)
// ==========================================
Route::name("publik.")->group(function () {
    // Profil Desa
    Route::prefix("profil")
        ->name("profil.")
        ->group(function () {
            Route::view("sejarah", "pages.profil.sejarah")->name("sejarah");
            Route::view("visi-misi", "pages.profil.visi-misi")->name(
                "visi-misi",
            );
            Route::view("aparatur", "pages.profil.aparatur")->name("aparatur");
            Route::view("wilayah", "pages.profil.wilayah")->name("wilayah");
        });

    // Publikasi & Informasi
    Route::prefix("publikasi")
        ->name("publikasi.")
        ->group(function () {
            Route::get("berita", function () {
                $beritas = \App\Models\Berita::where("is_published", true)
                    ->latest("published_at")
                    ->paginate(9);
                return view("pages.publikasi.berita.index", compact("beritas"));
            })->name("berita.index");

            Route::get("berita/{slug}", function ($slug) {
                $berita = \App\Models\Berita::where("slug", $slug)
                    ->where("is_published", true)
                    ->firstOrFail();
                return view("pages.publikasi.berita.show", compact("berita"));
            })->name("berita.show");

            Route::view("agenda", "pages.publikasi.agenda")->name("agenda");
            Route::view("galeri", "pages.publikasi.galeri")->name("galeri");
        });

    // Transparansi
    Route::prefix("transparansi")
        ->name("transparansi.")
        ->group(function () {
            Route::view("apbdes", "pages.transparansi.apbdes")->name("apbdes");
        });

    // Potensi Desa
    Route::prefix("potensi")
        ->name("potensi.")
        ->group(function () {
            Route::view("umkm", "pages.potensi.umkm")->name("umkm");
            Route::view("pariwisata", "pages.potensi.pariwisata")->name(
                "pariwisata",
            );
        });

    // Layanan Masyarakat
    Route::prefix("layanan")
        ->name("layanan.")
        ->group(function () {
            Route::view(
                "informasi-surat",
                "pages.layanan.informasi-surat",
            )->name("informasi-surat");
        });
});

// Alias demi kompatibilitas link lama yang mungkin sudah hard-coded
Route::get(
    "/berita",
    fn() => redirect()->route("publik.publikasi.berita.index"),
)->name("berita");
Route::view("/infografis", "pages.infografis")->name("infografis");

// ==========================================
// 3. DASHBOARD REDIRECTOR (SETELAH LOGIN)
// ==========================================
Route::middleware(["auth", "verified"])
    ->get("dashboard", function () {
        return auth()
            ->user()
            ->hasAnyRole(["Super Admin", "Admin Kependudukan"])
            ? redirect()->route("admin.dashboard")
            : redirect()->route("warga.dashboard"); // Atau kembali ke home berdasarkan desain auth level Warga
    })
    ->name("dashboard");

// ==========================================
// 4. AREA ADMIN
// ==========================================
Route::middleware(["auth", "verified", "role:Super Admin|Admin Kependudukan"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::livewire("dashboard", "pages::admin.dashboard")->name(
            "dashboard",
        );
        Route::livewire("penduduk", "pages::admin.penduduk")->name("penduduk");
        Route::post("penduduk/import", [
            PendudukController::class,
            "import",
        ])->name("penduduk.import");
        Route::livewire("pengguna", "pages::admin.user-page")->name("pengguna");
        Route::livewire("berita", "pages::admin.berita")->name("berita");
    });

// ==========================================
// 5. AREA WARGA
// ==========================================
Route::middleware(["auth", "verified", "role:Warga"])
    ->prefix("warga")
    ->name("warga.")
    ->group(function () {
        Route::livewire("dashboard", "pages::warga.dashboard")->name(
            "dashboard",
        );
    });

require __DIR__ . "/settings.php";
