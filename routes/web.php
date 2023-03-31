<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\BeaconController;
use App\Http\Controllers\PulangAwalController;
use App\Http\Controllers\MeninggalkanKantorController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\TidakPresensiController;
use App\Http\Controllers\CodeLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [LoginController::class, "index"])->name('login');
Route::post('/login', [LoginController::class, 'loginAkun']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware('session.has.user')->group(function () {
    
    Route::get('/home', [HomeController::class, "index"]);
    
    Route::resource('presensi', AbsensiController::class);
    
    Route::resource('kantor', KantorController::class);
    Route::resource('beacon', BeaconController::class);
    
    Route::resource('perizinan/pulangawal', PulangAwalController::class);
    Route::resource('perizinan/meninggalkanlokasikerja', MeninggalkanKantorController::class);
    Route::resource('perizinan/surattugas', SuratTugasController::class);
    Route::resource('perizinan/tidakpresensi', TidakPresensiController::class);
    Route::resource('codelogin', CodeLoginController::class);
    
    Route::get('/perizinan', function(){
        return view('perizinan.tipeizin', [
            'title' => 'Menu Izin',
                'navbar' => 'perizinan',
        ]);
    });
});
