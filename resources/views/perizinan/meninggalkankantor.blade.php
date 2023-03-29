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
                                class="btn btn-danger delete">Hapus</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

{{-- @section('other')
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah beacon baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertDataBeacon">
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
                        <label for="nama">Nama Beacon</label>  
                        <input type="text" name="nama" id="nama" class="form-control" value="Presensi PT X" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="uuid">UUID Beacon</label>  
                        <input type="text" name="uuid" id="uuid" class="form-control" value="{{ $uuid }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi">Lokasi Penempatan</label>  
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Masukkan lokasi (contoh: lt. 2 depan ruang x)" required>
                    </div>
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
        //Add Data
        $('#insertDataBeacon').on('submit', function(e) {
            e.preventDefault();
            var form = $(this).serialize();
            let id_kantor = $('#id_kantor').val();
            let nama = $('#nama').val();
            let uuid = $('#uuid').val();
            let lokasi = $('#lokasi').val();
            if (id_kantor != "" && nama != "" && uuid != "" && lokasi != ""){
                $.ajax({
                    method: 'POST',
                    url: "/beacon",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id_kantor: id_kantor,
                        nama: nama,
                        uuid: uuid,
                        lokasi: lokasi
                    },
                    success: function(response) {
                        // console.log(response);
                        data = JSON.parse(response);
                        console.log(data);
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: "Beacon ditambahkan",
                            }).then(function() {
                                location.href = "/kantor";        
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal tambah beacon',
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

        //Edit Data
        var editEvent;
        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            editEvent = event;
            $('#editKantorModal').modal('show');
            $('#updateKantor #nama').val($(this).data('name'));
            $('#updateKantor #alamat').val($(this).data('alamat'));
            $('#updateKantor #id_kantor').val($(this).data('id'));
        });
        $('#updateKantor').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();

                $.ajax({
                    method: 'PUT',
                    url: "/kantor/"+ $(this).data('id'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 1) {
                            Swal.fire(
                                'Updated!',
                                'Kantor berhasil diubah',
                                'success'
                            ).then(function() {
                                location.href = "/kantor";        
                            });
                            
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(request, status, error) {
                        alert("Not Ok");
                    }
                });
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
                        url: "/beacon/" + id,
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
                                    location.href = "/beacon";        
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
@endsection --}}