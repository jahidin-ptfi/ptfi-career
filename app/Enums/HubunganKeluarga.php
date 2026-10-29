<?php

namespace App\Enums;

enum HubunganKeluarga: string
{
    case SUAMI = '1';
    case ISTRI = '2';
    case ANAK_PERTAMA = '3';
    case ANAK_KEDUA = '4';
    case ANAK_KETIGA = '5';
    case AYAH_KANDUNG = '10';
    case IBU_KANDUNG = '11';
    case AYAH_MERTUA = '12';
    case IBU_MERTUA = '13';

    public function label(): string
    {
        return match ($this) {
            self::SUAMI => 'Suami',
            self::ISTRI => 'Istri',
            self::ANAK_PERTAMA => 'Anak Pertama',
            self::ANAK_KEDUA => 'Anak Kedua',
            self::ANAK_KETIGA => 'Anak Ketiga',
            self::AYAH_KANDUNG => 'Ayah Kandung',
            self::IBU_KANDUNG => 'Ibu Kandung',
            self::AYAH_MERTUA => 'Ayah Mertua',
            self::IBU_MERTUA => 'Ibu Mertua',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
