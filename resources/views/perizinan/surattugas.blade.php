@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data Izin Surat Tugas</h3>
        <a class="btn" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133">Tambah
            Data</a>
    </div>
    <div class="row">
        <div class="col">
            <select class="form-select mb-3" id="filterNIK">
                <option id="baba" selected>Pilih NIK</option>
            </select>

        </div>
        <div class="col">
            <select class="form-select mb-3" id="filterStatus">
                <option selected>Pilih Status</option>
                <option value="Terima">Terima</option>
                <option value="Tolak">Tolak</option>
                <option value="Pending">Pending</option>
            </select>

        </div>
        <div class="col">
            <button class="btn btn-secondary" id="resetButton">Reset</button>
        </div>
    </div>
    <div class="table-responsive col-xl justify-content-center mb-5">
        <table class="table table-bordered text-center" id="listTable">
            <thead style="background-color: #363636; color:#ffffff;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIK - Nama Karyawan</th>
                    <th scope="col">NIK - Nama Atasan</th>
                    <th scope="col">Tanggal Awal</th>
                    <th scope="col">Tanggal Akhir</th>
                    <th scope="col">Tempat Tujuan</th>
                    <th scope="col">Uraian Tugas</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Tanggal Respon</th>
                    <th scope="col">Status</th>
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
                        <td>{{ $data['nik_pegawai'] }} - {{ $data['nama'] }}</td>
                        <td>{{ $data['nik_atasan'] }}</td>
                        <td>{{ $data['tanggal_awal'] }}</td>
                        <td>{{ $data['tanggal_akhir'] }}</td>
                        <td>{{ $data['tempat_tujuan'] }}</td>
                        <td>{{ $data['uraian_tugas'] }}</td>
                        <td>{{ $data['tanggal_pengajuan'] }}</td>
                        <td>{{ $data['tanggal_respon'] }}</td>
                        <td>
                            @if ($data['status'] == '1')
                                Pending
                            @elseif ($data['status'] == '2')
                                Terima
                            @else
                                Tolak
                            @endif
                        </td>
                        <td>
                            <a href="#" data-id="{{ $data['id'] }}" class="btn btn-danger delete"><i
                                    class="fas fa-trash"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data izin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertDataIzin">
                        <div class="mb-3">
                            <label for="nik_karyawan">NIK Karyawan</label>
                            <select class="form-select" id="nik">
                                <option selected>Pilih Karyawan</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai['nik'] }}">{{ $pegawai['nik'] }} - {{ $pegawai['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama">Tipe Izin</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="Surat Tugas"
                                readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nik_karyawan">Tempat Tujuan</label>
                            <select class="form-select" id="tempat_tujuan">
                                <option selected>Pilih tempat tujuan</option>
                                @foreach ($kantors as $kantor)
                                    <option value="{{ $kantor['id'] }}">{{ $kantor['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="uraian_tugas">Uraian Tugas</label>
                            <input type="text" name="uraian_tugas" id="uraian_tugas" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                        <input type="text" id="tanggal_pengajuan" value="{{ now()->format('Y-m-d') }}" hidden readonly>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('included-js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#listTable').DataTable({
                dom: 'lrt'
            });
            table.column(1).data().unique().sort().each(function(d, j) {
                $('#filterNIK').append('<option value="' + d + '">' + d + '</option')
            });
            $('#filterNIK').on('change', function() {
                table.column(1).search(this.value).draw();
            });
            $('#filterStatus').on('change', function() {
                    table.column(9)).search(this.value).draw();
            }); $('#resetButton').click(function() {
            $('#filterNIK').prop('selectedIndex', 0);
            $('#filterStatus').prop('selectedIndex', 0);
            table.columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]).search('').draw();
        });
        });
        //Add Data
        $('#insertDataIzin').on('submit', function(e) {
            e.preventDefault();
            var form = $(this).serialize();
            let nik = $('#nik').val();
            let tanggal_awal = $('#tanggal_awal').val();
            let tanggal_akhir = $('#tanggal_akhir').val();
            let tempat_tujuan = $('#tempat_tujuan').val();
            let uraian_tugas = $('#uraian_tugas').val();
            var tanggal_pengajuan = $('#tanggal_pengajuan').val();
            if (tanggal_awal != "" && nik != "" && tanggal_awal != "" && uraian_tugas != "" && tempat_tujuan !=
                "") {
                $.ajax({
                    method: 'POST',
                    url: "/perizinan/surattugas",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        nik: nik,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                        tempat_tujuan: tempat_tujuan,
                        uraian_tugas: uraian_tugas,
                        tanggal_pengajuan: tanggal_pengajuan
                    },
                    success: function(response) {
                        console.log(response);
                        data = JSON.parse(response);
                        console.log(data);
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: "Data ditambahkan",
                            }).then(function() {
                                location.href = "/perizinan/surattugas";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal tambah data',
                                text: data.message,
                            });
                        }
                    },
                    error: function(request, status, error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal tambah data',
                            text: data.message,
                        });

                    }
                });
            }
        });

        //Delete Data
        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Hapus Data Presensi',
                text: "Apakah anda yakin ingin data kantor ?",
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
                        url: "/perizinan/surattugas/" + id,
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
                                ).then(function() {
                                    location.href = "/perizinan/surattugas";
                                });
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
    </script>
@endsection
