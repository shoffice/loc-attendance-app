<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function create(){
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();

        $presensiToday = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->first();
        return view('presensi.create', compact('cek', 'presensiToday'));
    }

    public function store(Request $request){
        $email = Auth::guard('karyawan')->user()->email;
        $jam = date("H:i:s");
        //rumah
        // $latitudekantor = -3.3346461573206883;
        // $longitudekantor = 114.57035545767184;
        //poliban
        $latitudekantor = -3.295591456650143;
        $longitudekantor = 114.58193773680566;
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);


        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        if ($radius > 100){
            echo "error|Maaf, Anda berada sekitar ".$radius." meter di luar radius kantor!|";
        }else{
            if ($cek > 0){
                $data_pulang = [
                    'jam_out' => $jam,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update){
                    echo "success|Terima Kasih! Hati-hati di jalan|out";
                }else{
                    echo "error|Maaf, Anda gagal presensi|out";
                }
            }else{
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan){
                    echo "success|Sukses! Selamat bekerja!|in";
                }else{
                    echo "error|Maaf, Anda gagal presensi|in";
                }
            }
        }
    }

       //Menghitung Jarak
       function distance($lat1, $lon1, $lat2, $lon2){
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
       }
}
