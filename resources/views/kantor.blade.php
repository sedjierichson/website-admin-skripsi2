@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data Kantor</h3>
        <a class="btn" data-bs-toggle="modal" data-bs-target="#tambahDataModal" style="background-color: #ffa133">Tambah Kantor</a>
    </div>
    <div class="row justify-content-center">

        <div class="col-10">
    
            <div class="table-responsive justify-content-center mb-5">
                <table class="table table-bordered text-center">
                    <thead style="background-color: #363636; color:#ffffff;">
                        <tr>
                            <th class = "col" scope="col">#</th>
                            <th class = "col-5" scope="col">Nama</th>
                            <th class = "col-5" scope="col">Alamat</th>
                            <th class = "col-2" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="memberKategori">
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @php
                                    $lastIterationNumber = $loop->iteration;
                                @endphp
                                <td style="width: 10%">{{ $data['nama'] }}</td>
                                <td>{{ $data['alamat'] }}</td>
                                <td>
                                    <a href="#" data-name="{{ $data['nama'] }}" data-alamat="{{ $data['alamat'] }}" data-id="{{ $data['id'] }}"
                                        class="btn btn-warning edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" data-name="{{ $data['id'] }}" data-id="{{ $data['id'] }}"
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
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah kategori baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertDataKantor">
                    <div class="mb-3">
                        <label for="nama_kantor">Nama Kantor</label>  
                        <input type="text" name="nama_kantor" id="nama_kantor" class="form-control" placeholder="Masukkan nama kantor" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat kantor</label>  
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat" required>
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

{{-- edit modal --}}
<div class="modal fade" id="editKantorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateKantor">
                    <input type="text" id="id_kantor" name="id_kantor" hidden required>
                    <div class="mb-3">
                        <label for="nama">Nama Kantor</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="Masukkan nama kantor" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat Kantor</label>
                        <input type="text" id="alamat" name="alamat" class="form-control"
                            placeholder="Masukkan alamat kantor" required>
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
                        url: "/kantor/" + id,
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
                }
            });
        });
    </script>
@endsection