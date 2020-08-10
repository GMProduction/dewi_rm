@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Diagnosa</div>
        <div class="my-text-semi-dark f14">Semua Data Diagnosa Di Rumah Sakit</div>
    </div>
@endsection
@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Diagnosa</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto p-2 f20 f-bold">List Diagnosa</div>
                <a href="/admin/diagnosa/add" class="btn my-button my-rounded pl-3 pr-3">
                    <i class="fa fa-plus mr-3"></i>New
                </a>
            </div>
            <div class="dropdown-divider mt-4"></div>
            @if(count($diagnosa) > 0)
                <table id="my-table" class="table display">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="15%">No. Diagnosa</th>
                        <th width="15%">Nama Dokter</th>
                        <th width="15%">Nama Pasien</th>
                        <th width="15%">Nama Diagnosa</th>
                        <th width="10%" class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnosa as $v)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $v->no_diagnosa}}</td>
                            <td>{{ $v->dokter->nama }}</td>
                            <td>{{ $v->pasien->nama }}</td>
                            <td>{{ hex2bin($v->diagnosa)}}</td>
                            <td class="text-center">
{{--                                <a data-id="{{ $v->id }}" href="/admin/admin/edit/{{$v->id}}"><i--}}
{{--                                        class="fa fa-edit"></i></a>--}}
{{--                                <a data-id="{{ $v->id }}" href="#" onclick="destroy('{{ $v->user->id }}')"><i class="fa fa-trash-o"></i></a>--}}
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
        function destroy(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.value) {
                    let data = {
                        '_token': '{{ csrf_token() }}'
                    };
                    let res = await $.post('/admin/admin/destroy/'+id, data);
                    console.log(res);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.reload()
                }
            })
        }
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
