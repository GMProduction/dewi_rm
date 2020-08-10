@extends('cetak.index')
@section('content')
    <div class="report-title text-center">Laporan Rekam Medis</div>
    <div class="text-center">Dari Tanggal {{ $tgl1 }} sampai dengan {{ $tgl2 }}</div>
    <hr>
    @foreach($diagnosa as $v)
            <div class="row">
                <div class="col-xs-6">
                    <h5 class="f-bold">Informasi Pasien</h5>
                    <div><span class="f-bold">Nama Pasien :</span> {{ hex2bin($v->pasien->nama)}}</div>
                    <div><span class="f-bold">Alamat :</span> {{ $v->pasien->alamat }}</div>
                    <div><span
                            class="f-bold">Jenis Kelamin :</span> {{ $v->pasien->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
                    </div>
                </div>
                <div class="col-xs-6">
                    <h5 class="f-bold">Informasi Dokter</h5>
                    <div><span class="f-bold">Nama Dokter :</span> {{ $v->dokter->nama }}</div>
                    <div><span class="f-bold">Spesialis :</span> {{ $v->dokter->spesialis->name }}</div>
                </div>
            </div>
            <div><span class="f-bold">Tanggal Periksa :</span> {{ $v->created_at->format('Y-m-d')}}</div>
            <h5 class="f-bold">Hasil Pemeriksaan</h5>
            <div><span class="f-bold">No. Diagnosa :</span> {{ $v->no_diagnosa }}</div>
            <div><span class="f-bold">Diagnosa :</span> {{ hex2bin($v->diagnosa) }}</div>
            <h5 class="f-bold">INFORMASI RESEP</h5>
                <div>
                    <table id="my-table" class="table display">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="15%">Nama Obat</th>
                            <th width="15%">Harga</th>
                            <th width="15%">Qty</th>
                            <th width="15%">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($v->resep as $vr)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $vr->obat->nama }}</td>
                                <td>Rp. {{ number_format($vr->harga) }}</td>
                                <td>{{ $vr->qty }}</td>
                                <td>Rp. {{ number_format($vr->harga * $vr->qty) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-right"><span class="f-bold">Total :</span>Rp. {{ number_format($v->resep->sum(function ($v){return $v->harga * $v->qty;})) }}</div>
                </div>
        <hr>
        <br>
    @endforeach


    {{--    <hr>--}}
    {{--    <h5 class="f-bold">Hasil Pemeriksaan</h5>--}}
    {{--    <div><span class="f-bold">Diagnosa :</span> {{ hex2bin($resep[0]->diagnosa->diagnosa) }}</div>--}}
    {{--    <hr>--}}
    {{--    <h5 class="f-bold">INFORMASI RESEP</h5>--}}
    {{--    <div>--}}
    {{--        <table id="my-table" class="table display">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th width="10%">#</th>--}}
    {{--                <th width="15%">Nama Obat</th>--}}
    {{--                <th width="15%">Harga</th>--}}
    {{--                <th width="15%">Qty</th>--}}
    {{--            </tr>--}}
    {{--            </thead>--}}
    {{--            <tbody>--}}
    {{--            @foreach($resep as $obat)--}}
    {{--                <tr>--}}
    {{--                    <td>{{ $loop->index + 1 }}</td>--}}
    {{--                    <td>{{ $obat->obat->nama }}</td>--}}
    {{--                    <td>{{ $obat->harga }}</td>--}}
    {{--                    <td>{{ $obat->qty }}</td>--}}
    {{--                </tr>--}}
    {{--            @endforeach--}}
    {{--            </tbody>--}}
    {{--        </table>--}}
    {{--    </div>--}}
    {{--    <hr>--}}
    <div class="footer"></div>
@endsection
