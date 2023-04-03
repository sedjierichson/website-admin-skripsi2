@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Jam Kerja Kantor</h3>
    </div>
    <div class="row justify-content-center">

        <div class="col-10">
    
            <div class="table-responsive justify-content-center mb-5">
                <table class="table table-bordered text-center">
                    <thead style="background-color: #363636; color:#ffffff;">
                        <tr>
                            <th scope="col">#</th>
                            <th  scope="col">Hari</th>
                            <th  scope="col">Jam Masuk</th>
                            <th  scope="col">Jam Pulang</th>
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
                                <td>{{ $data['hari'] }}</td>
                                <td>{{ $data['jam_masuk'] }}</td>
                                <td>{{ $data['jam_pulang'] }}</td>
                                <td>
                                    <a href="#" data-id="{{ $data['id'] }}" data-jammasuk = {{ $data['jam_masuk'] }} data-jampulang = {{ $data['jam_pulang'] }} data-hari = {{ $data['hari'] }}
                                        class="btn btn-warning edit"><i class="fa-solid fa-pen-to-square"></i></a>
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
<div class="modal fade" id="editJamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateJam">
                    <input type="text" id="id" name="id" hidden required>
                    <div class="mb-3">
                        <label for="hari">Hari</label>
                        <input type="text" id="hari" name="hari" class="form-control"
                            readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_masuk">Jam Masuk</label>
                        <input type="time" id="jam_masuk" name="jam_masuk" class="form-control"
                        required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_pulang">Jam Pulang</label>
                        <input type="time" id="jam_pulang" name="jam_pulang" class="form-control"
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

        //Edit Data
        var editEvent;
        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            editEvent = event;
            $('#editJamModal').modal('show');
            $('#updateJam #id').val($(this).data('id'));
            $('#updateJam #jam_masuk').val($(this).data('jammasuk'));
            $('#updateJam #jam_pulang').val($(this).data('jampulang'));
            $('#updateJam #hari').val($(this).data('hari'));
        });

        $('#updateJam').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();

                $.ajax({
                    method: 'PUT',
                    url: "/jamkerja/"+ $(this).data('nik'),
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
                                'Jam kerja berhasil diubah',
                                'success'
                            ).then(function() {
                                location.href = "/jamkerja";        
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
    </script>
@endsection