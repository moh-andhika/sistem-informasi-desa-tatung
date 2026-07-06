<?php

namespace Database\Factories;

use App\Models\penduduk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_kk' => fake()->numerify('################'),
            'nik' => fake()->unique()->numerify('################'),
            'nama' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date('Y-m-d', '-18 years'),
            'alamat' => fake()->address(),
            'no_rt' => fake()->numerify('###'),
            'no_rw' => fake()->numerify('###'),
        ];
    }
}
