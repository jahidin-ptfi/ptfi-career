<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Skill;
use App\Enums\Agama;
use App\Enums\StatusPernikahan;
use App\Enums\TingkatPendidikan;
use App\Enums\HubunganKeluarga;
use App\Enums\GolonganDarah;
use App\Models\UserDocument;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with([
            'profile',
            'educations',
            'experiences',
            'courses',
            'skills.skill',
            'emergencyContacts',
            'families',
            'documents',
            'applications.jobListing'
        ])->find(Auth::id());

        $skills = Skill::orderBy('nama')->get();
        return view('public.profile.show', compact('user', 'skills'));
    }

    public function edit()
    {
        $user = User::with('profile')->find(Auth::id());
        return view('public.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:100',
            'no_ktp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',

            'provinsi_id' => 'nullable|string|max:2',
            'kota_id' => 'nullable|string|max:5',
            'kecamatan_id' => 'nullable|string|max:8',
            'kelurahan_id' => 'nullable|string|max:13',

            'telepon' => 'nullable|string|max:20',
            'selular' => 'required|string|max:20',
            'agama' => ['nullable', Rule::enum(Agama::class)],
            'status_pernikahan' => ['nullable', Rule::enum(StatusPernikahan::class)],
            'gol_darah' => ['nullable', Rule::enum(GolonganDarah::class)],
            'facebook' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'tiktok' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ]);

        $data = $request->except(['_token', 'foto']);

        if ($request->hasFile('foto')) {
            if ($user->profile && $user->profile->foto) {
                Storage::disk('public')->delete('uploads/' . $user->profile->foto);
            }
            $file = $request->file('foto');
            $filename = $user->username . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');
            $data['foto'] = $filename;
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        $user->update(['name' => $request->nama]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'redirect' => route('candidate.profile')
        ]);
    }

    // ==========================================
    // DOKUMEN PENDUKUNG (BARU)
    // ==========================================
    public function storeDocument(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Maks 2MB
        ]);

        $user = User::find(Auth::id());
        $file = $request->file('file');

        // Simpan file dengan nama unik: username_timestamp.ext
        $filename = $user->username . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('documents', $filename, 'public');

        UserDocument::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'file_path' => 'documents/' . $filename,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroyDocument($id)
    {
        $doc = UserDocument::where('user_id', Auth::id())->findOrFail($id);

        // Hapus file fisik dari storage
        Storage::disk('public')->delete($doc->file_path);

        // Hapus data dari database
        $doc->delete();

        return response()->json(['success' => true]);
    }

    // ==========================================
    // PENDIDIKAN
    // ==========================================
    public function storeEducation(Request $request)
    {
        $validated = $request->validate([
            // 👇 Ubah validasi Tingkat
            'tingkat' => ['required', Rule::enum(TingkatPendidikan::class)],
            'nama' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'periode_awal' => 'required|integer',
            'periode_akhir' => 'required|integer',
        ]);

        User::find(Auth::id())->educations()->create($validated);
        return response()->json(['success' => true]);
    }

    public function updateEducation(Request $request, $id)
    {
        $validated = $request->validate([
            'tingkat' => ['required', Rule::enum(TingkatPendidikan::class)],
            'nama' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'periode_awal' => 'required|integer',
            'periode_akhir' => 'required|integer',
        ]);

        User::find(Auth::id())->educations()->findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroyEducation($id)
    {
        User::find(Auth::id())->educations()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ==========================================
    // PENGALAMAN KERJA
    // ==========================================
    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'perusahaan' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date',
            'gaji' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        User::find(Auth::id())->experiences()->create($validated);
        return response()->json(['success' => true]);
    }

    public function updateExperience(Request $request, $id)
    {
        $validated = $request->validate([
            'perusahaan' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date',
            'gaji' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        User::find(Auth::id())->experiences()->findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroyExperience($id)
    {
        User::find(Auth::id())->experiences()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ==========================================
    // KURSUS
    // ==========================================
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'lembaga' => 'required|string|max:100',
            'dibiayai_oleh' => 'required|string|max:100',
            'periode_awal' => 'required|integer',
            'periode_akhir' => 'required|integer',
        ]);

        User::find(Auth::id())->courses()->create($validated);
        return response()->json(['success' => true]);
    }

    public function updateCourse(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'lembaga' => 'required|string|max:100',
            'dibiayai_oleh' => 'required|string|max:100',
            'periode_awal' => 'required|integer',
            'periode_akhir' => 'required|integer',
        ]);

        User::find(Auth::id())->courses()->findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroyCourse($id)
    {
        User::find(Auth::id())->courses()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ==========================================
    // KONTAK DARURAT
    // ==========================================
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            // 👇 Ubah validasi Hubungan menjadi Enum
            'hubungan' => ['required', Rule::enum(HubunganKeluarga::class)],
            'alamat' => 'required|string|max:100',
            'kontak' => 'required|string|max:15',
        ]);

        User::find(Auth::id())->emergencyContacts()->create($validated);
        return response()->json(['success' => true]);
    }

    public function updateContact(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'hubungan' => ['required', Rule::enum(HubunganKeluarga::class)],
            'alamat' => 'required|string|max:100',
            'kontak' => 'required|string|max:15',
        ]);

        User::find(Auth::id())->emergencyContacts()->findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroyContact($id)
    {
        User::find(Auth::id())->emergencyContacts()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ==========================================
    // KELUARGA
    // ==========================================
    public function storeFamily(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|integer|in:1,2',
            'nama' => 'required|string|max:100',
            // 👇 Ubah validasi Hubungan menjadi Enum
            'hubungan' => ['required', Rule::enum(HubunganKeluarga::class)],
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
        ]);

        User::find(Auth::id())->families()->create($validated);
        return response()->json(['success' => true]);
    }

    public function updateFamily(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'hubungan' => ['required', Rule::enum(HubunganKeluarga::class)],
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
        ]);

        User::find(Auth::id())->families()->findOrFail($id)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroyFamily($id)
    {
        User::find(Auth::id())->families()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ==========================================
    // KEAHLIAN (SKILL)
    // ==========================================
    public function storeSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);

        $user = User::find(Auth::id());
        if (!$user->skills()->where('skill_id', $request->skill_id)->exists()) {
            $user->skills()->create(['skill_id' => $request->skill_id]);
        }
        return response()->json(['success' => true]);
    }

    public function destroySkill($id)
    {
        User::find(Auth::id())->skills()->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
