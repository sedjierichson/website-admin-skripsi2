@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data Izin Meninggalkan Lokasi Kerja</h3>
        <a class="btn" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133">Tambah Data</a>
    </div>
    <div class="table-responsive col-xl justify-content-center mb-5">
        <table class="table table-bordered text-center">
            <thead style="background-color: #363636; color:#ffffff;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIK - Nama Karyawan</th>
                    <th scope="col">NIK - Nama Atasan</th>
                    <th scope="col">Tanggal Izin</th>
                    <th scope="col">Jam Pergi</th>
                    <th scope="col">Jam Pulang</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Tanggal Respon</th>
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
                        <td>{{ $data['jam_awal'] }}</td>
                        <td>{{ $data['jam_akhir'] }}</td>
                        <td>{{ $data['alasan'] }}</td>
                        <td>{{ $data['tanggal_pengajuan'] }}</td>
                        <td>{{ $data['tanggal_respon'] }}</td>
                        <td>
                            {{-- <a href="#" data-name="{{ $data['nama'] }}" data-id="{{ $data['id'] }}"
                                class="btn btn-warning edit">Edit</a> --}}
                            <a href="#" data-id="{{ $data['id'] }}"
                                class="btn btn-danger delete"><i class="fas fa-trash"></i></a>
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
                                <option value="{{ $pegawai['nik'] }}">{{ $pegawai['nik'] }} - {{ $pegawai['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Tipe Izin</label>  
                        <input type="text" name="nama" id="nama" class="form-control" value="Meninggalkan Lokasi Kerja" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_izin">Tanggal Izin</label>  
                        <input type="date" name="tanggal_izin" id="tanggal_izin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_awal">Jam Pergi</label>  
                        <input type="time" name="jam_awal" id="jam_awal" class="form-control" placeholder="Masukkan jam pulang" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_akhir">Jam Pulang</label>  
                        <input type="time" name="jam_akhir" id="jam_akhir" class="form-control" placeholder="Masukkan jam pulang" required>
                    </div>
                    <div class="mb-3">
                        <label for="alasan">alasan</label>  
                        <input type="text" name="alasan" id="alasan" class="form-control" placeholder="Masukkan alasan" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    <input type="text" id="tanggal_pengajuan" value="{{ now()->format('Y-m-d') }}" readonly hidden>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('included-js')
    <script type="text/javascript">
        //Add Data
        $('#insertDataIzin').on('submit', function(e) {
            e.preventDefault();
            var form = $(this).serialize();
            let tanggal_izin = $('#tanggal_izin').val();
            let nik = $('#nik').val();
            let jam_awal = $('#jam_awal').val();
            let jam_akhir = $('#jam_akhir').val();
            let alasan = $('#alasan').val();
            var tanggal_pengajuan = $('#tanggal_pengajuan').val();
            if (tanggal_izin != "" && nik != "" && jam_awal != "" && jam_akhir != "" && alasan != ""){
                $.ajax({
                    method: 'POST',
                    url: "/perizinan/meninggalkanlokasikerja",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        nik: nik,
                        tanggal_izin: tanggal_izin,
                        jam_awal: jam_awal,
                        jam_akhir: jam_akhir,
                        alasan: alasan, 
                        tanggal_pengajuan : tanggal_pengajuan
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
                                location.href = "/perizinan/meninggalkanlokasikerja";        
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal tambah data',
                                text: data.message,
                            });
                        }
                        // $('#tambahKategoriModal').modal('hide');
                        // $('#insertKategori')[0].reset();
                    },
                    error: function(request, status, error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal tambah beacon',
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
                        url: "/perizinan/meninggalkanlokasikerja/" + id,
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
                                    location.href = "/perizinan/meninggalkanlokasikerja";        
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