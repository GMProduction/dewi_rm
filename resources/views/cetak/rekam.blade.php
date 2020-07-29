@extends('cetak.index')
@section('content')
<div class="report-title text-center">DATA REKAM MEDIS</div>
<div class="text-right"><span style="font-weight: bold">No. Diagnosa :  </span>{{ $resep[0]->diagnosa->no_diagnosa }}</div>
<hr>
<div class="row">
    <div class="col-xs-6">
        <h5 class="f-bold">Informasi Pasien</h5>
        <div><span class="f-bold">Nama Pasien :</span> {{ hex2bin($resep[0]->diagnosa->pasien->nama) }}</div>
        <div><span class="f-bold">Alamat :</span> {{ $resep[0]->diagnosa->pasien->alamat }}</div>
        <div><span
                class="f-bold">Jenis Kelamin :</span> {{ $resep[0]->diagnosa->pasien->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
        </div>
    </div>
    <div class="col-xs-6">
        <h5 class="f-bold">Informasi Dokter</h5>
        <div><span class="f-bold">Nama Dokter :</span> {{ $resep[0]->diagnosa->dokter->nama }}</div>
        <div><span class="f-bold">Spesialis :</span> {{ $resep[0]->diagnosa->dokter->spesialis->name }}</div>
    </div>
</div>
<hr>
<h5 class="f-bold">Hasil Pemeriksaan</h5>
<div><span class="f-bold">Diagnosa :</span> {{ hex2bin($resep[0]->diagnosa->diagnosa) }}</div>
<hr>
<h5 class="f-bold">INFORMASI RESEP</h5>
<div>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="10%">#</th>
            <th width="15%">Nama Obat</th>
            <th width="15%">Harga</th>
            <th width="15%">Qty</th>
        </tr>
        </thead>
        <tbody>
        @foreach($resep as $obat)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $obat->obat->nama }}</td>
                <td>{{ $obat->harga }}</td>
                <td>{{ $obat->qty }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<hr>
<div class="footer"></div>
@endsection
