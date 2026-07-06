<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';

    protected $fillable = [
        'judul',
        'ringkasan',
        'is_active',
        'is_running_text',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_running_text' => 'boolean',
        'published_at' => 'datetime',
    ];
}
