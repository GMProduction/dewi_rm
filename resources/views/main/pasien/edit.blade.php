@extends('main.layouts')

@section('content-title')
    <div>
        <div class="f20 f-bold" style="letter-spacing: 1px;"><i class="fa fa-cube mr-2"></i>Pasien</div>
        <div class="my-text-semi-dark f14">Semua Data Pasien Di Rumah Sakit</div>
    </div>
@endsection

@section('breadcrumb')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/pasien">pasien</a></li>
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
                    <div class="card-title">Form Pasien</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/pasien/patch">
                        @csrf
                        <input name="id" type="hidden" value="{{ $pasien->user->id }}">
                        <x-lazy.input.text id="username" name="username" label="Username" value="{{ $pasien->user->username }}"/>
                        <x-lazy.input.text id="nama" name="nama" label="Nama Lengkap Pasien" value="{{ $pasien->nama }}"/>
                        <x-lazy.input.text id="tanggal" name="tanggal" label="Tanggal Lahir" type="date" value="{{ $pasien->tgl_lahir }}"/>
                        <x-lazy.input.area id="alamat" name="alamat" label="Alamat" value="{{ $pasien->alamat }}">{{ $pasien->alamat }}</x-lazy.input.area>
                        <x-lazy.input.select id="jenis_kelamin" name="jenis_kelamin" label="Jenis Kelamin">
                            <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : ''}}>Laki- Laki</option>
                            <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : ''}}>Perempuan</option>
                        </x-lazy.input.select>
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
