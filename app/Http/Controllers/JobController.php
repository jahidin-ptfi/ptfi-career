<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\User; // 👈 Tambahkan import User
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('is_active', true)->orderBy('posted_at', 'desc')->get();
        return view('public.home', compact('jobs'));
    }

    public function apply($id)
    {
        //
        $user = User::find(Auth::id());
        $job = JobListing::findOrFail($id);

        // 1. Cek apakah lowongan masih aktif
        if (!$job->is_active) {
            return response()->json(['error' => 'Maaf, lowongan ini sudah tidak aktif.'], 400);
        }

        // 2. Cek Kelengkapan Profil (Nama, Pendidikan minimal 1, Pengalaman minimal 1)
        if (!$user->profile || empty($user->profile->nama)) {
            return response()->json(['error' => 'Silakan lengkapi nama profil Anda terlebih dahulu.'], 400);
        }

        if ($user->educations()->count() == 0) {
            return response()->json(['error' => 'Silakan tambahkan minimal 1 riwayat pendidikan di profil Anda.'], 400);
        }

        if ($user->experiences()->count() == 0) {
            return response()->json(['error' => 'Silakan tambahkan minimal 1 pengalaman kerja di profil Anda.'], 400);
        }

        // 3. Cek Duplikasi Lamaran (Hanya untuk lamaran yang is_active = 1)
        $exists = JobApplication::where('user_id', $user->id)
            ->where('job_listing_id', $job->id)
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Anda sudah melamar posisi ini dan lamaran Anda masih diproses.'], 400);
        }

        // 4. Simpan Lamaran
        JobApplication::create([
            'user_id' => $user->id,
            'job_listing_id' => $job->id,
            'status' => 'applied',
            'is_active' => true,
            'applied_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Lamaran Anda berhasil dikirim!']);
    }
}
