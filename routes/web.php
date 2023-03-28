<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KantorController;
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

Route::get('/home', [HomeController::class, "index"]);

Route::resource('presensi', AbsensiController::class);

Route::resource('kantor', KantorController::class);