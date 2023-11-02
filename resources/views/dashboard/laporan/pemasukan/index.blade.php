@extends('dashboard.layouts.main')


@section('container')
<h1 class="text-3xl my-5 font-bold text-gray-800">Laporan Pemasukan</h1>
<div class="bg-white p-5 rounded-md my-5 shadow-md text-3xl font-semibold">
    <span>Rp {{number_format($pemasukan, 0, ',', '.')}}</span>
    <p class="text-gray-500 text-sm font-medium mt-1">Total Pemasukan</p>
</div>
<div class="bg-white overflow-x-auto shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-32 lg:mb-24">
    @include('dashboard.laporan.pemasukan.layouts.container_laporan_pemasukan')
</div>

<script src="./js/laporan/pemasukan.js"></script>
@endsection