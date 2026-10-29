<?php

namespace App\Enums;

enum Agama: string
{
    case ISLAM = '1';
    case KRISTEN_KATHOLIK = '2';
    case KRISTEN_PROTESTAN = '3';
    case HINDU = '4';
    case BUDHA = '5';
    case LAINNYA = '6';

    public function label(): string
    {
        return match ($this) {
            self::ISLAM => 'Islam',
            self::KRISTEN_KATHOLIK => 'Kristen Katholik',
            self::KRISTEN_PROTESTAN => 'Kristen Protestan',
            self::HINDU => 'Hindu',
            self::BUDHA => 'Budha',
            self::LAINNYA => 'Lain-Lain',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
