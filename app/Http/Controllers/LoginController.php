<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'emaillogin' => ['required', 'email'],
            'passwordlogin' => ['required'],
        ], [
            'emaillogin.required' => 'Email field is required',
            'emaillogin.email' => 'Please enter a valid email address',
            'passwordlogin.required' => 'Password field is required',
        ]);

        try {
            if (Auth::guard('web')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {
                $user = Auth::user();
                $request->session()->regenerate();
                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            Log::error('Exception during login:', ['message' => $e->getMessage()]);
        }

        return back()->with('loginError', 'Login Gagal!')->with('Email atau Password Anda Salah', 'Terjadi kesalahan. Silakan coba lagi.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
