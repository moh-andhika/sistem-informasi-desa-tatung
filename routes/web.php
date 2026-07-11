<?php

use App\Http\Controllers\PendudukController;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\perangkat_desa;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. LANDING PAGE
// ==========================================
Route::get('/', function () {
    $beritaTerbaru = Berita::where('is_published', true)
        ->latest('published_at')
        ->take(4)
        ->get();

    $beritaLainnya = $beritaTerbaru->skip(1)->values();

    $pengumuman = Pengumuman::where('is_active', true)
        ->latest('published_at')
        ->take(3)
        ->get();

    $runningTexts = Pengumuman::where('is_active', true)
        ->where('is_running_text', true)
        ->latest('published_at')
        ->get();

    $galeri = Galeri::latest()->take(6)->get();
    $jumbotron = Galeri::jumbotron()->first();

    $perangkatDesa = perangkat_desa::orderBy('urutan')->get();

    return view('landing', [
        'beritaTerbaru' => $beritaTerbaru,
        'beritaLainnya' => $beritaLainnya,
        'pengumuman' => $pengumuman,
        'runningTexts' => $runningTexts,
        'galeri' => $galeri,
        'jumbotron' => $jumbotron,
        'perangkatDesa' => $perangkatDesa,
    ]);
})->name('home');

// ==========================================
// 2. HALAMAN PUBLIK (FRONTEND)
// ==========================================
Route::name('publik.')->group(function () {
    // Profil Desa
    Route::prefix('profil')
        ->name('profil.')
        ->group(function () {
            Route::view('sejarah', 'pages.profil.sejarah')->name('sejarah');
            Route::view('visi-misi', 'pages.profil.visi-misi')->name(
                'visi-misi',
            );
            Route::get('aparatur', function () {
                $aparatur = perangkat_desa::orderBy('urutan')->get();

                return view('pages.profil.aparatur', compact('aparatur'));
            })->name('aparatur');
            Route::view('wilayah', 'pages.profil.wilayah')->name('wilayah');
        });

    // Publikasi & Informasi
    Route::prefix('publikasi')
        ->name('publikasi.')
        ->group(function () {
            Route::get('berita', function () {
                $beritas = Berita::where('is_published', true)
                    ->latest('published_at')
                    ->paginate(9);

                return view('pages.publikasi.berita.index', compact('beritas'));
            })->name('berita.index');

            Route::get('berita/{slug}', function ($slug) {
                $berita = Berita::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

                return view('pages.publikasi.berita.show', compact('berita'));
            })->name('berita.show');

            Route::view('agenda', 'pages.publikasi.agenda')->name('agenda');
            Route::get('galeri', function () {
                $galeris = Galeri::latest()->paginate(12);

                return view('pages.publikasi.galeri', compact('galeris'));
            })->name('galeri');
        });

    // Transparansi
    Route::prefix('transparansi')
        ->name('transparansi.')
        ->group(function () {
            Route::view('apbdes', 'pages.transparansi.apbdes')->name('apbdes');
        });

    // Potensi Desa
    Route::prefix('potensi')
        ->name('potensi.')
        ->group(function () {
            Route::view('umkm', 'pages.potensi.umkm')->name('umkm');
            Route::view('pariwisata', 'pages.potensi.pariwisata')->name(
                'pariwisata',
            );
        });

    // Layanan Masyarakat
    Route::prefix('layanan')
        ->name('layanan.')
        ->group(function () {
            Route::view(
                'informasi-surat',
                'pages.layanan.informasi-surat',
            )->name('informasi-surat');
        });
});

// Alias demi kompatibilitas link lama yang mungkin sudah hard-coded
Route::get(
    '/berita',
    fn () => redirect()->route('publik.publikasi.berita.index'),
)->name('berita');
Route::view('/infografis', 'pages.infografis')->name('infografis');

// ==========================================
// 3. DASHBOARD REDIRECTOR (SETELAH LOGIN)
// ==========================================
Route::middleware(['auth', 'verified'])
    ->get('dashboard', function () {
        return auth()
            ->user()
            ->hasAnyRole(['Super Admin', 'Admin Kependudukan'])
            ? redirect()->route('admin.dashboard')
            : redirect()->route('warga.dashboard'); // Atau kembali ke home berdasarkan desain auth level Warga
    })
    ->name('dashboard');

// ==========================================
// 4. AREA ADMIN
// ==========================================
Route::middleware(['auth', 'verified', 'role:Super Admin|Admin Kependudukan'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::livewire('dashboard', 'pages::admin.dashboard')->name(
            'dashboard',
        );
        Route::livewire('penduduk', 'pages::admin.penduduk')->name('penduduk');
        Route::post('penduduk/import', [
            PendudukController::class,
            'import',
        ])->name('penduduk.import');
        Route::livewire('pengguna', 'pages::admin.user-page')->name('pengguna');
        Route::livewire('berita', 'pages::admin.berita')->name('berita');
        Route::livewire('galeri', 'pages::admin.galeri')->name('galeri');
        Route::livewire('pengumuman', 'pages::admin.pengumuman')->name('pengumuman');
        Route::livewire('perangkat-desa', 'pages::admin.perangkat-desa')->name('perangkat-desa');
        Route::livewire('permohonan', 'pages::admin.permohonan')->name(
            'permohonan',
        );
    });

// ==========================================
// 5. AREA WARGA
// ==========================================
Route::middleware(['auth', 'verified', 'role:Warga'])
    ->prefix('warga')
    ->name('warga.')
    ->group(function () {
        Route::livewire('dashboard', 'pages::warga.dashboard')->name(
            'dashboard',
        );
    });

require __DIR__.'/settings.php';
