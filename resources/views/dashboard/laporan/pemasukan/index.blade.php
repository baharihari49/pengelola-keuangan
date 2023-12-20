@extends('dashboard.layouts.main')


@section('container')
<h1 class="text-2xl lg:text-3xl my-5 font-bold text-gray-800">Laporan Pemasukan</h1>
<div class="bg-white p-5 rounded-md my-5 shadow-md text-2xl lg:text-3xl font-semibold">
    <p id="jumlah-transaksi-laporan">Rp {{number_format($pemasukan, 0, ',', '.')}}</p>
    <p class="text-gray-500 text-sm font-medium mt-1">Total Pemasukan</p>
</div>

@include('dashboard.laporan.pemasukan.layouts.container_laporan_pemasukan')

<script src="./js/laporan/pemasukan&pengeluaran.js"></script>
@endsection
