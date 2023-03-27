<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $param = [
            'title' => 'Beranda',
            'navbar' => 'beranda'
        ];
        return view('home', $param);
    }
}
