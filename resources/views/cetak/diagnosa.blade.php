@extends('cetak.index')
@section('content')
    <div class="text-center f-bold report-title">Laporan Diagnosa</div>
    <div class="text-center">Dari Tanggal {{ $tgl1 }} sampai dengan {{ $tgl2 }}</div>

    <hr>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th>#</th>
            <th>No. Diagnosa</th>
            <th>Nama Dokter</th>
            <th>Nama Pasien</th>
            <th>Nama Diagnosa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnosa as $v)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $v->no_diagnosa }}</td>
                <td>{{ $v->dokter->nama }}</td>
                <td>{{ hex2bin($v->pasien->nama) }}</td>
                <td>{{ hex2bin($v->diagnosa) }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
@endsection
