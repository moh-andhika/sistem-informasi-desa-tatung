<?php

use App\Models\Berita;
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

test('admin can see berita page', function () {
    actingAs($this->admin)
        ->get(route('admin.berita'))
        ->assertOk();
});

test('admin can create berita', function () {
    Storage::fake('public');
    $file = UploadedFile::fake()->image('berita.jpg');

    actingAs($this->admin);

    Livewire::test('pages::admin.berita')
        ->set('judul', 'Berita Baru')
        ->set('ringkasan', 'Ringkasan Berita')
        ->set('konten', 'Konten Berita Lengkap')
        ->set('gambar', $file)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Berita berhasil ditambahkan');

    $this->assertDatabaseHas('beritas', [
        'judul' => 'Berita Baru',
        'ringkasan' => 'Ringkasan Berita',
    ]);
});

test('admin can edit berita', function () {
    $berita = Berita::factory()->create([
        'judul' => 'Berita Lama',
    ]);

    actingAs($this->admin);

    Livewire::test('pages::admin.berita')
        ->call('edit', $berita->id)
        ->assertSet('judul', 'Berita Lama')
        ->set('judul', 'Berita Diperbarui')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Berita berhasil diperbarui');

    $this->assertDatabaseHas('beritas', [
        'id' => $berita->id,
        'judul' => 'Berita Diperbarui',
    ]);
});

test('admin can delete berita', function () {
    $berita = Berita::factory()->create();

    actingAs($this->admin);

    Livewire::test('pages::admin.berita')
        ->call('delete', $berita->id)
        ->assertSee('Berita berhasil dihapus');

    $this->assertDatabaseMissing('beritas', [
        'id' => $berita->id,
    ]);
});

test('non-admin cannot access berita page', function () {
    $user = User::factory()->create();
    $user->assignRole('Warga');

    actingAs($user)
        ->get(route('admin.berita'))
        ->assertForbidden();
});
