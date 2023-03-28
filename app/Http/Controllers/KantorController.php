<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php");
        
        $param = [
            'title' => 'Data Kantor',
            'navbar' => 'kantor',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
            $param += [
                'datas' => $collection['data'],
            ];
            return \view('kantor', $param);
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
        $response = Http::asForm()->post('http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php', [
            'nama' => $request['nama'],
            'alamat' => $request['alamat'],
        ]);
        // $response = Http::asForm()->post('http://127.0.0.1:8888/e-learning/api/presensi.php', $request);
        
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
        $response = Http::put("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php", $request);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://127.0.0.1:8888/api-presensi/api-presensi/api/kantor.php", ['id' => $id]);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }
}
