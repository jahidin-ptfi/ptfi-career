<?php

namespace App\Enums;

enum StatusPernikahan: string
{
    case K0 = 'K0';
    case K1 = 'K1';
    case K2 = 'K2';
    case K3 = 'K3';
    case TK0 = 'TK0';
    case TK1 = 'TK1';
    case TK2 = 'TK2';
    case TK3 = 'TK3';

    public function label(): string
    {
        return match ($this) {
            self::K0 => 'Menikah, belum punya anak',
            self::K1 => 'Menikah, 1 anak',
            self::K2 => 'Menikah, 2 anak',
            self::K3 => 'Menikah, 3 anak',
            self::TK0 => 'Lajang',
            self::TK1 => 'Duda/Janda, 1 anak',
            self::TK2 => 'Duda/Janda, 2 anak',
            self::TK3 => 'Duda/Janda, 3 anak',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
