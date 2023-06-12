<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/detail_izin.php?id_izin=3");
        $response2 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php");
        $response3 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php")->collect();

        $param = [
            'title' => 'Data Izin Pulang Lebih Awal',
            'navbar' => 'perizinan',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
            $collection2 = $response2->collect();
            $param += [
                'datas' => $collection['data'],
                'pegawais' => $collection2['data'],
                'kantors' => $response3['data'],
            ];
            return \view('perizinan.surattugas', $param);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::get("http://rutan.tech/temp_ot_progresearch/api/pegawai.php?nik=".$request['nik']);
        $collection = $response->collect();
        $response2 = Http::asForm()->post('http://127.0.0.1:8888/api-presensi/api-presensi/api/detail_izin.php', [
            'nik_pegawai' => $request['nik'],
            'nik_atasan' => $collection['data']['nik_atasan'],
            'tanggal_awal' => $request['tanggal_awal'],
            'tanggal_akhir' => $request['tanggal_akhir'],
            'uraian_tugas' => $request['uraian_tugas'],
            'tempat_tujuan' => $request['tempat_tujuan'],
            'tanggal_pengajuan' => $request['tanggal_pengajuan'],
        ]);
        if ($response2->successful()) {
            return $response2;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://127.0.0.1:8888/api-presensi/api-presensi/api/detail_izin.php", ['id' => $id]);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }
}
