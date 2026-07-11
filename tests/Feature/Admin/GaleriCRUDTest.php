<?php

use App\Models\Galeri;
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

test('admin can see galeri page', function () {
    actingAs($this->admin)
        ->get(route('admin.galeri'))
        ->assertOk();
});

test('admin can create galeri entry', function () {
    Storage::fake('public');
    $file = UploadedFile::fake()->image('photo.jpg');

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->set('judul', 'Foto Kegiatan')
        ->set('deskripsi', 'Deskripsi foto kegiatan desa.')
        ->set('gambar', $file)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Foto galeri berhasil ditambahkan');

    $this->assertDatabaseHas('galeris', [
        'judul' => 'Foto Kegiatan',
        'deskripsi' => 'Deskripsi foto kegiatan desa.',
    ]);
});

test('admin can edit galeri entry', function () {
    $galeri = Galeri::factory()->create([
        'judul' => 'Foto Lama',
    ]);

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->call('edit', $galeri->id)
        ->assertSet('judul', 'Foto Lama')
        ->set('judul', 'Foto Baru')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Foto galeri berhasil diperbarui');

    $this->assertDatabaseHas('galeris', [
        'id' => $galeri->id,
        'judul' => 'Foto Baru',
    ]);
});

test('admin can set galeri as jumbotron', function () {
    $galeri = Galeri::factory()->create(['judul' => 'Jumbotron Foto']);

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->call('toggleJumbotron', $galeri->id);

    $this->assertDatabaseHas('galeris', [
        'id' => $galeri->id,
        'is_jumbotron' => true,
    ]);
});

test('admin can remove jumbotron status', function () {
    $galeri = Galeri::factory()->jumbotron()->create(['judul' => 'Jumbotron Foto']);

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->call('toggleJumbotron', $galeri->id);

    $this->assertDatabaseHas('galeris', [
        'id' => $galeri->id,
        'is_jumbotron' => false,
    ]);
});

test('jumbotron status is unique — setting one unsets others', function () {
    $galeri1 = Galeri::factory()->jumbotron()->create(['judul' => 'Foto Satu']);
    $galeri2 = Galeri::factory()->create(['judul' => 'Foto Dua']);

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->call('toggleJumbotron', $galeri2->id);

    $this->assertDatabaseHas('galeris', ['id' => $galeri1->id, 'is_jumbotron' => false]);
    $this->assertDatabaseHas('galeris', ['id' => $galeri2->id, 'is_jumbotron' => true]);
});

test('admin can delete galeri entry', function () {
    $galeri = Galeri::factory()->create();

    actingAs($this->admin);

    Livewire::test('pages::admin.galeri')
        ->call('delete', $galeri->id)
        ->assertSee('Foto galeri berhasil dihapus');

    $this->assertDatabaseMissing('galeris', [
        'id' => $galeri->id,
    ]);
});
