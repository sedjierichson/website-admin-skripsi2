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
@endsection

@section('container')
<section class="p-5">
    <div class="container">
        <div class="row text-center g-3 justify-content-center">
            {{-- <p>{{ session('user') }}</p> --}}
            <div class="col-md-4">
                <a href="absensi" class="text-decoration-none">
                    <div class="card bg-success text-light h-100">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/calendar.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">Data Absensi</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="beacon" class="text-decoration-none">
                    <div class="card bg-warning text-light h-100">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/bluetooth.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">Beacon</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="perizinan" class="text-decoration-none">
                    <div class="card bg-info text-light h-100">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/form.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">Data Perizinan</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="kantor" class="text-decoration-none">
                    <div class="card bg-dark text-light h-100">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/office-building.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">Data Kantor</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="codelogin" class="text-decoration-none">
                    <div class="card bg-danger text-light h-100">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/lock.png') }}" class="mx-auto d-block" width="100" alt="">
                            <h3 class="mt-4">Security Code Login</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection