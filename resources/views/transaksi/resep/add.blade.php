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
            <li class="breadcrumb-item"><a href="/admin/resep">Resep</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Berhasil Menyimpan Data Resep!',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-12">
            <div class="card card-outline card-primary my-card">
                <div class="card-header">
                    <div class="card-title">Form Resep</div>
                </div>
                <div class="card-body">
                    <x-lazy.form.form-basic action="/admin/resep/store">

                        <x-lazy.input.select id="obat" name="obat" label="Obat">
                            @foreach($obat as $v)
                                <option value="{{ $v->id }}">{{  $v->nama }} ( Rp. {{ $v->harga }} )</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.text id="qty" name="qty" label="Qty" type="number" value="0"></x-lazy.input.text>
                        <div class="dropdown-divider mt-3 mb-3"></div>
                        <div class="text-right">
                            <button class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-send-o mr-2"></i>Tambah
                            </button>
                        </div>
                        <div class="dropdown-divider mt-3 mb-3"></div>
                        <table id="my-table" class="table display">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="15%">Nama Obat</th>
                                <th width="15%">Qty</th>
                                <th width="15%">Harga</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                            </thead>
                            <div class="card-title">Data Resep</div>
                            <tbody>
                            @foreach($resep as $v)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $v->obat->nama}}</td>
                                    <td>{{ $v->qty }}</td>
                                    <td>{{ $v->harga }}</td>
                                    <td class="text-center">
                                        <a data-id="{{ $v->id }}" href="#" onclick="destroyObat('{{ $v->id }}')"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </x-lazy.form.form-basic>


                </div>
            </div>
            <div class="card card-outline card-primary my-card">
                <div class="card-header">
                    <div class="card-title">Pilih Diagnosa</div>
                </div>
                <div class="card-body">
                    <x-lazy.form.form-basic action="/admin/resep/save">
                        <x-lazy.input.select id="diagnosa" name="diagnosa" label="No. Diagnosa">
                            @foreach($diagnosa as $v)
                                <option value="{{ $v->id }}">{{  $v->no_diagnosa }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <div class="text-right">
                            <button class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-send-o mr-2"></i>Simpan Resep
                            </button>
                        </div>
                    </x-lazy.form.form-basic>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        function destroyObat(id) {
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
                    let res = await $.post('/admin/resep/destroyobat/' + id, data);
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
