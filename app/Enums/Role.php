<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Warga = 'warga';

    public function label(): string
    {
        return match ($this) {
            Role::Admin => 'Admin Desa',
            Role::Warga => 'Warga',
        };
    }

    public function color(): string
    {
        return match ($this) {
            Role::Admin => 'red',
            Role::Warga => 'blue',
        };
    }
}
