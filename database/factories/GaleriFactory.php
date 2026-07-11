<?php

namespace Database\Factories;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Galeri>
 */
class GaleriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(),
            'deskripsi' => fake()->paragraph(),
            'gambar' => 'galeri/example.jpg',
            'is_jumbotron' => false,
        ];
    }

    public function jumbotron(): static
    {
        return $this->state(['is_jumbotron' => true]);
    }
}
