<?php

use App\Models\Pengumuman;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RolePermissionSeeder::class);
    $this->admin = User::factory()->create();
    $this->admin->assignRole('Super Admin');
});

test('admin can see pengumuman page', function () {
    actingAs($this->admin)
        ->get(route('admin.pengumuman'))
        ->assertOk();
});

test('admin can create pengumuman', function () {
    actingAs($this->admin);

    Livewire::test('pages::admin.pengumuman')
        ->set('judul', 'Pengumuman Baru')
        ->set('ringkasan', 'Isi ringkasan pengumuman penting.')
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Pengumuman berhasil ditambahkan');

    $this->assertDatabaseHas('pengumumen', [
        'judul' => 'Pengumuman Baru',
        'ringkasan' => 'Isi ringkasan pengumuman penting.',
    ]);
});

test('admin can edit pengumuman', function () {
    $pengumuman = Pengumuman::factory()->create([
        'judul' => 'Pengumuman Lama',
    ]);

    actingAs($this->admin);

    Livewire::test('pages::admin.pengumuman')
        ->call('edit', $pengumuman->id)
        ->assertSet('judul', 'Pengumuman Lama')
        ->set('judul', 'Pengumuman Diperbarui')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Pengumuman berhasil diperbarui');

    $this->assertDatabaseHas('pengumumen', [
        'id' => $pengumuman->id,
        'judul' => 'Pengumuman Diperbarui',
    ]);
});

test('admin can delete pengumuman', function () {
    $pengumuman = Pengumuman::factory()->create();

    actingAs($this->admin);

    Livewire::test('pages::admin.pengumuman')
        ->call('delete', $pengumuman->id)
        ->assertSee('Pengumuman berhasil dihapus');

    $this->assertDatabaseMissing('pengumumen', [
        'id' => $pengumuman->id,
    ]);
});
