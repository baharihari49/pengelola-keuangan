@extends('dashboard.layouts.main')

@section('container')
<div class="grid grid-cols-1 grid-cols-2 lg:grid-cols-4 gap-2 xl:gap-4 mb-4">
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z"/>
                    <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z"/>
                  </svg>
                <div class="flex items-center xl:gap-1">
                    <p class="text-green-500 text-xs xl:text-base font-semibold">0%</p>
                    <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp {{number_format($saldo[0]->saldo, 0, ',', '.')}}</p>
            <p class="text-gray-500 text-xs xl:text-sm font-bold">Saldo</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                
                <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M18 0H6a2 2 0 0 0-2 2h10a4 4 0 0 1 4 4v6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Z"/>
                    <path d="M14 16H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2Z"/>
                    <path d="M8 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm0-4a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z"/>
                  </svg>
                <div class="flex items-center xl:gap-1">
                    <p class="text-green-500 text-xs xl:text-base font-semibold">0%</p>
                    <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp {{
                number_format($pendapatan, 0, ',', '.')
            }}</p>            
            <p class="text-gray-500 text-xs xl:text-sm font-bold">Pendapatan</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                  <svg class="w-5 h-5 md:w-6 md:h-6 text-violet-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 18">
                    <path d="M8 18A18.55 18.55 0 0 1 0 3l8-3 8 3a18.549 18.549 0 0 1-8 15Z"/>
                  </svg>
                  <div class="flex items-center xl:gap-1">
                    <p class="text-green-500 text-xs xl:text-base font-semibold">0%</p>
                    <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                   
                </div>
            </div>
            <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp {{number_format($jumlahTabungan, 0, ',', '.')}}</p>
            <p class="text-gray-500 text-xs xl:text-sm font-bold">Tabungan</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                  </svg>
                <div class="flex items-center xl:gap-1">
                    <p class="text-red-500 text-xs xl:text-base font-semibold">%</p>
                    <svg class="w-3 h-3 xl:w-4 xl:h-4 text-red-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp {{
                number_format($pengeluaran, 0, ',', '.')
            }}</p>  
            <p class="text-gray-500 text-xs xl:text-sm font-bold">Pengeluaran</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-bold">Kebutuhan</h5>
            </div>
            <div class="">
                @php $hasKebutuhan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                    @if ($item['nama'] === 'kebutuhan')
                        @php $hasKebutuhan = true; @endphp
                        <div class="flex justify-between items-center">
                            <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                            <span class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'kebutuhan') ? $getBudgeting[$index]->value : 0}}%</span>
                        </div>
                        @php
                            $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'kebutuhan');
                            $persentase = $persentase ? round($persentase['persentase']) : 0;
                        @endphp
            
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                        </div>
                    @endif
                @endforeach
            
                @if (!$hasKebutuhan)
                <div id="btn_modal" data-budget="keinginan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-semibold">Keinginan</h5>
            </div>
            <div class="">
                @php $hasKeinginan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                    @if ($item['nama'] === 'keinginan')
                        @php $hasKeinginan = true; @endphp
                        <div class="flex justify-between items-center">
                            <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                            <span class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'keinginan') ? $getBudgeting[$index]->value : 0}}%</span>
                        </div>
                        @php
                            $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'keinginan');
                            $persentase = $persentase ? round($persentase['persentase']) : 0;
                        @endphp
            
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                        </div>
                    @endif
                @endforeach
            
                @if (!$hasKeinginan)
                <div id="btn_modal" data-budget="keinginan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-semibold">Tabungan</h5>
            </div>
            <div class="">
                @php $hasTabungan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                    @if ($item['nama'] === 'tabungan')
                        @php $hasTabungan = true; @endphp
                        <div class="flex justify-between items-center">
                            <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                            <span class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'tabungan') ? $getBudgeting[$index]->value : 0}}%</span>
                        </div>
                        @php
                            $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'tabungan');
                            $persentase = $persentase ? round($persentase['persentase']) : 0;
                        @endphp
            
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                style="width:{{ round($persentaseTabungan) }}%">{{ round($persentaseTabungan) }}%</div>
                        </div>
                    @endif
                @endforeach
            
                @if (!$hasTabungan)
                <div id="btn_modal" data-budget="keinginan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow-md p-0 rounded-lg lg:col-span-2 border-gray-300 dark:border-gray-600 h-max">
        @include('dashboard.charts.line_chart')
    </div>
    <div class="bg-white shadow-md relative p-0 rounded-lg lg:col-span-1 border-gray-300 dark:border-gray-600 max-h-max xl:h">
        <div class="py-2">
            <p class="font-semibold text-lg lg:text-xl p-2 text-gray-700">Transaksi terkini</p>
            @include('dashboard.transaksi_terkini')
            <div
            class="grid grid-cols-1 bottom-0 left-0 w-full absolute items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
            <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdownTransaksi"
                    data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    Today
                    <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdownTransaksi"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <button id="btn-days-dropdown" class="block px-4 py-2 w-full text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</button> 
                        </li>
                        <li>
                            <button id="btn-days-dropdown" class="block px-4 py-2 w-full text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</button>
                        </li>
                    </ul>
                </div>
                <a href="/transaksi"
                    class="uppercase text-xs lg:text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Full Report
                    <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
    <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white shadow-md rounded-lg p-3">
            <h5 class="font-semibold text-gray-700 text-xl mb-4 mt-2">Top Pengeluaran</h5>
            @include('dashboard.top_pengeluaran')
        </div>

        <div class="bg-white shadow-md rounded-lg p-5">
            @include( 'dashboard.charts.donut_chart_transaksi_pendapatan_pengeluaran')
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-5">
            @include( 'dashboard.charts.pie_chart_budgeting')
        </div>

        <div class="bg-white shadow-md rounded-lg p-5">
            @include( 'dashboard.charts.pie_chart_transaksi_anggaran')
        </div>
    </div>
    <div class="col-span-2 md:col-span-1 w-full">
        <div class="bg-white shadow-md rounded-lg p-5">
            @include('dashboard.charts.pie_chart_anggaran')
        </div>
    </div>
</div>


<script src="js/donut_chart_transaksi_pendapatan_pengeluaran.js"></script>
<script src="js/line_chart_script.js"></script>
<script src="js/dashboard_script.js"></script>
<script src="js/pie_chart_flowbite.js"></script>
<script src="js/pie_chart_transaksi_anggaran.js"></script>
<script src="js/charts/pie_chart_budgeting.js"></script>
@endsection