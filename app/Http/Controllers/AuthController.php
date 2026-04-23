<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    //
    // Menampilkan halaman login yang sudah dibuat di resources/views/auth/login.blade.php
    public function getLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register yang sudah dibuat di resources/views/auth/register.blade.php
    public function getRegister()
    {
        return view('auth.register');
    }

    // 
    public function postLogin(Request $request)
    {
        $rule_validasi = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        $pesan_validasi = [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter'
        ];

        $request->validate($rule_validasi, $pesan_validasi);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    public function postRegister(Request $request)
    {
        $rule_validasi =[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $pesan_validasi = [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ];

        $request->validate($rule_validasi, $pesan_validasi);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun yang sudah dibuat.');
    }

    public function postLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
