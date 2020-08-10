<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset ('/adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/style/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/sweetalert/sweetalert2.css') }}">
    <script src="{{ asset('/sweetalert/sweetalert2.js') }}"></script>
    @yield('css')
</head>
<body>

<x-sidebar>
    <x-slot name="brand">
        SISTEM REKAM MEDIS
    </x-slot>
    <x-slot name="menu">
        <x-sidebar-item url="/admin" title="Dashboard" faIcon="fa fa-tachometer"/>

        @if(auth()->user()->level == 'admin')
            <x-sidebar-item-tree title="Master" faIcon="fa fa-hdd-o" id="link-master">
                <x-sidebar-item url="/admin/admin" title="Admin" faIcon="fa fa-picture-o"
                                parentId="link-master"></x-sidebar-item>
                <x-sidebar-item url="/admin/pasien" title="Pasien" faIcon="fa fa-user-o" parentId="link-master"/>
                <x-sidebar-item url="/admin/dokter" title="Dokter" faIcon="fa fa-tags"
                                parentId="link-master"></x-sidebar-item>
                <x-sidebar-item url="/admin/spesialis" title="Spesialis" faIcon="fa fa-cube"
                                parentId="link-master"></x-sidebar-item>
                <x-sidebar-item url="/admin/obat" title="Obat" faIcon="fa fa-picture-o"
                                parentId="link-master"></x-sidebar-item>
            </x-sidebar-item-tree>
        @endif
        @if(auth()->user()->level != 'pasien')
            <li class="nav-header my-text-light">Transactions</li>
            <x-sidebar-item url="/admin/diagnosa" title="Diagnosa" faIcon="fa fa-shopping-bag"/>
            <x-sidebar-item url="/admin/resep" title="Resep" faIcon="fa fa-shopping-bag"/>
        @endif
        <li class="nav-header my-text-light">Laporan</li>
        @if(auth()->user()->level != 'pasien')
            <x-sidebar-item url="/admin/report/rekam-medis" title="Rekam Medis" faIcon="fa fa-circle-thin"
                            parentId="link-reports"/>
            <x-sidebar-item url="/admin/report/rekam-medis" title="Resep" faIcon="fa fa-circle-thin"
                            parentId="link-reports"/>
            <x-sidebar-item url="/admin/report/rekam-medis" title="Data Obat" faIcon="fa fa-circle-thin"
                            parentId="link-reports"/>
        @endif

        <li class="nav-header my-text-light">
            <div class="dropdown-divider"></div>
        </li>
        <x-sidebar-item url="/logout" title="Logout" faIcon="fa fa-power-off" parentId="link-reports"/>
    </x-slot>
</x-sidebar>

<div class="content-wrapper my-content-wrapper">
    <div class="d-lg-none d-xl-none">
        <a class="nav-link text-dark" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </div>
    <div class="my-content">
        <div class="my-content-title-wrapper">
            <div>@yield('content-title')</div>
        </div>
        @yield('breadcrumb')
        @yield('content')
    </div>
</div>
<script src="{{ asset('jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
<script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>
@yield('js')
@stack('addOn')
</body>
</html>
