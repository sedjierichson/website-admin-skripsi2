@extends('layouts.main')

@section('included-css')
<style>
    .card{
        padding: 50px;
    }
</style>
@endsection

@section('container')
<section class="p-5">
    <div class="container">
        <div class="row text-center g-3 justify-content-center">
            <div class="col-md-4">
                <a href="presensi" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #DDFFBB">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/calendar.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4" style="color: black; font-weight:bold">PRESENSI</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="beacon" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #C7E9B0">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/bluetooth.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4" style="color: black; font-weight:bold">BEACON</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="perizinan" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #B3C99C">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/form.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4" style="color: black; font-weight:bold">DAFTAR IZIN</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="kantor" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #9DC08B">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/office-building.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">KANTOR</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="codelogin" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #609966">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/user.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">PEGAWAI</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="jamkerja" class="text-decoration-none">
                    <div class="card text-light h-100" style="background-color: #40513B">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/clock.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">JAM KERJA</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection