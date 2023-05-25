<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminat\Support\Facades\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use mysqli;

class LoginController extends Controller
{
    public function index()
    {
        if(session()->has('user')){
            return redirect('home');
        }
        return view('login', [
            'title' => 'Login',
            'navbar' => 'login'
        ]);
    }
    public function loginAkun(Request $request)
    {
        $response = Http::asForm()->post("https://rutan.tech/temp_ot_progresearch/api/pegawai.php", [
            "nik" => $request['nik'],
            "password" => $request['password']
        ]);

        if ($response->successful()) {
            $response2 = Http::get("http://127.0.0.1:8888/api-presensi/api-presensi/api/pegawai.php?nik=".$request['nik'])->collect();
            if ($response2['data']['is_admin'] == 1) {
                $request->session()->put('user', $request['nik']);
                return $response;
            } else {
                return json_encode(['status' => 2, 'message' => "tidak punya akses admin"]);
            }
        } else {
            return json_encode(['status' => 0, 'message' => $this->serverErrorMsg]);
        }
    }

    public function logout(){
        if (session()->has('user')){
            session()->forget('user');
        }
        return redirect('login');
    }
}
