@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Rekam Medis</div>
        <div class="my-text-semi-dark f14">Detail Rekam Medis Pasien</div>
    </div>
@endsection

@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/rekam">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="toast-auto-close my-toast-success d-flex align-items-center">
            <i class="fa fa-check f24 my-text-light mr-2"></i>
            <div class="my-text-light f14">Success!</div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-12">
            <div class="card card-outline card-primary my-card">
                <div class="card-header d-flex">
                    <div class="card-title flex-grow-1">Detail Resep</div>
                    <div class="text-right">
                        <a href="/admin/resep/cetak/{{$resep[0]->diagnosa->no_diagnosa}}" target="_blank" class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-print mr-2"></i>Cetak
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="text-right">No. Diagnosa : {{ $resep[0]->diagnosa->no_diagnosa }}</h5>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="f-bold">Informasi Pasien</h6>
                                <div><span class="f-bold">Nama Pasien :</span> {{ hex2bin($resep[0]->diagnosa->pasien->nama) }}</div>
                                <div><span class="f-bold">Alamat :</span> {{ $resep[0]->diagnosa->pasien->alamat }}</div>
                                <div><span class="f-bold">Jenis Kelamin :</span> {{ $resep[0]->diagnosa->pasien->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="col-6">
                                <h6 class="f-bold">Informasi Dokter</h6>
                                <div><span class="f-bold">Nama Dokter :</span> {{ $resep[0]->diagnosa->dokter->nama }}</div>
                                <div><span class="f-bold">Spesialis :</span> {{ $resep[0]->diagnosa->dokter->spesialis->name }}</div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <h5 class="f-bold">Hasil Pemeriksaan</h5>
                        <div><span class="f-bold">Diagnosa :</span> {{ hex2bin($resep[0]->diagnosa->diagnosa) }}</div>
                    </div>

                    <div class="dropdown-divider"></div>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#my-table').DataTable({
                "scrollX": true
            });
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
