<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\DB;

// --- Route Publik ---
Route::get('/', [JobController::class, 'index'])->name('home');
Route::get('/about', fn() => 'Halaman Tentang Kami')->name('about');
Route::get('/pricing', fn() => 'Halaman Pasang Lowongan')->name('pricing');
Route::get('/contact', fn() => 'Halaman Hubungi Kami')->name('contact');
Route::get('/admin/examples/form-elements', fn() => 'Halaman Design System')->name('admin.examples.form');
Route::get('/careers/jobs/{id}', fn($id) => 'Halaman Detail Loker ID: ' . $id)->name('jobs.show');
// Proses Kirim Lamaran
Route::post('/careers/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply');

// --- Route Auth (Guest) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', fn() => 'Halaman Lupa Password')->name('password.request');
});

// --- Route Kandidat (Wajib Login) ---
Route::middleware('auth')->group(function () {

    // Profil Utama
    Route::get('/profile', [ProfileController::class, 'index'])->name('candidate.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('candidate.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('candidate.profile.update');

    // CRUD Pendidikan
    Route::post('/profile/education', [ProfileController::class, 'storeEducation'])->name('profile.education.store');
    Route::put('/profile/education/{id}', [ProfileController::class, 'updateEducation'])->name('profile.education.update');
    Route::delete('/profile/education/{id}', [ProfileController::class, 'destroyEducation'])->name('profile.education.destroy');

    // CRUD Pengalaman Kerja
    Route::post('/profile/experience', [ProfileController::class, 'storeExperience'])->name('profile.experience.store');
    Route::put('/profile/experience/{id}', [ProfileController::class, 'updateExperience'])->name('profile.experience.update');
    Route::delete('/profile/experience/{id}', [ProfileController::class, 'destroyExperience'])->name('profile.experience.destroy');

    // CRUD Kursus
    Route::post('/profile/course', [ProfileController::class, 'storeCourse'])->name('profile.course.store');
    Route::put('/profile/course/{id}', [ProfileController::class, 'updateCourse'])->name('profile.course.update');
    Route::delete('/profile/course/{id}', [ProfileController::class, 'destroyCourse'])->name('profile.course.destroy');

    // CRUD Kontak Darurat
    Route::post('/profile/contact', [ProfileController::class, 'storeContact'])->name('profile.contact.store');
    Route::put('/profile/contact/{id}', [ProfileController::class, 'updateContact'])->name('profile.contact.update');
    Route::delete('/profile/contact/{id}', [ProfileController::class, 'destroyContact'])->name('profile.contact.destroy');

    // CRUD Keluarga
    Route::post('/profile/family', [ProfileController::class, 'storeFamily'])->name('profile.family.store');
    Route::put('/profile/family/{id}', [ProfileController::class, 'updateFamily'])->name('profile.family.update');
    Route::delete('/profile/family/{id}', [ProfileController::class, 'destroyFamily'])->name('profile.family.destroy');

    // Route Dokumen
    Route::post('/profile/document', [ProfileController::class, 'storeDocument'])->name('profile.document.store');
    Route::delete('/profile/document/{id}', [ProfileController::class, 'destroyDocument'])->name('profile.document.destroy');

    // CRUD Keahlian (Skill)
    Route::post('/profile/skill', [ProfileController::class, 'storeSkill'])->name('profile.skill.store');
    Route::delete('/profile/skill/{id}', [ProfileController::class, 'destroySkill'])->name('profile.skill.destroy');

    // Placeholder Lamaran & Logout
    Route::get('/profile/applications', [ApplicationController::class, 'index'])->name('candidate.applications');
    Route::get('/admin', fn() => 'Halaman Dashboard Admin')->name('admin.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // API Wilayah
    Route::get('/api/wilayah', function (Request $request) {
        $level = $request->query('level');
        $parent = $request->query('parent');

        try {
            if ($level === 'provinsi') {
                $data = DB::table('indonesia_provinces')
                    ->select('code as kode', 'name as nama')
                    ->orderBy('name')->get();
            } elseif ($level === 'kota') {
                $data = DB::table('indonesia_cities')
                    ->where('province_code', $parent)
                    ->select('code as kode', 'name as nama')
                    ->orderBy('name')->get();
            } elseif ($level === 'kecamatan') {
                $data = DB::table('indonesia_districts')
                    ->where('city_code', $parent)
                    ->select('code as kode', 'name as nama')
                    ->orderBy('name')->get();
            } elseif ($level === 'kelurahan') {
                $data = DB::table('indonesia_villages')
                    ->where('district_code', $parent)
                    ->select('code as kode', 'name as nama')
                    ->orderBy('name')->get();
            } else {
                $data = [];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            // Jika ada error, kembalikan array kosong agar Alpine tidak crash
            return response()->json([]);
        }
    })->name('api.wilayah');
});
