@extends('dashboard.layouts.main')

@section('container')
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="col-span-3 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-72">
            @include('dashboard.anggaran.layouts.tabel_anggaran')
        </div>
        <div id="container-chart" class="col-span-1 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 p-4 md:p-6 2xl:p-8">
            @include('dashboard.anggaran.layouts.pie_chart_anggaran')
            {{-- <div id="main" class="w-full h-full pt-5"></div> --}}
        </div>
    </div>
{{-- @include('dashboard.anggaran.layouts.pie_chart_anggaran') --}}
<script src="js/pie_chart.js"></script>
<script src="js/pie_chart_flowbite.js"></script>
<script src="js/script.js"></script>
<script src="js/anggaran_transaksi_script.js"></script>
@endsection
