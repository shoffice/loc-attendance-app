<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
    if (Auth::guard('karyawan')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // Jika berhasil, redirect ke halaman dashboard
        return redirect()->intended('/dashboard');
    } else {
        // Jika gagal, redirect kembali dengan pesan error
        return redirect('/')->with(['warning' => 'Email atau password salah']);
    }
}

    public function proseslogout()
    {
        Auth::guard('karyawan')->logout();
        return redirect('/');
    }
}
