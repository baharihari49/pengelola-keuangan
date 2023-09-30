@extends('dashboard.layouts.main')

@section('container')
    <div class='mb-5'>
       <h1 class="text-xl xl:text-3xl font-semibold">Laporan Keuangan Bulan Agustus 2023</h1>
    </div>

    <div id="tabel" class="bg-white p-3 rounded-lg shadow-md mb-5">
        <h2 class="text-2xl mb-3 font-semibold">Pemasukan</h2>
        @include('dashboard.laporan.layouts.tabel_pemasukan')
    </div>

    <div id="tabel" class="bg-white p-3 rounded-lg shadow-md mb-5">
        <h2 class="text-2xl mb-3 font-semibold">Pengeluaran</h2>
        @include('dashboard.laporan.layouts.tabel_pengeluaran')
    </div>

    <div id="tabel" class="bg-white p-3 rounded-lg shadow-md">
        <h2 class="text-2xl mb-3 font-semibold">Tabungan</h2>
        @include('dashboard.laporan.layouts.tabel_tabungan')
    </div>
@endsection