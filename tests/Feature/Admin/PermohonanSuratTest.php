<?php

use App\Models\PermohonanSurat;
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

test('admin can see permohonan surat page', function () {
    actingAs($this->admin)
        ->get(route('admin.permohonan'))
        ->assertOk();
});

test('admin can update permohonan status', function () {
    $permohonan = PermohonanSurat::factory()->create([
        'status' => 'pending',
    ]);

    actingAs($this->admin);

    Livewire::test('pages::admin.permohonan')
        ->call('updateStatus', $permohonan->id, 'proses')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('permohonan_surats', [
        'id' => $permohonan->id,
        'status' => 'proses',
    ]);
});

test('admin can filter permohonan by status', function () {
    PermohonanSurat::factory()->create(['status' => 'selesai', 'jenis_surat' => 'Surat A']);
    PermohonanSurat::factory()->create(['status' => 'pending', 'jenis_surat' => 'Surat B']);

    actingAs($this->admin);

    Livewire::test('pages::admin.permohonan')
        ->set('filterStatus', 'selesai')
        ->assertSee('Surat A')
        ->assertDontSee('Surat B');
});
