@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data Security Code Login</h3>
        {{-- <a class="btn" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133">Tambah Data</a> --}}
    </div>
    <div class="row justify-content-center">

        <div class="col-10">
    
            <div class="table-responsive justify-content-center mb-5">
                <table class="table table-bordered text-center">
                    <thead style="background-color: #363636; color:#ffffff;">
                        <tr>
                            <th scope="col">#</th>
                            <th  scope="col">NIK</th>
                            <th  scope="col">Nama</th>
                            <th  scope="col">IMEI</th>
                            <th  scope="col">Security Code Login</th>
                            <th  scope="col">Aksi</th>
                        </tr>           
                    </thead>
                    <tbody id="memberKategori">
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @php
                                    $lastIterationNumber = $loop->iteration;
                                @endphp
                                <td>{{ $data['nik'] }}</td>
                                <td>{{ $data['nama'] }}</td>
                                <td>{{ $data['imei'] }}</td>
                                <td>{{ $data['security_code'] }}</td>
                                <td>
                                    <a href="#" data-name="{{ $data['nama'] }}" data-nik="{{ $data['nik'] }}" data-id="{{ $data['id'] }}" data-code="{{ $data['security_code'] }}" data-imei="{{ $data['imei'] }}"
                                        class="btn btn-warning edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" data-id="{{ $data['id'] }}"
                                        class="btn btn-danger delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('other')

{{-- edit modal --}}
<div class="modal fade" id="editPegawaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updatePegawai">
                    <input type="text" id="id" name="id" hidden required>
                    <input type="text" id="nik" name="nik" hidden required>
                    <div class="mb-3">
                        <label for="nama">Nama Pegawai</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="imei">IMEI</label>
                        <input type="text" id="imei" name="imei" class="form-control"
                            readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="security_code">Security Code Login</label>
                        <input type="text" id="security_code" name="security_code" class="form-control"
                        required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
        $('#insertDataKantor').on('submit', function(e) {
            e.preventDefault();
            var form = $(this).serialize();
            let nama_kantor = $('#nama_kantor').val();
            let alamat = $('#alamat').val();
            console.log(nama_kantor);
            console.log(alamat);
            if (nama_kantor != "" && alamat != ""){
                $.ajax({
                    method: 'POST',
                    url: "/kantor",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        nama: nama_kantor,
                        alamat: alamat
                    },
                    success: function(response) {
                        // console.log(response);
                        data = JSON.parse(response);
                        console.log(data);
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil tambah data kantor',
                                text: "Data kantor ditambahkan",
                            }).then(function() {
                                location.href = "/kantor";        
                            });
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal tambah kategori',
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
            $('#editPegawaiModal').modal('show');
            $('#updatePegawai #id').val($(this).data('id'));
            $('#updatePegawai #nik').val($(this).data('nik'));
            $('#updatePegawai #nama').val($(this).data('name'));
            $('#updatePegawai #imei').val($(this).data('imei'));
            $('#updatePegawai #security_code').val($(this).data('code'));
        });

        $('#updatePegawai').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();

                $.ajax({
                    method: 'PUT',
                    url: "/codelogin/"+ $(this).data('nik'),
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
                                'Security code berhasil diubah',
                                'success'
                            ).then(function() {
                                location.href = "/codelogin";        
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
                text: "Apakah anda yakin ingin data pegawai ?",
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
                        url: "/codelogin/" + id,
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
                                    location.href = "/codelogin";        
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