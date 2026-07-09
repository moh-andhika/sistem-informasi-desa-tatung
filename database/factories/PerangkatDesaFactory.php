<?php

namespace Database\Factories;

use App\Models\perangkat_desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<perangkat_desa>
 */
class PerangkatDesaFactory extends Factory
{
    protected $model = perangkat_desa::class;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'jabatan' => fake()->randomElement([
                'Kepala Desa',
                'Sekretaris Desa',
                'Kaur Keuangan',
                'Kaur Umum',
                'Kaur Perencanaan',
                'Kasi Pemerintahan',
                'Kasi Kesejahteraan',
                'Kasi Pelayanan',
            ]),
            'gambar' => null,
            'urutan' => fake()->numberBetween(0, 20),
        ];
    }
}
