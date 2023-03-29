@extends('layouts.main')

@php
$lastIterationNumber = 0;
@endphp

@section('included-css')
    <style>
        #head{
            background-color: #363636;
            color: #ffffff;
        }
    </style>
@endsection

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data Presensi Karyawan</h3>
        <a class="btn" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133" >Tambah data presensi</a>
    </div>
    <div class="table-responsive col-xl justify-content-center mb-5">
        <table class="table table-bordered text-center">
            <thead id="head">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="memberKategori">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @php
                            $lastIterationNumber = $loop->iteration;
                        @endphp
                        <td>{{ $data['tanggal'] }}</td>
                        <td>{{ $data['nik'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['lokasi'] }}</td>
                        <td>{{ $data['jam_masuk'] }}</td>
                        <td>{{ $data['jam_keluar'] }}</td>
                        <td><img src="{{ $data['foto'] }}" width="120"></td>
                        <td>
                            <a href="#" data-name="{{ $data['nik'] }}" data-id="{{ $data['id'] }}"
                                class="btn btn-warning edit">Edit</a>
                            <a href="#" data-name="{{ $data['nik'] }}" data-id="{{ $data['id'] }}"
                                class="btn btn-danger delete">Hapus</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('other')
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah kategori baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertDataAbsen">
                    <div class="mb-3">
                        <label for="tanggal_presensi">Tanggal Presensi</label>
                        <input type="date" name="tanggal_presensi" id="tanggal_presensi" class="form-control" placeholder="Masukkan tanggal presensi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik_karyawan">NIK Karyawan</label>
                        <select class="form-select" id="nik">
                            <option selected>Pilih Karyawan</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai['nik'] }}">{{ $pegawai['nik'] }} - {{ $pegawai['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_kantor">Lokasi Kantor</label>
                        <select class="form-select" id="id_kantor">
                            <option selected>Pilih Kantor</option>
                            @foreach ($kantors as $kantor)
                                <option value="{{ $kantor['id'] }}">{{ $kantor['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jam_masuk">Jam Masuk</label>
                        <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" placeholder="Masukkan jam masuk" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_keluar">Jam Keluar</label>
                        <input type="time" name="jam_keluar" id="jam_keluar" class="form-control" placeholder="Masukkan jam keluar" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="foto">Foto</label>  
                        <input type="text" name="foto" id="foto" class="form-control" placeholder="Masukkan foto" required>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('included-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.delete', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('name');
                Swal.fire({
                    title: 'Hapus Data Presensi',
                    text: "Apakah anda yakin ingin data presensi ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "Batal",
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: "/presensi/" + id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status == 1) {
                                    event.target.parentElement.parentElement.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Data berhasil dihapus',
                                        'success'
                                    );
                                } else {
                                    alert("Error: " + response.message);
                                }
                            },
                            error: function(request, status, error) {
                                alert("Not Ok");

                            }
                        });
                    }
                });
            });

            $('#insertDataAbsen').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();
                // console.log(form);
                // var url = $(this).attr('action');
                let tanggal = $('#tanggal_presensi').val();
                let nik = $('#nik').val();
                let id_kantor = $('#id_kantor').val();
                let jam_masuk = $('#jam_masuk').val();
                let jam_keluar = $('#jam_keluar').val();
                // let img_name = $('#foto').val();
                console.log(tanggal);
                console.log(nik);
                console.log(id_kantor);
                console.log(jam_masuk);
                console.log(jam_keluar);
                if (tanggal != "" && nik != "" && id_kantor != "" && jam_masuk != "" && jam_keluar != ""){
                    $.ajax({
                        method: 'POST',
                        url: "/presensi",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            tangal: tanggal,
                            nik: nik,
                            id_kantor: id_kantor,
                            jam_masuk: jam_masuk,
                            jam_keluar: jam_keluar,
                        },
                        // data: form,
                        // dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            data = JSON.parse(response);
                            console.log(data);
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil tambah data presensi',
                                    text: "Data presensi ditambahkan",
                                }).then(function() {
                                    location.href = "/presensi";        
                                });
                                // showList($('table tr').length, response.message, $('#nama_kategori').val());
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal tambah data absen',
                                    text: data.message,
                                });
                            }
                            // $('#tambahKategoriModal').modal('hide');
                            // $('#insertKategori')[0].reset();
                        },
                        error: function(request, status, error) {
                            console.log(error);
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Gagal tambah kategori',
                            //     text: data.message,
                            // });

                        }
                    });
            }
            });
        });
    </script>
@endsection