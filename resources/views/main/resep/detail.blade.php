@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Resep</div>
        <div class="my-text-semi-dark f14">Detail Resep Pasien</div>
    </div>
@endsection

@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/resep">Resep</a></li>
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
                <div class="card-header">
                    <div class="card-title">Detail Resep</div>
                </div>
                <div class="card-body">
                    <div>
                        No. Resep : {{ $reseps->no_resep }}<br>
                        Nama Dokter : {{ $reseps->dokter->nama }}<br>
                        Nama Pasien : {{ $reseps->pasien->nama }}
                    </div>
                    <div class="dropdown-divider"></div>
                    <div>
                        <table id="my-table" class="table display">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="15%">Nama Obat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reseps->obat as $obat)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $obat->name }}</td>
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
