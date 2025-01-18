<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.sign-in'); // View untuk form login
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        // Coba autentikasi
        if (Auth::attempt($request->only('username', 'password'))) {
            // Redirect ke halaman setelah login
            return redirect()->intended('/master/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error','Email atau password salah.');
    }
}
