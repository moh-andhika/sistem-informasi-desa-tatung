<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'keperluan',
        'data_tambahan',
        'status',
        'keterangan_admin',
        'nomor_surat',
        'file_path',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
