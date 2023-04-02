<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CodeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/deta");
        $response= Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php");
        $param = [
            'title' => 'Data Pegawai',
            'navbar' => 'pegawai',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
            // $collection2 = $response2->collect();
            $param += [
                'datas' => $collection['data'],
                // 'pegawais' => $collection2['data'],
            ];
            return \view('codelogin', $param);
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
        //
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
        $response = Http::put("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php", $request);
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
        $response = Http::delete("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php", ['id' => $id]);
        if ($response->successful()) {
            return $response;
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }
}
