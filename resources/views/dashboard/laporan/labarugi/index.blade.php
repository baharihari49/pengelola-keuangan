@extends('dashboard.layouts.main')

@section('container')
    <h3 class="text-3xl font-bold text-gray-800 my-5">Laporan Laba Rugi</h3>
    @include('dashboard.laporan.labarugi.layouts.tabel')
@endsection