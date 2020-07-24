@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Pasien</div>
        <div class="my-text-semi-dark f14">Semua Data Dokter Di Rumah Sakit</div>
    </div>
@endsection

@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/pasien">Dokter</a></li>
            <li class="breadcrumb-item active">New</li>
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
        <div class="col-lg-7 col-sm-12">
            <div class="card card-outline card-primary my-card">
                <div class="card-header">
                    <div class="card-title">Form Resep</div>
                </div>
                <div class="card-body">
                    <x-lazy.form.form-basic action="/admin/resep/store">
                        <x-lazy.input.select class="select2" id="dokter" name="dokter" label="Dokter">
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->user->id }}">{{ $dokter->nama }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.select class="select2" id="pasien" name="pasien" label="Pasien">
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->user->id }}">{{ $pasien->nama }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.select class="select2" id="obat" name="obat[]" label="Obat" multiple="multiple">
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}">{{ $obat->name }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <div class="dropdown-divider mt-3 mb-3"></div>
                        <div class="text-right">
                            <button class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-send-o mr-2"></i>Save
                            </button>
                        </div>
{{--                        <select class="js-example-basic-multiple w-100" name="states[]" multiple="multiple">--}}
{{--                            <option value="AL">Alabama</option>--}}
{{--                            <option value="WY">Wyoming</option>--}}
{{--                        </select>--}}
                    </x-lazy.form.form-basic>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/adminlte/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/select2/select2.full.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
@section('css')
    <link href="{{ asset('/adminlte/plugins/select2/select2.css') }}" rel="stylesheet">
@endsection
