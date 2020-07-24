@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Resep</div>
        <div class="my-text-semi-dark f14">Semua Data Resep Di Rumah Sakit</div>
    </div>
@endsection
@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Resep</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto p-2 f20 f-bold">List Resep</div>
                <a href="/admin/resep/add" class="btn my-button my-rounded pl-3 pr-3">
                    <i class="fa fa-plus mr-3"></i>New
                </a>
            </div>
            <div class="dropdown-divider mt-4"></div>
            @if(count($reseps) > 0)
                <table id="my-table" class="table display">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="15%">No. Resep</th>
                        <th width="15%">Nama Dokter</th>
                        <th width="15%">Nama Pasien</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reseps as $resep)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $resep->no_resep }}</td>
                            <td>{{ $resep->dokter->nama }}</td>
                            <td>{{ $resep->pasien->nama }}</td>
                            <td class="text-center">
                                <a data-id="{{ $resep->id }}" href="/admin/resep/detail/{{ $resep->id }}">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex align-items-center justify-content-center h-50">
                    <div class="pt-lg-5">
                        <img class="img-fluid" src="{{ asset('images/nodata.png') }}" width="400" alt="">
                        <div class="text-center" style="font-size: 30px; font-weight: bold">You Have No Data</div>
                    </div>
                </div>
            @endif
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
