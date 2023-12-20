@extends('dashboard.layouts.main')
@section('container')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-bold">Kebutuhan</h5>
                 @foreach($dataBudgeting as $item)
                 @if ($item['nama'] === 'kebutuhan')
                    <button data-budget="kebutuhan" class="btnEditBudget">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @else
                    <button data-budget="kebutuhan" class="btnEditBudget hidden">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @endif
                 @endforeach

            </div>
            <div class="">
                @php $hasKebutuhan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                @if ($item['nama'] === 'kebutuhan')
                @php $hasKebutuhan = true; @endphp
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp
                        {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                    <span
                        class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'kebutuhan') ? $getBudgeting[$index]->value : 0}}%</span>
                </div>
                @php
                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'kebutuhan');
                $persentase = $persentase ? round($persentase['persentase']) : 0;
                @endphp

                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                        style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                </div>
                @endif
                @endforeach

                @if (!$hasKebutuhan)
                @if (auth()->user()->can('tambah anggaran'))
                    <div id="btn_modal" data-budget="kebutuhan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @else
                    <div data-budget="kebutuhan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-semibold">Keinginan</h5>
                @foreach($dataBudgeting as $item)
                 @if ($item['nama'] === 'keinginan')
                    <button data-budget="keinginan" class="btnEditBudget">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @else
                    <button data-budget="keinginan" class="btnEditBudget hidden">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @endif
                 @endforeach
            </div>
            <div class="">
                @php $hasKeinginan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                @if ($item['nama'] === 'keinginan')
                @php $hasKeinginan = true; @endphp
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp
                        {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                    <span
                        class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'keinginan') ? $getBudgeting[$index]->value : 0}}%</span>
                </div>
                @php
                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'keinginan');
                $persentase = $persentase ? round($persentase['persentase']) : 0;
                @endphp

                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                        style="width:{{ $persentase }}%">{{ $persentase }}%</div>
                </div>
                @endif
                @endforeach

                @if (!$hasKeinginan)
                @if (auth()->user()->can('tambah anggaran'))
                    <div id="btn_modal" data-budget="keinginan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @else
                    <div data-budget="keinginan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg border-gray-300 p-3 xl:p-5">
        <div>
            <div class="flex justify-between items-center">
                <h5 class="text-base xl:text-xl font-semibold">Tabungan</h5>
                @foreach($dataBudgeting as $item)
                 @if ($item['nama'] === 'tabungan')
                    <button data-budget="tabungan" class="btnEditBudget">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @else
                    <button data-budget="tabungan" class="btnEditBudget hidden">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    </button>
                 @endif
                 @endforeach
            </div>
            <div class="">
                @php $hasTabungan = false; @endphp
                @foreach ($dataBudgeting as $index => $item)
                @if ($item['nama'] === 'tabungan')
                @php $hasTabungan = true; @endphp
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp
                        {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                    <span
                        class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'tabungan') ? $getBudgeting[$index]->value : 0}}%</span>
                </div>
                {{-- @php
                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'tabungan');
                $persentase = $persentase ? round($persentase['persentase']) : 0;
                @endphp --}}

                <div
                    class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ (isset($persentase) ? $persentase < 0 ? 'hidden' : 'flex' : 0) }}">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                        style="width:{{ round($persentaseTabungan) }}%">{{ round($persentaseTabungan) }}%</div>
                </div>
                @endif
                @endforeach

                @if (!$hasTabungan)
                @if (auth()->user()->can('tambah anggaran'))
                    <div id="btn_modal" data-budget="tabungan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @else
                    <div data-budget="tabungan"
                    class="h-[85%] w-full hover:bg-gray-100 flex items-center justify-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-600">Klik untuk menambahkan budgeting</span>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-28 h-max border">
    {{-- <div class="col-span-3 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-72"> --}}
        @include('dashboard.anggaran.layouts.tabel_anggaran_kebutuhan')
        @include('dashboard.anggaran.layouts.tabel_anggaran_keinginan')
    {{-- </div> --}}
    {{-- <div id="container-chart h-fit"
        class="col-span-3 md:col-span-1 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 p-4 md:p-6 2xl:p-8">
        @include('dashboard.anggaran.layouts.charts.pie_chart_anggaran')
    </div> --}}
</div>


<div id="modalBackdrop" modal-backdrop=""
    class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40 hidden"></div>
{{-- @include('dashboard.anggaran.layouts.pie_chart_anggaran') --}}
@include('dashboard.anggaran.layouts.create_budget')
<script src="js/request_ajax.js"></script>
<script src="js/pie_chart_flowbite.js"></script>
{{-- <script src="js/script.js"></script> --}}
<script src="js/anggaran/create_budget.js"></script>
<script src="js/anggaran_transaksi_script.js"></script>
<script src="js/anggaran/donut_budgeting_kebutuhan.js"></script>
<script src="js/anggaran/pie_chart_budgeting_kebutuhan.js"></script>
<script src="js/anggaran/edit_budget.js"></script>
@endsection
