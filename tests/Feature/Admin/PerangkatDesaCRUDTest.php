<?php

use App\Models\perangkat_desa;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RolePermissionSeeder::class);
    $this->admin = User::factory()->create();
    $this->admin->assignRole('Super Admin');
});

test('admin can see perangkat desa page', function () {
    actingAs($this->admin)
        ->get(route('admin.perangkat-desa'))
        ->assertOk();
});

test('admin can create perangkat desa', function () {
    Storage::fake('public');
    $file = UploadedFile::fake()->image('foto.jpg');

    actingAs($this->admin);

    Livewire::test('pages::admin.perangkat-desa')
        ->set('nama', 'Rudianto')
        ->set('jabatan', 'Kepala Desa')
        ->set('urutan', 1)
        ->set('gambar', $file)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Perangkat desa berhasil ditambahkan');

    $this->assertDatabaseHas('perangkat_desas', [
        'nama' => 'Rudianto',
        'jabatan' => 'Kepala Desa',
        'urutan' => 1,
    ]);
});

test('admin can edit perangkat desa', function () {
    $perangkat = perangkat_desa::factory()->create([
        'nama' => 'Nama Lama',
    ]);

    actingAs($this->admin);

    Livewire::test('pages::admin.perangkat-desa')
        ->call('edit', $perangkat->id)
        ->assertSet('nama', 'Nama Lama')
        ->set('nama', 'Nama Baru')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Perangkat desa berhasil diperbarui');

    $this->assertDatabaseHas('perangkat_desas', [
        'id' => $perangkat->id,
        'nama' => 'Nama Baru',
    ]);
});

test('admin can delete perangkat desa', function () {
    $perangkat = perangkat_desa::factory()->create();

    actingAs($this->admin);

    Livewire::test('pages::admin.perangkat-desa')
        ->call('delete', $perangkat->id)
        ->assertSee('Perangkat desa berhasil dihapus');

    $this->assertDatabaseMissing('perangkat_desas', [
        'id' => $perangkat->id,
    ]);
});
