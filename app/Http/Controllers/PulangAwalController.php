<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PulangAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/detail_izin.php?id_izin=4");
        $response2 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php");
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
            ];
            return \view('perizinan.pulangawal', $param);
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
        return $request;
        // $response = Http::get("http://127.0.0.1:8888/contoh-api-rutan/contoh-api-rutan/api/pegawai.php?nik=".$request['nik']);
        // // return $response;
        // if ($response->successfull()){
        //     $collection = $response->collect(); 
        //     // return $collection['data']['nik_atasan'];
        //     $response2 = Http::asForm()->post('http://127.0.0.1:8888/api-presensi/api-presensi/api/detail_izin.php', [
        //         'nik_pegawai' => $request['nik'],
        //         'nik_atasan' => $collection['data']['nik_atasan'],
        //         'tanggal_izin' => $request['tanggal_izin'].toString(),
        //         'jam_izin_pulang' => $request['jam_izin_pulang'],
        //         'alasan' => $request['alasan'],
        //         'tanggal_pengajuan' => $request['tanggal_pengajuan'].toString(),
        //     ]);
        //     // return $request['tanggal_pengajuan'];
        //     if ($response2->successful()) {
        //         return $response2;
        //     } else {
        //         return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        //     }
        // }
        // else {
        //     return json_encode(['status' => 0, 'message' => "Gagal mendapat nik atasan"]);
        // }
        
        
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
        //
    }
}
