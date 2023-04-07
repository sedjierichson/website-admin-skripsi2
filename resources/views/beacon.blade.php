@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            
            <div class="row justify-content-between">
                <div class="col-9">
                    <h3>Data Beacon</h3>
                </div>
                <div class="col-3">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-9">                               
                                <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#caraTambahBeacon" style="background-color: #ffa133">Lihat Cara Tambah Beacon</a>
                            </div>
                            <div class="col-3">            
                                <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133">Tambah Beacon</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <select class="form-select mb-3" id="filterKantor">
                <option selected>Pilih Kantor</option>
            </select>
            
        </div>
        <div class="col-5">
            <button class="p-auto" id="resetButton">Reset</button>
        </div>
    </div>
    <div class="table-responsive col-xl justify-content-center mb-5">  
        <table class="table table-bordered text-center" id="listTable">
            <thead style="background-color: #363636; color:#ffffff;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lokasi Kantor</th>
                    <th scope="col">UUID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Lokasi Penempatan</th>
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
                        <td>{{ $data['lokasi_kantor'] }}</td>
                        <td>{{ $data['uuid'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['lokasi'] }}</td>
                        <td>
                            <a href="template/{{ $data['nama'] }}/{{ $data['uuid'] }}" class="btn btn-success copyCodingan"><i class="fa-solid fa-code"></i></a>
                            <a href="#" data-id="{{ $data['id_beacon'] }}" data-namabeacon = "{{ $data['nama'] }}" data-lokasi="{{ $data['lokasi'] }}" data-uuid="{{ $data['uuid'] }}" data-kantor= "{{ $data['lokasi_kantor'] }}"class="btn btn-warning edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-id="{{ $data['id_beacon'] }}" class="btn btn-danger delete"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah beacon baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateBeacon">
                    <input type="text" id="id" name="id" hidden required>
                    <div class="mb-3">
                        <label for="kantor">Lokasi Kantor</label>  
                        <input type="text" name="kantor" id="kantor" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama Beacon</label>  
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="uuid">UUID Beacon</label>  
                        <input type="text" name="uuid" id="uuid" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi">Lokasi Penempatan</label>  
                        <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="caraTambahBeacon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cara tambah beacon baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form id="insertDataBeacon"> --}}
                    <p>1. Isi form tambah beacon</p>
                    <p>2. Tekan tombol "Compile Arduino" dan akan diarahkan ke halaman berisi code</p>
                    <p>3. Salin semua code</p>
                    <p>4. Buka aplikasi arduino yang bisa diunduh di : <a href="https://www.arduino.cc/en/software">https://www.arduino.cc/en/software</a> </p>
                    <p>5. Tempel semua code ke aplikasi arduino</p>
                    <p>6. Hubungkan perangkat ESP32 ke komputer dengan usb</p>
                    <p>7. Jika sudah selesai, konfigurasi ESP32 berhasil dan siap digunakan</p>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('included-js')
    <script type="text/javascript">
        //Add Data
        $(document).ready(function(){
            var table = $('#listTable').DataTable({dom: 'lrt'});
            table.column(1).data().unique().sort().each(function(d,j){
                $('#filterKantor').append('<option value="' + d + '">' + d + '</option')
            });

            $('#filterKantor').on('change', function(){
                table.column(1).search(this.value).draw();
            });
            $('#resetButton').click(function(){
                table.columns().search('').draw();
                // $('#listTable').DataTable({dom: 'lrt'}).fnFilter('');
            });
        });
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
                                location.href = "/beacon";        
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
            $('#editDataModal').modal('show');
            $('#updateBeacon #id').val($(this).data('id'));
            $('#updateBeacon #nama').val($(this).data('namabeacon'));
            $('#updateBeacon #lokasi').val($(this).data('lokasi'));
            $('#updateBeacon #uuid').val($(this).data('uuid'));
            $('#updateBeacon #kantor').val($(this).data('kantor'));
        });

        $('#updateBeacon').on('submit', function(e) {
            e.preventDefault();
            var form = $(this).serialize();

            $.ajax({
                method: 'PUT',
                url: "/beacon/"+ $(this).data('id'),
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
                            'Beacon berhasil diubah',
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
@endsection