@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('alert'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Mohon Lengkapi Profile Anda</span>
            </div>
        </div>
    @endif

    @if (session()->has('free'))
        <div id="alert-additional-content-1"
            class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">Anda menggunakan layanan uji coba</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                Untuk mendapatkan keuntungan yang lebih baik silahkan berlangganan
            </div>
            <div class="flex">
                <a href="/create_payment" type="button"
                    class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Berlangganan sekarang
                </a>
                <button type="button"
                    class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                    data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                    Nanti aja
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('expired'))
        <div id="alert-additional-content-1"
            class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">Langganan Expired</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                Untuk mendapatkan keuntungan yang lebih baik silahkan berlangganan
            </div>
            <div class="flex">
                <a href="/create_payment" type="button"
                    class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Berlangganan sekarang
                </a>
                <button type="button"
                    class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-red-600 dark:border-red-600 dark:text-red-400 dark:hover:text-white dark:focus:ring-red-800"
                    data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                    Nanti aja
                </button>
            </div>
        </div>
    @endif

    <div class="mb-5 p-5 bg-white rounded-md shadow-md">
        <p class="text-gray-800 text-xl lg:text-3xl font-bold">Selamat {{ $day }},
            {{ $user->nama ?? $user->username }}!</p>
        <p class="text-gray-600 mt-1 text-xs md:text-sm">{{ $date . ', ' . $time }}</p>
    </div>
    <div style="margin: 30px 0 30px 0">
        <p class="text-gray-800 text-xl lg:text-3xl font-bold">Ringkasan Keseluruhan</p>
    </div>
    <div class="grid grid-cols-1 grid-cols-2 lg:grid-cols-4 gap-2 xl:gap-4 mb-4">
        <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
            <div class="w-full">
                <div class="flex w-full justify-between items-center">

                    <svg class="w-5 h-5 text-green-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1v14h16M4 10l3-4 4 4 5-5m0 0h-3.207M16 5v3.207" />
                    </svg>
                    @if ($persentasePerbandingan['persentaseSelisihPendapatan'] > 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-green-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihPendapatan'] }}%</p>
                            <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    @elseif ($persentasePerbandingan['persentaseSelisihPendapatan'] < 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-red-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihPendapatan'] }}%</p>
                            <svg class="w-3 h-3 text-red-500 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 1v12m0 0 4-4m-4 4L1 9" />
                            </svg>
                        </div>
                    @else
                        <div class="flex items-center xl:gap-1">
                            <p class="text-gray-500 text-xs xl:text-base font-semibold">
                                0%</p>
                        </div>
                    @endif
                </div>
                <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp
                    {{ number_format($pendapatan, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-xs xl:text-sm font-reguler">Total Pendapatan</p>
            </div>
        </div>
        <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
            <div class="w-full">
                <div class="flex w-full justify-between items-center">
                    <svg class="w-5 h-5 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1v14h16M4 5l3 4 4-4 5 5m0 0h-3.207M16 10V6.793" />
                    </svg>
                    @if ($persentasePerbandingan['persentaseSelisihPengeluaran'] > 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-green-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihPengeluaran'] }}%</p>
                            <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    @elseif ($persentasePerbandingan['persentaseSelisihPengeluaran'] < 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-red-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihPengeluaran'] }}%</p>
                            <svg class="w-3 h-3 text-red-500 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9" />
                            </svg>
                        </div>
                    @else
                        <div class="flex items-center xl:gap-1">
                            <p class="text-gray-500 text-xs xl:text-base font-semibold">
                                0%</p>
                        </div>
                    @endif
                </div>
                <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp
                    {{ number_format($pengeluaran, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-xs xl:text-sm font-reguler">Total Pengeluaran</p>
            </div>
        </div>
        <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
            <div class="w-full">
                <div class="flex w-full justify-between items-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
                    </svg>
                    @if ($persentasePerbandingan['persentaseSelisihSaldo'] > 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-green-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihSaldo'] }}%</p>
                            <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    @elseif ($persentasePerbandingan['persentaseSelisihSaldo'] < 0)
                        <div class="flex items-center xl:gap-1">
                            <p class="text-red-500 text-xs xl:text-base font-semibold">
                                {{ $persentasePerbandingan['persentaseSelisihSaldo'] }}%</p>
                            <svg class="w-3 h-3 text-red-500 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9" />
                            </svg>
                        </div>
                    @else
                        <div class="flex items-center xl:gap-1">
                            <p class="text-gray-500 text-xs xl:text-base font-semibold">
                                0%</p>
                        </div>
                    @endif
                </div>
                <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp
                    {{ number_format($saldo[0]->saldo, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-xs xl:text-sm font-reguler">Saldo</p>
            </div>
        </div>
        <div class="bg-white shadow-md border-gray-300 rounded-lg dark:border-gray-600 flex items-center p-3 xl:p-5">
            <div class="w-full">
                <div class="flex w-full justify-between items-center">
                    <svg class="w-5 h-5 text-violet-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M1 10c1.5 1.5 5.25 3 9 3s7.5-1.5 9-3m-9-1h.01M2 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1ZM14 5V3a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v2h8Z" />
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
                <p class="mt-3 mb-1 text-md xl:text-2xl 2xl:text-3xl font-bold">Rp
                    {{ number_format($jumlahTabungan, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-xs xl:text-sm font-reguler">Tabungan</p>
            </div>
        </div>
    </div>




    {{-- Analisa bulan ini --}}




    <div style="margin: 30px 0 30px 0">
        <p class="text-gray-800 text-xl lg:text-3xl font-bold">Analisa Bulan Ini</p>
        <p class="text-gray-600 mt-1 text-xs md:text-sm">{{ Date('01 F Y') }} -
            {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>


    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
        <div class="bg-white shadow-md rounded-lg p-5" id="transaksiBulanan">
            @include('dashboard.charts.donut_chart_transaksi_pendapatan_pengeluaran')
        </div>
        <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
            @include('dashboard.charts.pie_chart_budgeting')
        </div>
        <div class="bg-white shadow-md h-fit rounded-lg border-gray-300 p-3 xl:p-5">
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <h5 class="text-base xl:text-xl font-reguler">Anggaran kebutuhan</h5>
                </div>
                <div class="">
                    @php $hasKebutuhan = false; @endphp
                    @foreach ($dataBudgeting as $index => $item)
                        @if ($item['nama'] === 'kebutuhan')
                            @php $hasKebutuhan = true; @endphp
                            <div class="flex justify-between items-center">
                                <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-900">Rp
                                    {{ number_format($item['jumlah'], 0, ',', '.') }}</h5>
                                <span
                                    class="font-bold text-lg xl:text-3xl text-[#9345A3]">{{ isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'kebutuhan' ? $getBudgeting[$index]->value : 0 }}%</span>
                            </div>
                            @php
                                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'kebutuhan');
                                $persentase = $persentase ? round($persentase['persentase']) : 0;
                            @endphp

                            <div
                                class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                                <div class="bg-[#9345A3] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                    style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                            </div>
                        @endif
                    @endforeach

                    @if (!$hasKebutuhan)
                        <div id="btn_modal" data-budget="keinginan"
                            class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                            <div class="p-6">
                                <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <h5 class="text-base xl:text-xl font-reguler">Anggaran keinginan</h5>
                </div>
                <div class="">
                    @php $hasKeinginan = false; @endphp
                    @foreach ($dataBudgeting as $index => $item)
                        @if ($item['nama'] === 'keinginan')
                            @php $hasKeinginan = true; @endphp
                            <div class="flex justify-between items-center">
                                <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-900">Rp
                                    {{ number_format($item['jumlah'], 0, ',', '.') }}</h5>
                                <span
                                    class="font-bold text-lg xl:text-3xl text-[#9345A3]">{{ isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'keinginan' ? $getBudgeting[$index]->value : 0 }}%</span>
                            </div>
                            @php
                                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'keinginan');
                                $persentase = $persentase ? round($persentase['persentase']) : 0;
                            @endphp

                            <div
                                class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                                <div class="bg-[#9345A3] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                    style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                            </div>
                        @endif
                    @endforeach

                    @if (!$hasKeinginan)
                        <div id="btn_modal" data-budget="keinginan"
                            class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                            <div class="p-6">
                                <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <h5 class="text-base xl:text-xl font-reguler">Perkiraan tabungan</h5>
                </div>
                <div class="">
                    @php $hasTabungan = false; @endphp
                    @foreach ($dataBudgeting as $index => $item)
                        @if ($item['nama'] === 'tabungan')
                            @php $hasTabungan = true; @endphp
                            <div class="flex justify-between items-center">
                                <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-900">Rp
                                    {{ number_format($item['jumlah'], 0, ',', '.') }}</h5>
                                <span
                                    class="font-bold text-lg xl:text-3xl text-[#9345A3]">{{ isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'tabungan' ? $getBudgeting[$index]->value : 0 }}%</span>
                            </div>
                            @php
                                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'tabungan');
                                $persentase = $persentase ? round($persentase['persentase']) : 0;
                            @endphp

                            <div
                                class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                                <div class="bg-[#9345A3] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                    style="width:{{ round($persentaseTabungan) }}%">{{ round($persentaseTabungan) }}%
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if (!$hasTabungan)
                        <div id="btn_modal" data-budget="keinginan"
                            class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                            <div class="p-6">
                                <span class="text-sm text-gray-600">Anda belum menambahkan budgeting</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-32">
        <div class="bg-white shadow-md p-0 rounded-lg lg:col-span-2 border-gray-300 dark:border-gray-600 h-max">
            @include('dashboard.charts.line_chart')
        </div>
        <div class="bg-white h-fit shadow-md lg:col-span-1 rounded-lg p-3">
            <h5 class="font-bold text-gray-700 text-xl mb-4 mt-2">Pengeluaran terbanyak</h5>
            @include('dashboard.top_pengeluaran')
        </div>

        <div
            class="bg-white shadow-md relative p-0 rounded-lg lg:col-span-1 border-gray-300 dark:border-gray-600 max-h-max xl:h">
            <div class="py-2">
                <p class="font-bold text-lg lg:text-xl p-2 text-gray-700">Transaksi minggu ini
                </p>
                @include('dashboard.transaksi_terkini')
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
