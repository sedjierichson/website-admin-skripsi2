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
    {{-- @if (isset($durasi)) --}}
    <div class="row">
        <div class="col-2">

            <h5>Durasi Total Keluar :</h5>
        </div>
        <div class="col">

            <h5 id="durasi"></h5>
        </div>
    </div>
    {{-- @endif --}}
    <div class="row">

        <div class="col">
            <p>Tanggal Awal : </p>
            <input type="date" class="form-control" id="filterTanggalAwal" placeholder="Pilih Tanggal Awal">
        </div>
        <div class="col">
            <p>Tanggal Akhir : </p>
            <input type="date" class="form-control" id="filterTanggalAkhir" placeholder="Pilih Tanggal Akhir">
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
            <p></p>
            <button class="btn btn-secondary" id="resetButton">Reset</button>
            <button class="btn btn-primary" id="searchButton">Cari</button>
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
                </tr>
            </thead>
            <tbody id="memberKategori">
                @foreach ($historyHarians as $data)
                    {{-- @if (isset($nik) && isset($tanggal))
                        @if ($data['nik'] == $nik && $data['tanggal'] == $tanggal)
                            <tr>
                                <td>{{ $data['tanggal'] }}</td>
                                <td>{{ $data['nik'] }} - {{ $data['nama'] }}</td>
                                <td>{{ $data['jam_keluar'] }}</td>
                                <td>{{ $data['jam_masuk'] }}</td>
                                <td>{{ $data['durasi'] }}</td>
                            </tr>
                        @endif --}}
                    {{-- @elseif (isset($nik))
                        @if ($data['nik'] == $nik)
                            <tr>
                                <td>{{ $data['tanggal'] }}</td>
                                <td>{{ $data['nik'] }} - {{ $data['nama'] }}</td>
                                <td>{{ $data['jam_keluar'] }}</td>
                                <td>{{ $data['jam_masuk'] }}</td>
                                <td>{{ $data['durasi'] }}</td>
                            </tr>
                        @endif
                    @elseif (isset($tanggal))
                        @if ($data['tanggal'] == $tanggal)
                            <tr>
                                <td>{{ $data['tanggal'] }}</td>
                                <td>{{ $data['nik'] }} - {{ $data['nama'] }}</td>
                                <td>{{ $data['jam_keluar'] }}</td>
                                <td>{{ $data['jam_masuk'] }}</td>
                                <td>{{ $data['durasi'] }}</td>
                            </tr>
                        @endif --}}
                    {{-- @else --}}
                    <tr>
                        <td>{{ $data['tanggal'] }}</td>
                        <td>{{ $data['nik'] }} - {{ $data['nama'] }}</td>
                        <td>{{ $data['jam_keluar'] }}</td>
                        <td>{{ $data['jam_masuk'] }}</td>
                        <td>{{ $data['durasi'] }}</td>
                        <td>{{ $data['detik'] }}</td>
                    </tr>
                    {{-- @endif --}}
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot> --}}
        </table>
    </div>
@endsection

@section('included-js')
    <script type="text/javascript">
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
            calculate();

            $('#filterNIK').on('change', function() {
                table.column(1).search(this.value).draw();
                calculate();
            });

            $('#filterTanggalAwal').on('change', function() {
                table.column(0).search(this.value).draw();
                calculate();
            });

            $('#resetButton').click(function() {
                location.href = "/historyKeluarMasuk";
            });

        });
    </script>
@endsection
