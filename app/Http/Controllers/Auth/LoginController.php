<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.sign-in');
    }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'username' => 'required',
                'password' => 'required|min:6',
            ]);

            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {

                return redirect()->intended('/master/dashboard')->with('success', 'Login berhasil!');

            } else {
                return redirect()->route("login")->with("error", "Gagal Login");
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
