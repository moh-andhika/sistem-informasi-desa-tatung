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
        // Panggil seeder role & permission
        $this->call(RolePermissionSeeder::class);

        // Admin Desa Tatung
        $admin = User::factory()->create([
            'name' => 'Admin Desa Tatung',
            'nik' => '6201010101010001',
            'no_hp' => '08123456789',
            'email' => 'admin@desatatung.id',
            'password' => bcrypt('admin123'),
        ]);
        $admin->assignRole('Super Admin');

        // Contoh Warga
        $warga = User::factory()->create([
            'name' => 'Budi Santoso',
            'nik' => '6201010101010002',
            'no_hp' => '08234567890',
            'email' => 'warga@desatatung.id',
            'password' => bcrypt('warga123'),
        ]);
        $warga->assignRole('Warga');

        // Warga tambahan untuk testing
        $wargas = User::factory()->count(5)->create();
        foreach ($wargas as $w) {
            $w->assignRole('Warga');
        }
    }
}
