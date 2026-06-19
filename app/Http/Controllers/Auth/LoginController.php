<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // proses login
        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            // redirect sesuai role (kalau kamu punya role)
            return match ($user->role) {
                'admin' => redirect('/admin/dashboard'),
                'ceo' => redirect('/ceo/dashboard'),
                'kasir' => redirect('/kasir/dashboard'),
                'resepsionis' => redirect('/resepsionis/dashboard'),
                default => redirect('/dashboard'),
            };
        }

        // kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}