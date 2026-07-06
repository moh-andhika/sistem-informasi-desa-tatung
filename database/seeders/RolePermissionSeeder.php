<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Default Permissions
        $permissions = [
            'manage-penduduk',
            'manage-surat',
            'manage-berita',
            'manage-pengaturan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Create Roles and Assign Permissions

        // Super Admin (Bypass everything via Super Admin trait usually, but we define it here)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        // Assign all permissions for now just in case
        $superAdmin->syncPermissions($permissions);

        // Admin Kependudukan
        $adminKependudukan = Role::firstOrCreate(['name' => 'Admin Kependudukan']);
        $adminKependudukan->givePermissionTo('manage-penduduk');

        // Warga (Standard User)
        // Warga doesn't need specific general active permissions right now, just basic actions
        $warga = Role::firstOrCreate(['name' => 'Warga']);
    }
}
