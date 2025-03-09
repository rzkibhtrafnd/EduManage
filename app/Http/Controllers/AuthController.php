<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session untuk keamanan
            $user = Auth::user();
            //dd($user);

            // Redirect berdasarkan role
            switch ($user->role) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('guru.dashboard');
                case 3:
                    return redirect()->route('murid.dashboard');
                case 4:
                    return redirect()->route('orangtua.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak valid');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return redirect()->route('login');
    }
}
