<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Agama;
use App\Enums\StatusPernikahan;
use Illuminate\Support\Facades\DB;
use App\Enums\GolonganDarah;

class UserProfile extends Model
{
    // Mengizinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];

    public function getAgamaLabelAttribute()
    {
        $value = $this->getRawOriginal('agama');
        if (is_null($value) || $value === '') return '-';
        return Agama::tryFrom($value)?->label() ?? $value;
    }

    public function getStatusPernikahanLabelAttribute()
    {
        $value = $this->getRawOriginal('status_pernikahan');
        if (is_null($value) || $value === '') return '-';
        return StatusPernikahan::tryFrom($value)?->label() ?? $value;
    }

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProvinsiNamaAttribute()
    {
        if (!$this->provinsi_id) return 'Provinsi';
        // Mencari nama berdasarkan kolom 'code' di tabel Laravolt
        return DB::table('indonesia_provinces')->where('code', $this->provinsi_id)->value('name') ?? $this->provinsi_id;
    }

    public function getKotaNamaAttribute()
    {
        if (!$this->kota_id) return 'Kab/Kota';
        return DB::table('indonesia_cities')->where('code', $this->kota_id)->value('name') ?? $this->kota_id;
    }

    public function getKecamatanNamaAttribute()
    {
        if (!$this->kecamatan_id) return '-';
        return DB::table('indonesia_districts')->where('code', $this->kecamatan_id)->value('name') ?? $this->kecamatan_id;
    }

    public function getKelurahanNamaAttribute()
    {
        if (!$this->kelurahan_id) return '-';
        return DB::table('indonesia_villages')->where('code', $this->kelurahan_id)->value('name') ?? $this->kelurahan_id;
    }

    public function getGolDarahLabelAttribute()
    {
        $value = $this->getRawOriginal('gol_darah');
        if (is_null($value) || $value === '') return '-';

        // Jika isinya 'A+', dia ambil dari Enum.
        // Jika isinya 'A' (data lama), tryFrom gagal, dan dia tampilkan 'A' aslinya.
        return GolonganDarah::tryFrom($value)?->label() ?? $value;
    }
}
