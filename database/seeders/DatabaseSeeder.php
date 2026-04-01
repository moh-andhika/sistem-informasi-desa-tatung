<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Desa Tatung
        User::factory()->admin()->create([
            'name' => 'Admin Desa Tatung',
            'nik' => '6201010101010001',
            'no_hp' => '08123456789',
            'email' => 'admin@desatatung.id',
            'password' => bcrypt('admin123'),
        ]);

        // Contoh Warga
        User::factory()->warga()->create([
            'name' => 'Budi Santoso',
            'nik' => '6201010101010002',
            'no_hp' => '08234567890',
            'email' => 'warga@desatatung.id',
            'password' => bcrypt('warga123'),
        ]);

        // Warga tambahan untuk testing
        User::factory()->warga()->count(5)->create();
    }
}
