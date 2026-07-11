<?php

namespace App\Services;

class NavigationService
{
    /**
     * Get the public navigation menu array.
     */
    public function getPublicMenu(): array
    {
        return [
            [
                'label' => 'Beranda',
                'route' => 'home',
                'active_pattern' => 'home',
                'subitems' => null,
            ],
            [
                'label' => 'Profil Desa',
                'active_pattern' => 'publik.profil.*',
                'subitems' => [

                    ['label' => 'Aparatur Desa', 'route' => 'publik.profil.aparatur'],
                    ['label' => 'Peta & Wilayah', 'route' => 'publik.profil.wilayah'],
                ],
            ],
            [
                'label' => 'Publikasi',
                'active_pattern' => 'publik.publikasi.*',
                'subitems' => [
                    ['label' => 'Aparatur Desa', 'route' => 'publik.profil.aparatur'],
                    ['label' => 'Peta & Wilayah', 'route' => 'publik.profil.wilayah'],
                ],
            ],
            [
                'label' => 'Potensi',
                'active_pattern' => 'publik.potensi.*',
                'subitems' => [
                    ['label' => 'Produk UMKM', 'route' => 'publik.potensi.umkm'],
                    ['label' => 'Pariwisata', 'route' => 'publik.potensi.pariwisata'],
                ],
            ],
            [
                'label' => 'Data Desa',
                'active_pattern' => 'publik.transparansi.*',
                'subitems' => [
                    ['label' => 'Info APBDes', 'route' => 'publik.transparansi.apbdes'],
                ],
            ],
            [
                'label' => 'Layanan',
                'route' => 'publik.layanan.informasi-surat',
                'active_pattern' => 'publik.layanan.*',
                'subitems' => [
                    ['label' => 'Informasi Surat', 'route' => 'publik.layanan.informasi-surat'],
                    ['is_divider' => true],
                    ['label' => 'Pengajuan Online', 'route' => 'login'],
                ],
            ],
            [
                'label' => 'Infografis',
                'route' => 'infografis',
                'active_pattern' => 'infografis',
                'subitems' => null,
            ],
        ];
    }
}
