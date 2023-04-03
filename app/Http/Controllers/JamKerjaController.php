<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/jamkerja.php");
        $param = [
            'title' => 'Jam Kerja',
            'navbar' => 'jam kerja',
        ];
        if ($response->successful()) {
            $collection = $response->collect();
           
            $param += [
                'datas' => $collection['data'],
            ];
            return \view('jamkerja', $param);
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
        // return $request;
        $response = Http::put("http://127.0.0.1:8888/api-presensi/api-presensi/api/jamkerja.php", $request);
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
        //
    }
}
