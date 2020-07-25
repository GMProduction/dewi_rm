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
            <li class="breadcrumb-item"><a href="/admin/diagnosa">Diagnosa</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Berhasil Menyimpan Data!',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-7 col-sm-12">
            <div class="card card-outline card-primary my-card">
                <div class="card-header">
                    <div class="card-title">Form Diagnosa</div>
                </div>
                <div class="card-body">
                    <x-lazy.form.form-basic action="/admin/diagnosa/store">
                        <x-lazy.input.select id="dokter" name="dokter" label="Dokter">
                            @foreach($dokter as $v)
                                <option value="{{ $v->user_id }}">{{  $v->nama }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.select id="pasien" name="pasien" label="Pasien">
                            @foreach($pasien as $v)
                                <option value="{{ $v->user_id }}">{{  hex2bin($v->nama) }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.area id="diagnosa" name="diagnosa" label="Diagnosa"></x-lazy.input.area>
                        <div class="dropdown-divider mt-3 mb-3"></div>
                        <div class="text-right">
                            <button class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-send-o mr-2"></i>Save
                            </button>
                        </div>
                    </x-lazy.form.form-basic>
                </div>
            </div>
        </div>
    </div>
@endsection
