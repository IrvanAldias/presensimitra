<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    //
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();

        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request)
    {
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;
        $update = DB::table('konfigurasi_lokasi')->where('id',1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ]);

        if($update){
            return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal diperbarui']);
        }
    }

    public function jamkerja()
    {
        $jam_kerja = DB::table('konfigurasi_jam')->orderBy('kode_jam_kerja')->get();
        return view('konfigurasi.jamkerja', compact('jam_kerja'));
    }

    public function storejamkerja(Request $request)
    {
        $kode_jam_kerja = $request->kode_jam_kerja;
        $nama_jam_kerja = $request->nama_jam_kerja;
        $awal_jam_masuk = $request->awal_jam_masuk;
        $jam_masuk = $request->jam_masuk;
        $akhir_jam_masuk = $request->akhir_jam_masuk;
        $jam_pulang = $request->jam_pulang;
        $data = [
            'kode_jam_kerja' => $kode_jam_kerja,
            'nama_jam_kerja' => $nama_jam_kerja,
            'awal_jam_masuk' => $awal_jam_masuk,
            'jam_masuk' => $jam_masuk,
            'akhir_jam_masuk' => $akhir_jam_masuk,
            'jam_pulang' => $jam_pulang,
        ];
        try {
            DB::table('konfigurasi_jam')->insert($data);
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['error'=>'Data gagal disimpan']);
        }
    }
}
