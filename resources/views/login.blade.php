@extends('layouts.html_structure')

@section('included-css')
    <style media="screen">
        body {
            background: linear-gradient(117deg, rgba(2, 0, 36, 1) 0%, rgba(19, 84, 45, 1) 62%);
            background-size: cover;
            background-attachment: fixed;
            ;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .card {
            overflow: hidden;
            border: 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);

        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-input {
            position: relative;
        }

        .btn-login {
            width: 60%;
            cursor: pointer;
            border-radius: 10px;
            font-weight: bold;
            background: #13542D;
            display: block;
            padding: 10px;
        }
    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-5 col-xl-4 card flex-row mx-auto px-0">
                <div class="img-left d-none d-md-flex">
                </div>
                <div class="card-body py-5 px-0">
                    <img src="{{ url('/img/attendance.png') }}" class="mx-auto d-block" width="150" alt="">
                    <h4 class="text-center my-3 mb-4 fw-bold">PRESENSI PT X</h4>
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="/login" enctype="multipart/form-data" method="post" class="form-box px-5" id='loginForm'>
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label fw-bold">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                id="nik" required value="{{ old('nik') }}" placeholder="Masukkan NIK">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password" required
                                value="{{ old('password') }}" placeholder="Masukkan password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center mb-5">

                            <button type="submit" class="btn btn-primary text-uppercase btn-login mt-3">Login</button>
                        </div>
                        <small class="d-block text-center">Hanya untuk admin</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('included-js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#loginForm").on('submit', function(e) {
                var data = new FormData(this);
                e.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: "/login",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#btn-login").prop("disabled", true);
                    },
                    success: function(response) {
                        console.log(response);
                        let data = JSON.parse(response);
                        // console.log(data);
                        if (data.status == 1) {
                            location.href = "/home";
                        } else if (data.status == 2) {
                            Swal.fire({
                                title: 'Error',
                                text: "Anda tidak mempunyai hak akses sebagai admin",
                                icon: 'error'
                            });
                        } else {
                            console.log(data.message);
                            Swal.fire({
                                title: 'Kata sandi atau password salah !',
                                text: "Silahkan coba lagi",
                                icon: 'error'
                            });
                        }
                    },
                    error: function(request, status, error) {
                        console.log(error);
                        // showErrorAlert(error);
                        // $("#btnSubmit").prop("disabled", false);
                    }
                });
            });
        });
    </script>
@endsection
