<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportAllLegacy extends Command
{
    protected $signature = 'import:all-legacy
                            {--fresh : Reset database (migrate:fresh) sebelum impor}
                            {--force : Lewati konfirmasi interaktif}';

    protected $description = 'Import SEMUA data legacy (Wilayah Laravolt, User, Jobs, Profil, Lamaran) secara berurutan';

    public function handle()
    {
        $startTime = microtime(true);

        // 1. Konfirmasi (untuk mencegah kecelakaan)
        if (!$this->option('force')) {
            $this->warn('Perintah ini akan mengimpor SEMUA data legacy ke database Laravel.');

            if ($this->option('fresh')) {
                $this->error('WARNING: Opsi --fresh akan MENGHAPUS SEMUA TABEL di database!');
            }

            if (!$this->confirm('Apakah Anda yakin ingin melanjutkan?')) {
                $this->info('Dibatalkan.');
                return self::FAILURE;
            }
        }

        // 2. Opsional: Fresh migrate
        if ($this->option('fresh')) {
            $this->step('RESET DATABASE', 0);
            $this->call('migrate:fresh', ['--force' => true]);
        }

        // 3. Step 1: Seed Laravolt (harus pertama karena user profile butuh ID wilayah)
        $this->step('SEEDING WILAYAH (LARAVOLT)', 1);
        $this->call('laravolt:indonesia:seed');

        // 4. Step 2: Import Users + Profiles
        $this->step('IMPORT USERS & PROFILES', 2);
        $this->call('import:legacy-users');

        // 5. Step 3: Import Jobs (Lowongan)
        $this->step('IMPORT JOBS (LOWONGAN)', 3);
        $this->call('import:legacy-jobs');

        // 6. Step 4: Import Profile Details (Education, Experience, Family, etc)
        $this->step('IMPORT PROFILE DETAILS', 4);
        $this->call('import:legacy-profile-data');

        // 7. Step 5: Import Applications, Documents, Interview Notes
        $this->step('IMPORT APPLICATIONS, DOCUMENTS & NOTES', 5);
        $this->call('import:legacy-applications');

        // 8. Summary
        $duration = round(microtime(true) - $startTime, 2);
        $this->newLine();
        $this->info("=========================================================");
        $this->info("✅ SEMUA DATA LEGACY BERHASIL DIIMPOR!");
        $this->info("⏱️  Total waktu: {$duration} detik");
        $this->info("=========================================================");

        return self::SUCCESS;
    }

    /**
     * Helper untuk mencetak header setiap step
     */
    private function step(string $title, int $number)
    {
        $this->newLine(2);
        $this->line("╔═══════════════════════════════════════════════════════╗");
        $this->line("║ STEP {$number}: {$title}");
        $this->line("╚═══════════════════════════════════════════════════════╝");
    }
}
