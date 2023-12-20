@extends('dashboard.layouts.main')


@section('container')
<h1 class="text-2xl lg:text-3xl my-5 font-bold text-gray-800">Laporan Pengeluaran</h1>
<div class="bg-white p-5 rounded-md my-5 shadow-md text-2xl lg:text-3xl font-semibold">
    <p id="jumlah-transaksi-laporan">Rp {{number_format($pengeluaran, 0, ',', '.')}}</p >
    <p class="text-gray-500 text-sm font-medium mt-1">Total Pengeluaran</p>
</div>

@include('dashboard.laporan.pengeluaran.layouts.container_laporan_pengeluaran')

<script src="./js/laporan/pemasukan&pengeluaran.js"></script>
@endsection
