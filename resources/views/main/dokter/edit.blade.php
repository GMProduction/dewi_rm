@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Dokter</div>
        <div class="my-text-semi-dark f14">Semua Data Dokter Di Rumah Sakit</div>
    </div>
@endsection

@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/dokter">Dokter</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Berhasil Merubah Data!',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-7 col-sm-12">
            <div class="card card-outline card-primary my-card">
                <div class="card-header">
                    <div class="card-title">Form Dokter</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/dokter/patch">
                        @csrf
                        <input name="id" type="hidden" value="{{ $dokter->user->id }}">
                        <x-lazy.input.text id="username" name="username" label="Username" value="{{ $dokter->user->username }}"/>
                        <x-lazy.input.text id="nama" name="nama" label="Nama Lengkap Apoteker" value="{{ $dokter->nama }}"/>
                        <x-lazy.input.select id="spesialis" name="spesialis" label="Spesialis">
                            @foreach($spesialis as $v)
                                <option value="{{ $v->id }}" {{ $dokter->spesialis->id == $v->id ? 'selected' : ''}}>{{  $v->name }}</option>
                            @endforeach
                        </x-lazy.input.select>
                        <x-lazy.input.area id="alamat" name="alamat" label="Alamat">{{ $dokter->alamat }}</x-lazy.input.area>
                        <div class="dropdown-divider mt-3 mb-3"></div>
                        <div class="text-right">
                            <button class="btn my-button my-rounded pl-3 pr-3"><i class="fa fa-send-o mr-2"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
