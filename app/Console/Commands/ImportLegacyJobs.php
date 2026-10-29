<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportLegacyJobs extends Command
{
    protected $signature = 'import:legacy-jobs';
    protected $description = 'Import data lowongan dari CodeIgniter ke Laravel';

    public function handle()
    {
        $this->info('Memulai impor data dari tb_loker...');

        $legacyJobs = DB::connection('legacy')->table('tb_loker')->get();

        if ($legacyJobs->isEmpty()) {
            $this->warn('Tidak ada data di tb_loker.');
            return;
        }

        $bar = $this->output->createProgressBar(count($legacyJobs));
        $bar->start();

        foreach ($legacyJobs as $legacy) {
            // Cek apakah data sudah pernah diimpor
            $exists = DB::table('job_listings')->where('id', $legacy->id)->exists();

            if (!$exists) {
                // 👇 GUNAKAN DB::table AGAR ID DARI CI3 TETAP DIPERTAHANKAN 👇
                DB::table('job_listings')->insert([
                    'id' => $legacy->id, // ID Asli CI3
                    'title' => $legacy->posisi,
                    'description' => $legacy->deskripsi,
                    'is_active' => $legacy->is_active == 1,
                    'posted_by' => $legacy->posted_by,
                    'posted_at' => $legacy->posted_at,
                    'created_at' => $legacy->created_at,

                    // Data Dummy (Placeholder)
                    'company' => 'Perusahaan Mitra',
                    'logo_initials' => 'PM',
                    'location' => 'Jakarta',
                    'type' => 'Full-time',
                    'workplace' => 'Onsite',
                    'experience' => 'Min. 1 Tahun',
                    'salary' => 'Kompetitif',
                    'category' => 'engineering',
                    'is_featured' => false,
                    'badges' => json_encode(['New']),
                    'responsibilities' => json_encode(['-']),
                    'qualifications' => json_encode(['-']),
                    'benefits' => json_encode(['-']),
                    'company_info' => 'Informasi perusahaan akan diperbarui.',
                ]);
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Selesai! Data lowongan berhasil diimpor dengan ID asli.");
    }
}
