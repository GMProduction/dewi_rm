@extends('main.layouts')
@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Data Penyakit</div>
        <div class="my-text-semi-dark f14">Data Penyakit Terbanyak</div>
    </div>
@endsection
@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Penyakit</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto p-2 f20 f-bold">Daftar Kasus Penyakit</div>
                <a href="#" onclick="reload()" class="btn my-button my-rounded pl-3 pr-3">
                    <i class="fa fa-search mr-3"></i>Cari
                </a>
            </div>
            <div class="dropdown-divider"></div>
            <h5 class="f-bold mb-0">Filter Tanggal</h5>
            <div class="d-flex align-items-center">
                <x-lazy.input.text id="tgl1" name="tgl1" type="date"></x-lazy.input.text>
                <span class="mr-1 ml-1"> Sampai Dengan </span>
                <x-lazy.input.text id="tgl2" name="tgl2" type="date"></x-lazy.input.text>
            </div>
            <div class="dropdown-divider"></div>
            <div class="table-responsive-lg">
                <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="15%">No. Resep</th>
                        <th width="15%">Nama Dokter</th>
                        <th width="15%">Nama Pasien</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="dropdown-divider"></div>
            <div class="text-right">
                <a href="#" onclick="cetak()" class="btn my-button my-rounded pl-3 pr-3">
                    <i class="fa fa-print mr-3"></i>Cetak
                </a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        let table;

        function cetak() {
            event.preventDefault();
            let tgl1 = $('#tgl1').val();
            let tgl2 = $('#tgl2').val();
            window.open('/admin/penyakit/print?tgl1=' + tgl1 + '&tgl2=' + tgl2, '_blank');
        }

        function reload() {
            event.preventDefault();
            table.ajax.reload();
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = $('#example2').DataTable({
                "scrollX": true,
                processing: true,
                ajax: {
                    type: 'GET',
                    url: '/admin/penyakit/list',
                    'data': function (d) {
                        return $.extend(
                            {},
                            d,
                            {
                                'tgl1': $('#tgl1').val(),
                                'tgl2': $('#tgl2').val(),
                            }
                        );
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'penyakit'},
                    {data: 'qty'}
                ],

            });
        });

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
