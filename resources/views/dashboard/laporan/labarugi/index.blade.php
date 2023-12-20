@extends('dashboard.layouts.main')

@section('container')
    <div class="flex flex-col lg:flex-row items-center justify-between mb-5">
        <h3 class="text-2xl xl:text-3xl font-bold text-gray-800 mt-5 mb-3">Laporan Laba Rugi {{($bulan != null) ? 'Periode ' .$bulan : 'Semua Periode'}}</h3>
        <div class="flex items-center space-x-3 w-full md:w-auto">
            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button">
                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
                Actions
            </button>
            <div id="actionsDropdown"
                class="hidden z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="actionsDropdownButton">
                    @if (auth()->user()->can('cetak labarugi'))
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkPrint" href="/pdf_laba_rugi/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Print</a>
                                </li>
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkExcel" href="/laba_rugi_xlsx/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                        to excel</a>
                                </li>
                                @else
                                <li class="hidden" onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkPrint" href="/pdf_laba_rugi/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Print</a>
                                </li>
                                <li class="hidden" onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkExcel" href="/laba_rugi_xlsx/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                        to excel</a>
                                </li>
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="" href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Print</a>
                                </li>
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="" href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                        to excel</a>
                                </li>
                                @endif
                </ul>
            </div>

            <button id="actionsDropdownButton" data-dropdown-toggle="periodeDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button">
                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
                Periode
            </button>
            <div id="periodeDropdown"
                class="hidden z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="actionsDropdownButton">
                    <li id="filterKategori" data-id-2="1" data-id="all">
                        <a href="/laba_rugi/?id=all"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                    </li>
                    @foreach ($dataBulan as $item)
                    <li id="filterKategori" data-id-2="1"
                        data-id="{{$item->id_bulan}}">
                        <a href="/laba_rugi/?id={{$item->id_bulan}}"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$item->bulan_transaksi}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-md my-5 shadow-md text-2xl lg:text-3xl font-semibold">
        <p id="jumlah-transaksi-laporan">Rp {{number_format($labaRugi[0]->saldo, 0, ',', '.')}}</p>
        <p class="text-gray-500 text-sm font-medium mt-1">Laba rugi</p>
    </div>

    @include('dashboard.laporan.labarugi.layouts.tabel')
@endsection
