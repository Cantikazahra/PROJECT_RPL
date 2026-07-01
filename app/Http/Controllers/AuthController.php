<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function loginProcess(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email belum terdaftar.',
            ])->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                Auth::logout(); 
                return back()->withErrors([
                    'email' => 'Halaman ini khusus untuk pemohon. Admin silakan login di halaman admin.',
                ]);
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function registerProcess(Request $request) {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nik'      => 'required|string|min:16|max:16|unique:users,nik',
            'alamat'   => 'required|string',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'nama.max'          => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'nik.required'      => 'NIK wajib diisi.',
            'nik.max'           => 'NIK tidak boleh lebih dari 16 karakter.',
            'nik.min'           => 'NIK harus berjumlah pas 16 karakter.',
            'nik.unique'        => 'NIK ini sudah terdaftar di sistem.',
            'alamat.required'   => 'Alamat wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email yang Anda masukkan tidak valid.',
            'email.unique'      => 'Email ini sudah digunakan oleh akun lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus terdiri dari 6 karakter.',
        ]);

        User::create([
            'nama'     => $request->nama,
            'nik'      => $request->nik,
            'alamat'   => $request->alamat,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', 
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function loginGoogleMock(Request $request) {
        $user = User::where('role', 'user')->first();

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('user.dashboard')->with('success', 'Berhasil masuk dengan Google!');
        }

        return back()->withErrors([
            'email' => 'Belum ada akun di database. Silakan buat satu akun lewat formulir Daftar dulu!',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}