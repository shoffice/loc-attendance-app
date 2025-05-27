<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi',$hariini)->first();

        $user = Auth::guard('karyawan')->user(); // Mengambil data pengguna yang sedang login

        $presensiRecords = DB::table('presensi')
        ->where('nik', $nik)
        ->get();

        return view('dashboard.dashboard', compact('presensihariini', 'user', 'presensiRecords'));
    }
}
