<?php

namespace App\Enums;

enum GolonganDarah: string
{
    case A_POSITIF = 'A+';
    case A_NEGATIF = 'A-';
    case B_POSITIF = 'B+';
    case B_NEGATIF = 'B-';
    case AB_POSITIF = 'AB+';
    case AB_NEGATIF = 'AB-';
    case O_POSITIF = 'O+';
    case O_NEGATIF = 'O-';
    case TIDAK_TAHU = 'Tidak Tahu';

    public function label(): string
    {
        return match ($this) {
            self::A_POSITIF => 'A+',
            self::A_NEGATIF => 'A-',
            self::B_POSITIF => 'B+',
            self::B_NEGATIF => 'B-',
            self::AB_POSITIF => 'AB+',
            self::AB_NEGATIF => 'AB-',
            self::O_POSITIF => 'O+',
            self::O_NEGATIF => 'O-',
            self::TIDAK_TAHU => 'Tidak Tahu',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
