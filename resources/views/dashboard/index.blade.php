@extends('dashboard.layouts.main')

@section('container')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 h-40 flex items-center px-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-6 h-6 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
                </svg>
                <div class="flex items-center gap-1">
                    <p class="text-green-500 font-semibold">10.2%</p>
                    <svg class="w-4 h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-3xl font-bold">Rp {{number_format($saldo[0]->saldo, 0, ',', '.')}}</p>
            <p class="text-gray-500 text-sm font-bold">Saldo</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 h-40 flex items-center px-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-8 h-8 text-green-500  dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 11 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1.75 15.363a4.954 4.954 0 0 0 2.638 1.574c2.345.572 4.653-.434 5.155-2.247.502-1.813-1.313-3.79-3.657-4.364-2.344-.574-4.16-2.551-3.658-4.364.502-1.813 2.81-2.818 5.155-2.246A4.97 4.97 0 0 1 10 5.264M6 17.097v1.82m0-17.5v2.138" />
                </svg>
                <div class="flex items-center gap-1">
                    <p class="text-green-500 font-semibold">10.2%</p>
                    <svg class="w-4 h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-3xl font-bold">Rp {{
                (isset($pendapatanDanPengeluaran[0])) ? number_format($pendapatanDanPengeluaran[0]->saldo, 0, ',', '.') : 0
            }}</p>            
            <p class="text-gray-500 text-sm font-bold">Pendapatan</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 h-40 flex items-center px-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-6 h-6 text-violet-600 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2 19h16m-8 0V5m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM4 8l-2.493 5.649A1 1 0 0 0 2.443 15h3.114a1.001 1.001 0 0 0 .936-1.351L4 8Zm0 0V6m12 2-2.493 5.649A1 1 0 0 0 14.443 15h3.114a1.001 1.001 0 0 0 .936-1.351L16 8Zm0 0V6m-4-2.8c3.073.661 3.467 2.8 6 2.8M2 6c3.359 0 3.192-2.115 6.012-2.793" />
                </svg>
                <div class="flex items-center gap-1">
                    <p class="text-green-500 font-semibold">10.2%</p>
                    <svg class="w-4 h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-3xl font-bold">Rp {{number_format($jumlahAnggaran, 0, ',', '.')}}</p>
            <p class="text-gray-500 text-sm font-bold">Anggaran</p>
        </div>
    </div>
    <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 h-40 flex items-center px-5">
        <div class="w-full">
            <div class="flex w-full justify-between items-center">
                <svg class="w-6 h-6 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z" />
                </svg>
                <div class="flex items-center gap-1">
                    <p class="text-red-500 font-semibold">10.2%</p>
                    <svg class="w-4 h-4 text-red-500 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 mb-1 text-3xl font-bold">Rp {{
                (isset($pendapatanDanPengeluaran[1])) ? number_format($pendapatanDanPengeluaran[1]->saldo, 0, ',', '.') : 0
            }}</p>  
            <p class="text-gray-500 text-sm font-bold">Pengeluaran</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-4">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-xl font-semibold">Kebutuhan</h5>
                <span class="font-bold text-3xl text-blue-800">{{(isset($getBudgeting[0])) ? $getBudgeting[0]->value : 0}}%</span>
            </div>
            @if (count($dataBudgeting) > 0)
                <div class="">
                    @foreach ($dataBudgeting as $index => $item)
                        @if ($item['nama'] === 'kebutuhan')
                        <h5 class="font-bold text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                        @endif
                    @endforeach
                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{(isset($persentaseBudgeting[0]) && $persentaseBudgeting[0]['persentase'] < 0) ? 'hidden' : 'flex'}}">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{isset($persentaseBudgeting[0]) ? round($persentaseBudgeting[0]['persentase']) : 0}}%">{{isset($persentaseBudgeting[0]) ? round($persentaseBudgeting[0]['persentase']) : 0}}%</div>
                    </div>
                </div>

            @else
            <button id="btn_modal" data-budget="kebutuhan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                <div class="border-2 p-6 rounded-full border-dashed">
                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </div>
            </button>             
            @endif
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-xl font-semibold">Keinginan</h5>
                <span class="font-bold text-3xl text-purple-800">{{(isset($getBudgeting[1])) ? $getBudgeting[1]->value : 0}}%</span>
            </div>
            @if (count($dataBudgeting) > 1)
            <div class="">
                @foreach ($dataBudgeting as $index => $item)
                    @if ($item['nama'] === 'keinginan')
                    <h5 class="font-bold text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                    @endif
                @endforeach
                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{(isset($persentaseBudgeting[1]) && $persentaseBudgeting[1]['persentase'] < 0) ? 'hidden' : 'flex'}}">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{isset($persentaseBudgeting[1]) ? round($persentaseBudgeting[1]['persentase']) : 0}}%">{{isset($persentaseBudgeting[1]) ? round($persentaseBudgeting[1]['persentase']) : 0}}%</div>
                </div>
            </div>

        @else
        <button id="btn_modal" data-budget="keinginan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
            <div class="border-2 p-6 rounded-full border-dashed">
                <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </div>
        </button>             
        @endif
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-xl font-semibold">Tabungan</h5>
                <span class="font-bold text-3xl text-green-700">{{(isset($getBudgeting[2])) ? $getBudgeting[2]->value : 0}}%</span>
            </div>
            @if (count($dataBudgeting) > 2)
                <div class="">
                    @foreach ($dataBudgeting as $index => $item)
                        @if ($item['nama'] === 'tabungan')
                        <h5 class="font-bold text-2xl mt-1 mb-3 text-gray-600">Rp {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                        @endif
                    @endforeach
                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{(isset($persentaseBudgeting[2]) && $persentaseBudgeting[2]['persentase'] < 0) ? 'hidden' : 'flex'}}">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{isset($persentaseBudgeting[2]) ? round($persentaseBudgeting[2]['persentase']) : 0}}%">{{isset($persentaseBudgeting[2]) ? round($persentaseBudgeting[2]['persentase']) : 0}}%</div>
                    </div>
                </div>

            @else
            <button id="btn_modal" data-budget="tabungan" class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                <div class="border-2 p-6 rounded-full border-dashed">
                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </div>
            </button>             
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow-md p-0 rounded-lg lg:col-span-2 border-gray-300 dark:border-gray-600 h-max">
        @include('dashboard.charts.line_chart')
    </div>
    <div class="bg-white relative shadow-md p-2 rounded-lg border-gray-300">
        <div class="py-2">
            <p class="font-semibold text-xl p-2 text-gray-700">Transaksi terkini</p>
        </div>
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
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
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

<div class="grid grid-cols-3 gap-4">
    <div class="col-span-2 grid grid-cols-2 gap-4">

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
    <div class="col-span-1">
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