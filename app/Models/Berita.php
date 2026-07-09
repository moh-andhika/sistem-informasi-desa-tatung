<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected function gambarUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->gambar) {
                return null;
            }

            if (str_starts_with($this->gambar, 'http')) {
                return $this->gambar;
            }

            return Storage::url($this->gambar);
        });
    }
}
