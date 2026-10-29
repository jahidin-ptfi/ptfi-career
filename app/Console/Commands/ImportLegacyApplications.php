<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\UserDocument;
use App\Models\JobInterviewNote;
use Carbon\Carbon;

class ImportLegacyApplications extends Command
{
    protected $signature = 'import:legacy-applications';
    protected $description = 'Import lamaran, dokumen, dan interview notes dari CI3 (Mode Turbo)';

    public function handle()
    {
        $startTime = microtime(true);
        $now = Carbon::now();

        $userMap = User::pluck('id', 'username')->toArray();
        $jobMap = JobListing::pluck('id', 'id')->toArray();

        // 🚀 TURBO MODE: Matikan pengecekan Foreign Key sementara
        Schema::disableForeignKeyConstraints();

        // ==========================================
        // 1. IMPORT LAMARAN
        // ==========================================
        $this->info('Memproses data Lamaran...');
        $legacyApps = DB::connection('legacy')->table('loker_pelamar')->get();

        // Ambil data lamaran yang sudah ada di DB untuk mencegah duplikasi
        $existingApps = JobApplication::select('user_id', 'job_listing_id')->get();
        $existingAppSet = [];
        foreach ($existingApps as $ea) {
            $existingAppSet[$ea->user_id . '-' . $ea->job_listing_id] = true;
        }

        $appData = [];
        foreach ($legacyApps as $app) {
            if (isset($userMap[$app->username]) && isset($jobMap[$app->loker_id])) {
                $userId = $userMap[$app->username];
                $jobId = $jobMap[$app->loker_id];
                $key = $userId . '-' . $jobId;

                if (!isset($existingAppSet[$key])) {
                    $appData[] = [
                        'user_id' => $userId,
                        'job_listing_id' => $jobId,
                        'status' => $app->status_lamaran ?? 'applied',
                        'keterangan' => $app->keterangan,
                        'is_active' => $app->is_active == 1,
                        'applied_at' => $app->applied_at,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $existingAppSet[$key] = true; // Cegah duplikat di data legacy
                }
            }
        }

        // Bulk Insert per 1000 baris
        foreach (array_chunk($appData, 1000) as $chunk) {
            DB::table('job_applications')->insert($chunk);
        }
        $this->info(" -> " . count($appData) . " lamaran berhasil masuk.");


        // ==========================================
        // 2. IMPORT DOKUMEN
        // ==========================================
        $this->info('Memproses data Dokumen...');
        $legacyDocs = DB::connection('legacy')->table('p_dokumen')->get();

        $existingDocs = UserDocument::select('user_id', 'file_path')->get();
        $existingDocSet = [];
        foreach ($existingDocs as $ed) {
            $existingDocSet[$ed->user_id . '-' . $ed->file_path] = true;
        }

        $docData = [];
        foreach ($legacyDocs as $doc) {
            if (isset($userMap[$doc->username])) {
                $userId = $userMap[$doc->username];
                $filePath = 'legacy_docs/' . $doc->file;
                $key = $userId . '-' . $filePath;

                if (!isset($existingDocSet[$key])) {
                    $docData[] = [
                        'user_id' => $userId,
                        'nama' => $doc->nama,
                        'file_path' => $filePath,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $existingDocSet[$key] = true;
                }
            }
        }
        foreach (array_chunk($docData, 1000) as $chunk) {
            DB::table('user_documents')->insert($chunk);
        }
        $this->info(" -> " . count($docData) . " dokumen berhasil masuk.");


        // ==========================================
        // 3. IMPORT INTERVIEW NOTES (ASUMSI LOGIKA)
        // ==========================================
        $this->info('Memproses Catatan Wawancara...');
        $legacyNotes = DB::connection('legacy')->table('p_interview_notes')->get();

        // Cari ID Lamaran terbaik untuk setiap user (prioritas: status interview, lalu terbaru)
        $apps = DB::table('job_applications')
            ->select('id', 'user_id')
            ->orderByRaw("FIELD(status, 'interview') DESC")
            ->orderBy('applied_at', 'desc')
            ->get();

        $bestApplication = [];
        foreach ($apps as $app) {
            if (!isset($bestApplication[$app->user_id])) {
                $bestApplication[$app->user_id] = $app->id;
            }
        }

        $existingNotes = JobInterviewNote::select('job_application_id', 'note')->get();
        $existingNoteSet = [];
        foreach ($existingNotes as $en) {
            // Gunakan md5(note) untuk pencocokan string panjang
            $existingNoteSet[$en->job_application_id . '-' . md5($en->note)] = true;
        }

        $noteData = [];
        foreach ($legacyNotes as $note) {
            if (isset($userMap[$note->username]) && !empty($note->notes)) {
                $userId = $userMap[$note->username];

                if (isset($bestApplication[$userId])) {
                    $appId = $bestApplication[$userId];
                    $key = $appId . '-' . md5($note->notes);

                    if (!isset($existingNoteSet[$key])) {
                        $noteData[] = [
                            'job_application_id' => $appId,
                            'interviewer_name' => $note->updated_by ?? 'Admin Lama',
                            'note' => $note->notes,
                            'created_at' => $note->updated_at ?? $now,
                            'updated_at' => $note->updated_at ?? $now,
                        ];
                        $existingNoteSet[$key] = true;
                    }
                }
            }
        }
        foreach (array_chunk($noteData, 1000) as $chunk) {
            DB::table('job_interview_notes')->insert($chunk);
        }
        $this->info(" -> " . count($noteData) . " catatan wawancara berhasil masuk.");

        // 🚀 Nyalakan kembali Foreign Key
        Schema::enableForeignKeyConstraints();

        $duration = round(microtime(true) - $startTime, 2);
        $this->info("🎉 Selesai! Semua data lamaran, dokumen, dan catatan berhasil diimpor dalam {$duration} detik.");
    }
}
