<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class ImportLegacyUsers extends Command
{
    protected $signature = 'import:legacy-users';
    protected $description = 'Import user akun dan profil dari CI3 (Mapping ID Wilayah Laravolt)';

    public function handle()
    {
        $this->info('Menyiapkan data referensi wilayah (Laravolt)...');

        // 🚀 TRIK CEPAT: Load semua ID wilayah Laravolt ke dalam memori
        // Laravolt menggunakan kolom 'id' (bukan 'code') dan formatnya TANPA TITIK
        $validProvs = Province::pluck('id')->toArray();
        $validCities = City::pluck('id')->toArray();
        $validDists = District::pluck('id')->toArray();
        $validVills = Village::pluck('id')->toArray();

        $this->info('Memulai impor user (Mode Kilat)...');

        // 1. Ambil semua data dari CI3
        $legacyUsers = DB::connection('legacy')->table('user_akun')->get();
        $legacyProfiles = DB::connection('legacy')->table('user_profil')->get()->keyBy('username');

        $total = count($legacyUsers);
        $chunkSize = 500;
        $now = Carbon::now();

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        // 2. Looping per Chunk (Potongan)
        foreach ($legacyUsers->chunk($chunkSize) as $chunk) {

            $usersData = [];
            $usernames = [];

            foreach ($chunk as $legacy) {
                $profile = $legacyProfiles->get($legacy->username);
                $nama = $profile->nama ?? $legacy->username;

                $usersData[] = [
                    'name' => $nama,
                    'username' => $legacy->username,
                    'email' => $legacy->email,
                    'password' => $legacy->password,
                    'role' => $legacy->is_admin == 1 ? 'admin' : 'candidate',
                    'is_active' => $legacy->is_active == 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $usernames[] = $legacy->username;
            }

            // 3. Bulk Insert ke tabel users
            DB::table('users')->insertOrIgnore($usersData);

            // 4. Ambil ID yang baru saja dibuat untuk mapping ke profil
            $insertedUsers = DB::table('users')->whereIn('username', $usernames)->pluck('id', 'username');

            // 5. Siapkan data profil
            $profilesData = [];
            foreach ($chunk as $legacy) {
                $profile = $legacyProfiles->get($legacy->username);
                $userId = $insertedUsers[$legacy->username] ?? null;

                if ($userId && $profile) {
                    // Handle tanggal 0000-00-00
                    $tglLahir = ($profile->tgl_lahir === '0000-00-00' || empty($profile->tgl_lahir)) ? null : $profile->tgl_lahir;

                    // 👇 MAPPING KODE CI3 KE ID LARAVOLT (Hapus titik) 👇
                    $provId = $profile->provinsi ? str_replace('.', '', $profile->provinsi) : null;
                    $kotaId = $profile->kota ? str_replace('.', '', $profile->kota) : null;
                    $kecId  = $profile->kecamatan ? str_replace('.', '', $profile->kecamatan) : null;
                    $kelId  = $profile->kelurahan ? str_replace('.', '', $profile->kelurahan) : null;

                    $profilesData[] = [
                        'user_id' => $userId,
                        'nama' => $profile->nama,
                        'foto' => $profile->foto,
                        'no_ktp' => $profile->no_ktp,
                        'jenis_kelamin' => $profile->jenis_kelamin,
                        'status_pernikahan' => $profile->status_pernikahan,
                        'tempat_lahir' => $profile->tempat_lahir,
                        'tgl_lahir' => $tglLahir,
                        'alamat' => $profile->alamat,

                        // Validasi apakah ID ada di Laravolt, jika tidak set null
                        'provinsi_id' => in_array($provId, $validProvs) ? $provId : null,
                        'kota_id' => in_array($kotaId, $validCities) ? $kotaId : null,
                        'kecamatan_id' => in_array($kecId, $validDists) ? $kecId : null,
                        'kelurahan_id' => in_array($kelId, $validVills) ? $kelId : null,

                        'telepon' => $profile->telepon,
                        'selular' => $profile->selular,
                        'agama' => $profile->agama,
                        'gol_darah' => $profile->gol_darah,
                        'jml_anak' => $profile->jml_anak,
                        'facebook' => $profile->facebook,
                        'instagram' => $profile->instagram,
                        'tiktok' => $profile->tiktok,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            // 6. Bulk Insert ke tabel user_profiles
            if (!empty($profilesData)) {
                DB::table('user_profiles')->insertOrIgnore($profilesData);
            }

            $bar->advance(count($chunk));
        }

        $bar->finish();
        $this->newLine();
        $this->info("Selesai! {$total} user berhasil diimpor dengan ID Wilayah Laravolt.");
    }
}
