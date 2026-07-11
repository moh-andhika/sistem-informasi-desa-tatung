<?php

use App\Models\Berita;

test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
});

test('landing page renders with beritaLainnya when news exists', function () {
    Berita::factory()->count(4)->create([
        'is_published' => true,
        'published_at' => now()->subMinutes(1),
    ]);

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertViewHas('beritaLainnya');
});
