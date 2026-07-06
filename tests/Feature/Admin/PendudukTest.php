<?php

use App\Imports\PendudukImport;
use App\Models\penduduk;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RolePermissionSeeder::class);
    $this->admin = User::factory()->create();
    $this->admin->assignRole('Super Admin');
});

test('admin can see penduduk page', function () {
    actingAs($this->admin)
        ->get(route('admin.penduduk'))
        ->assertOk();
});

test('admin can import penduduk data', function () {
    Excel::fake();
    $this->withoutMiddleware();

    $file = UploadedFile::fake()->create('penduduk.xlsx');

    actingAs($this->admin)
        ->post(route('admin.penduduk.import'), [
            'file_excel' => $file,
        ])
        ->assertRedirect();

    Excel::assertImported('penduduk.xlsx', function (PendudukImport $import) {
        return true;
    });
});

test('admin can see list of penduduk', function () {
    $penduduk = penduduk::factory()->count(3)->create();

    actingAs($this->admin)
        ->get(route('admin.penduduk'))
        ->assertSee($penduduk->first()->nama)
        ->assertSee($penduduk->last()->nik);
});
