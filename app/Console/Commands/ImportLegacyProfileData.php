<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class ImportLegacyProfileData extends Command
{
    protected $signature = 'import:legacy-profile-data';
    protected $description = 'Import data profil dengan mode TURBO (Bulk Insert & FK Off)';

    public function handle()
    {
        $this->info('Menyiapkan mapping user...');
        $userMap = User::pluck('id', 'username')->toArray();

        if (empty($userMap)) {
            $this->error('Tabel users kosong. Jalankan import:legacy-users dulu.');
            return;
        }

        // 🚀 TURBO MODE: Matikan pengecekan Foreign Key sementara
        // Ini membuat proses insert 5x lebih cepat
        Schema::disableForeignKeyConstraints();

        try {
            // --- 1. Pendidikan ---
            $this->importTable(
                'p_pendidikan',
                'user_educations',
                function ($edu, $userId) {
                    return [
                        'user_id' => $userId,
                        'tingkat' => $edu->tingkat,
                        'nama' => $edu->nama,
                        'jurusan' => $edu->jurusan,
                        'periode_awal' => $edu->periode_awal,
                        'periode_akhir' => $edu->periode_akhir,
                    ];
                },
                $userMap
            );

            // --- 2. Pengalaman Kerja ---
            $this->importTable(
                'p_pengalaman_kerja',
                'user_experiences',
                function ($exp, $userId) {
                    return [
                        'user_id' => $userId,
                        'perusahaan' => $exp->perusahaan,
                        'jabatan' => $exp->jabatan,
                        'tgl_masuk' => ($exp->tgl_masuk === '0000-00-00' || empty($exp->tgl_masuk)) ? now() : $exp->tgl_masuk,
                        'tgl_keluar' => ($exp->tgl_keluar === '0000-00-00' || empty($exp->tgl_keluar)) ? now() : $exp->tgl_keluar,
                        'gaji' => $exp->gaji,
                        'deskripsi' => $exp->deskripsi,
                        'alasan' => $exp->alasan,
                    ];
                },
                $userMap
            );

            // --- 3. Kursus ---
            $this->importTable(
                'p_kursus',
                'user_courses',
                function ($kur, $userId) {
                    return [
                        'user_id' => $userId,
                        'nama' => $kur->nama,
                        'lembaga' => $kur->lembaga,
                        'dibiayai_oleh' => $kur->dibiayai_oleh,
                        'periode_awal' => $kur->periode_awal,
                        'periode_akhir' => $kur->periode_akhir,
                    ];
                },
                $userMap
            );

            // --- 4a. Master Skill ---
            $this->info('Mengimpor Master Skill...');
            $masterSkills = DB::connection('legacy')->table('tb_skill')->get();
            $skillsData = [];
            $now = now();
            foreach ($masterSkills as $ms) {
                $skillsData[] = [
                    'id' => $ms->id,
                    'nama' => $ms->skill,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            foreach (array_chunk($skillsData, 5000) as $batch) {
                DB::table('skills')->insert($batch);
            }
            $this->info(" -> " . count($skillsData) . " master skill berhasil masuk.");

            // --- 4b. User Skill ---
            $this->importTable(
                'p_skill',
                'user_skills',
                function ($us, $userId) {
                    return [
                        'user_id' => $userId,
                        'skill_id' => $us->skill_id,
                    ];
                },
                $userMap
            );

            // --- 5. Kontak Darurat ---
            $this->importTable(
                'p_kontak_darurat',
                'user_emergency_contacts',
                function ($kd, $userId) {
                    return [
                        'user_id' => $userId,
                        'nama' => $kd->nama,
                        'hubungan' => $kd->hubungan,
                        'alamat' => $kd->alamat,
                        'kontak' => $kd->kontak,
                    ];
                },
                $userMap
            );

            // --- 6. Keluarga 1 & 2 ---
            $this->importTable(
                'p_keluarga1',
                'user_families',
                function ($k1, $userId) {
                    return [
                        'user_id' => $userId,
                        'tipe' => 1,
                        'nama' => $k1->nama,
                        'hubungan' => $k1->hubungan,
                        'jenis_kelamin' => $k1->jenis_kelamin,
                        'tempat_lahir' => $k1->tempat_lahir,
                        'tgl_lahir' => ($k1->tgl_lahir === '0000-00-00' || empty($k1->tgl_lahir)) ? now() : $k1->tgl_lahir,
                    ];
                },
                $userMap
            );

            $this->importTable(
                'p_keluarga2',
                'user_families',
                function ($k2, $userId) {
                    return [
                        'user_id' => $userId,
                        'tipe' => 2,
                        'nama' => $k2->nama,
                        'hubungan' => $k2->hubungan,
                        'jenis_kelamin' => $k2->jenis_kelamin,
                        'tempat_lahir' => $k2->tempat_lahir,
                        'tgl_lahir' => ($k2->tgl_lahir === '0000-00-00' || empty($k2->tgl_lahir)) ? now() : $k2->tgl_lahir,
                    ];
                },
                $userMap
            );
        } finally {
            // 🚀 Nyalakan kembali Foreign Key setelah selesai
            Schema::enableForeignKeyConstraints();
        }

        $this->info('🎉 Selesai! Semua data profil berhasil diimpor dengan SANGAT CEPAT.');
    }

    /**
     * Fungsi Helper: Tarik semua data dari legacy, proses di memori, insert massal per 5000 baris.
     */
    private function importTable($legacyTable, $newTable, $mapCallback, $userMap)
    {
        $this->info("Mengimpor {$legacyTable} ke {$newTable}...");

        // 1. Tarik SEMUA data dari legacy DALAM SEKALI QUERY (tanpa offset)
        $records = DB::connection('legacy')->table($legacyTable)->get();

        if ($records->isEmpty()) {
            $this->info(" -> Tidak ada data.");
            return;
        }

        $data = [];
        $now = now();

        // 2. Proses di memori (super cepat)
        foreach ($records as $record) {
            if (isset($userMap[$record->username])) {
                $row = $mapCallback($record, $userMap[$record->username]);
                $row['created_at'] = $now;
                $row['updated_at'] = $now;
                $data[] = $row;
            }
        }

        // 3. Insert massal per 5000 baris (Jauh lebih cepat dari 1000)
        $total = 0;
        foreach (array_chunk($data, 5000) as $batch) {
            DB::table($newTable)->insert($batch);
            $total += count($batch);
        }

        $this->info(" -> {$total} data berhasil masuk ke tabel {$newTable}.");
    }
}
