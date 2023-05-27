<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php?is_history=0");
        $response2 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php");
        $response3 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php");
        $response4 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php?is_history=1");
        $param = [
            'title' => 'Data Absensi',
            'navbar' => 'absensi',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
            $collection2 = $response2->collect();
            $collection3 = $response3->collect();
            $collection4 = $response4->collect();
            $param += [
                'datas' => $collection['data'],
                'pegawais' => $collection2['data'],
                'kantors' => $collection3['data'],
                'historyHarians' => $collection4['data']
            ];
            return \view('absensi', $param);
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
        $response = Http::asForm()->post('http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php', [
            'nik' => $request['nik'],
            'id_kantor' => $request['id_kantor'],
            'tanggal' => $request['tanggal'],
            'jam_masuk' => $request['jam_masuk'],
            'image' => 'admin',
            'img_name' => 'adminawd',
        ]);
        
        if ($response->successful()) {
            return $response;
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
        $response = Http::delete("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php", ['id' => $id]);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }

    public function showHistoryKeluarMasukFilter(string $nik=null, string $tanggal=null)
    {
        // $response4 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php?is_history=1")->collect();
        $response4 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php?nik_history=$nik&tanggal_history=$tanggal")->collect();
        $pegawai = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php?")->collect();
        $param = [
            'title' => 'Data Keluar Masuk',
            'navbar' => 'absensi',
            'nik' => $nik,
            'listNIK' => $pegawai['data'],
            'tanggal' => $tanggal,
            'historyHarians' => $response4['data'],
        ];
        return \view('tableHistoryFilter', $param);
    }

    public function showHistoryKeluarMasuk(string $nik=null, string $tanggal=null)
    {
        $response4 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/presensi.php?is_history=1")->collect();
        $pegawai = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php?")->collect();
        $param = [
            'title' => 'Data Keluar Masuk',
            'navbar' => 'absensi',
            'nik' => $nik,
            'listNIK' => $pegawai['data'],
            'tanggal' => $tanggal,
            'historyHarians' => $response4['data']
        ];
        return \view('tableHistoryFilter', $param);
    }
}
