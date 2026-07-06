<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = fake()->sentence();

        return [
            'judul' => $judul,
            'slug' => Str::slug($judul),
            'ringkasan' => fake()->paragraph(),
            'konten' => fake()->paragraphs(3, true),
            'gambar' => 'berita/example.jpg',
            'is_published' => fake()->boolean(),
            'published_at' => now(),
        ];
    }
}
