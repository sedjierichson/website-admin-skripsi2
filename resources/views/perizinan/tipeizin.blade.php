@extends('layouts.main')

{{-- @section('banner')
    <section id="banner">
        <div class="banner">
            <div class="container">
                <div class="row d-flex align-items-center header text-center">
                    <h1 class="text-black fw-bold mt-auto">Selamat <span style="color: #13542D">Datang</span></h1>
                    <h4 class="text-white mt-3">"Make each day your masterpiece"</h4>
                </div>
            </div>
        </div>
    </section>
@endsection --}}
@section('included-css')
<style>
    .card{
        padding: 50px;
        /* min-height: 300px !important; */
    }
</style>

@section('container')
<section class="p-3">
    <div class="container">
        <div class="row text-center g-3 justify-content-center">
            <div class="col-md-4">
                <a href="perizinan/pulangawal" class="text-decoration-none">
                    <div class="card bg-success text-light h-100" style="background-color: #EDF1D6">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/house.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h4 class="mt-4">Pulang Lebih Awal</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="perizinan/meninggalkanlokasikerja" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #9DC08B">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/exit.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h4 class="mt-4">Meninggalkan Kantor Sementara</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
            <div class="row text-center mt-1 g-3 justify-content-center">
            <div class="col-md-4">
                <a href="perizinan/surattugas" class="text-decoration-none" >
                    <div class="card text-light h-100" style="background-color: #609966">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/email.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h4 class="mt-4">Surat Tugas</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="perizinan/tidakpresensi" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #40513B">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/house.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h4 class="mt-4">Tidak Melakukan Presensi</h4>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
@endsection