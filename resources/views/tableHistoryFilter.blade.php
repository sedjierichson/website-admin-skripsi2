@extends('layouts.main')

@php
    $lastIterationNumber = 0;
@endphp

@section('included-css')
    <style>
        #head {
            background-color: #363636;
            color: #ffffff;
        }
    </style>
@endsection

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Data History Keluar Masuk Presensi Karyawan</h3>
    </div>
    <div class="row">
        <div class="col-2">

            <h5>Durasi Total Keluar :</h5>
        </div>
        <div class="col">

            <h5 id="durasi"></h5>
        </div>
    </div>
    @if (isset($filter))
        <div class="row">
            <div class="col">
                <h5>Jam Masuk : {{ $historyHarians[0]['jam_masuk'] }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5>Jam Pulang : {{ $historyHarians[0]['jam_keluar'] }}</h5>
            </div>
        </div>
    @endif

    <div class="row mt-3">

        <div class="col">
            <p>Tanggal Awal : </p>
            <input type="date" class="form-control date-range-filter" id="filterTanggalAwal"
                placeholder="Pilih Tanggal Awal">
        </div>
        <div class="col">
            <p>Tanggal Akhir : </p>
            <input type="date" class="form-control date-range-filter" id="filterTanggalAkhir"
                placeholder="Pilih Tanggal Akhir">
        </div>
        <div class="col">
            <p>Pilih NIK : </p>
            <select class="form-select mb-3" id="filterNIK">
                <option id="baba" selected>Pilih NIK</option>
                @foreach ($listNIK as $data)
                    <option value="{{ $data['nik'] }}">{{ $data['nik'] }} - {{ $data['nama'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <p style="color: white;">.</p>
            <button class="btn btn-secondary" id="resetButton">Reset</button>
        </div>
    </div>
    <div class="table-responsive col-xl justify-content-center mb-5">
        <table class="table table-bordered text-center" id="listTable">
            <thead id="head">
                <tr>
                    <th scope="col">Tanggal Presensi</th>
                    <th scope="col">NIK - Nama</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Jam Kembali</th>
                    <th scope="col">Durasi</th>
                    <th scope="col">Durasi</th>
                    @if (!isset($filter))
                        <th scope="col">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody id="memberKategori">
                @foreach ($historyHarians as $data)
                    <tr>
                        <td>{{ $data['tanggal'] }}</td>
                        <td>{{ $data['nik'] }} - {{ $data['nama'] }}</td>
                        <td>{{ $data['jam_keluar_history'] }}</td>
                        <td>{{ $data['jam_masuk_history'] }}</td>
                        <td>{{ $data['durasi'] }}</td>
                        <td>{{ $data['detik'] }}</td>
                        @if (!isset($filter))
                            <td><a class="btn btn-warning view" data-nama="{{ $data['nama'] }}"
                                    data-nik="{{ $data['nik'] }}" data-tanggal="{{ $data['tanggal'] }}"
                                    data-jammasuk="{{ $data['jam_masuk'] }}" data-jampulang="{{ $data['jam_keluar'] }}"><i
                                        class="fas fa-info-circle"></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('other')
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info Presensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="infoPresensi">
                        <div class="mb-3">
                            <label for="nama">Nama Kantor</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Masukkan nama kantor" required>
                        </div>
                        <div class="mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                placeholder="Masukkan nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" name="tanggal" id="tanggal" class="form-control"
                                placeholder="Masukkan tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="Jam Masuk">Jam Masuk Kantor</label>
                            <input type="text" name="Jam Masuk" id="jam_masuk" class="form-control"
                                placeholder="Masukkan Jam Masuk" required>
                        </div>
                        <div class="mb-3">
                            <label for="Jam Pulang">Jam Pulang kantor</label>
                            <input type="text" name="Jam Pulang" id="jam_pulang" class="form-control"
                                placeholder="Masukkan Jam Pulang" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('included-js')
    <script type="text/javascript">
        if (!window.moment) {
            document.write('<script src="assets/plugins/moment/moment.min.js"><\/script>');
        }
        $(document).ready(function() {
            var totalAmount = 0;
            var total = 0;
            var table = $('#listTable').DataTable({
                columnDefs: [{
                    target: 5,
                    visible: false
                }],
                dom: 'rtip',
            });

            function secondsTimeSpanToHMS(s) {
                var h = Math.floor(s / 3600); //Get whole hours
                s -= h * 3600;
                var m = Math.floor(s / 60); //Get remaining minutes
                s -= m * 60;
                return h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s :
                    s); //zero padding on minutes and seconds
            }

            function calculate() {

                var durasi = table.column(5, {
                    filter: 'applied'
                }).data();
                total = 0;
                for (var i = 0; i < durasi.length; i++) {
                    total += parseFloat(durasi[i]);
                }
                console.log(total);
                $('#durasi').text(secondsTimeSpanToHMS(total));
            }
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#filterTanggalAwal').val();
                    var max = $('#filterTanggalAkhir').val();
                    var createdAt = data[0] || 0;

                    if (
                        (min == "" || max == "") ||
                        (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            calculate();

            $('#filterNIK').on('change', function() {
                table.column(1).search(this.value).draw();
                calculate();
            });

            $('#filterTanggalAwal').on('change', function() {
                table.column(0).search(this.value).draw();
                calculate();
            });
            $('#filterTanggalAkhir').click(function() {
                table.search('').columns().search('').draw();
            });
            $('#filterTanggalAkhir').on('change', function() {
                table.draw();
                calculate();
            });

            $('#resetButton').click(function() {
                location.href = "/historyKeluarMasuk";
            });
            var editEvent;
            $(document).on('click', '.view', function(event) {
                event.preventDefault();
                editEvent = event;
                $('#infoModal').modal('show');
                $('#infoPresensi #nama').val($(this).data('nama'));
                $('#infoPresensi #nik').val($(this).data('nik'));
                $('#infoPresensi #tanggal').val($(this).data('tanggal'));
                $('#infoPresensi #jam_masuk').val($(this).data('jammasuk'));
                $('#infoPresensi #jam_pulang').val($(this).data('jampulang'));
            });
        });
    </script>
@endsection
