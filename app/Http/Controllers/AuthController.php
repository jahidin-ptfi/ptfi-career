<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // dd($bcrypt = Hash::make('Fukuryo2023'));
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'login' => ['required', 'string'], // Menampung username ATAU email
            'password' => ['required', 'string'],
        ]);

        // 2. Deteksi apakah input berupa Email atau Username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        // 3. Proses Autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Cek status aktif
            if (!Auth::user()->is_active) {
                Auth::logout();
                return response()->json([
                    'message' => 'Akun Anda belum aktif atau telah dinonaktifkan.'
                ], 403);
            }

            $request->session()->regenerate();

            // Tentukan URL redirect berdasarkan role
            $redirectUrl = Auth::user()->role === 'admin'
                ? route('admin.dashboard')
                : route('home');

            // Kembalikan respon JSON sukses
            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl
            ]);
        }

        // Jika gagal, kembalikan respon JSON error (422 Unprocessable Entity)
        return response()->json([
            'message' => 'Kredensial yang Anda masukkan salah.'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Jika request dari AJAX (Alpine fetch), kembalikan JSON
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('home') // Arahkan kembali ke home
            ]);
        }

        return redirect('/');
    }
}
