<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BeaconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/beacon.php");
        $response2 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php");
        $response3 = Http::get("https://www.uuidgenerator.net/api/version4");
        $param = [
            'title' => 'Data Beacon',
            'navbar' => 'beacon',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
            $collection2 = $response2->collect();
            $param += [
                'datas' => $collection['data'],
                'kantors' => $collection2['data'],
                'uuid' => $response3
            ];
            return \view('beacon', $param);
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
        $response = Http::asForm()->post('http://127.0.0.1:8888/api-presensi/api-presensi/api/beacon.php', [
            'id_kantor' => $request['id_kantor'],
            'nama' => $request['nama'],
            'uuid' => $request['uuid'],
            'lokasi' => $request['lokasi'],
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
        $response = Http::delete("http://127.0.0.1:8888/api-presensi/api-presensi/api/beacon.php", ['id' => $id]);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }
}
