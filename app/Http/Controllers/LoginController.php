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
        // return $request['nik'];
        $response = Http::asForm()->post("http://127.0.0.1:8888/contoh-api-rutan/contoh-api-rutan/api/pegawai.php", [
            "nik" => $request['nik'],
            "password" => $request['password']
        ]);
        // // $response = Http::asForm()->post('http://127.0.0.1:8888/contoh-api-rutan/contoh-api-rutan/api/pegawai.php', $request);

        if ($response->successful()) {
            // $data = $request->input();
            $request->session()->put('user', $request['nik']);
            return $response;
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
