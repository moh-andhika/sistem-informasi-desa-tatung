<?php

namespace Database\Factories;

use App\Models\PermohonanSurat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PermohonanSurat>
 */
class PermohonanSuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'jenis_surat' => fake()->randomElement(['Surat Keterangan Domisili', 'Surat Pengantar Nikah', 'Surat Keterangan Usaha']),
            'keperluan' => fake()->sentence(),
            'status' => 'pending',
            'data_tambahan' => [],
        ];
    }
}
