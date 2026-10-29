<?php

namespace App\Enums;

enum TingkatPendidikan: int
{
    case SD = 1;
    case SMP = 2;
    case SMA = 3;
    case D1 = 4;
    case D2 = 5;
    case D3 = 6;
    case S1 = 7;
    case S2 = 8;
    case S3 = 9;

    public function label(): string
    {
        return match ($this) {
            self::SD => 'SD',
            self::SMP => 'SMP',
            self::SMA => 'SMA/SMK',
            self::D1 => 'D1',
            self::D2 => 'D2',
            self::D3 => 'D3',
            self::S1 => 'S1',
            self::S2 => 'S2',
            self::S3 => 'S3',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
