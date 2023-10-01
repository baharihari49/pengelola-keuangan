@extends('dashboard.layouts.main')

@section('container')
    <div class='mb-5 flex justify-between'>
       <h1 class="text-xl xl:text-3xl font-semibold">Laporan Keuangan Bulan {{$bulanSaatIni[0]->bulan_transaksi}} 2023</h1>
       <div>

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-month" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Pilih bulan<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown-month" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                @foreach ($dataBulan as $item)
                    <li>
                        <a href="/laporan/?month={{$item->id_bulan}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$item->bulan_transaksi}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

       </div>
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