@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Jumlah Kasus Penyakit Terbanyak</div>
    <div class="text-center">Dari Tanggal {{ $tgl1 }} sampai dengan {{ $tgl2 }}</div>

    <hr>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th>#</th>
            <th>Nama Penyakit</th>
            <th>Jumlah Kasus</th>
        </tr>
        </thead>
        <tbody>
        @foreach($penyakit as $v)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $v->penyakit }}</td>
                <td>{{ $v->qty }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
@endsection
