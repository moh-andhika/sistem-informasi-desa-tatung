<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'is_jumbotron',
    ];

    public function scopeJumbotron($query)
    {
        return $query->where('is_jumbotron', true);
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? Storage::disk('public')->url($this->gambar)
            : asset('assets/images/jumbotron.jpg');
    }
}
