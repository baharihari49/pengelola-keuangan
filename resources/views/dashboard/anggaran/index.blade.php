@extends('dashboard.layouts.main')
@section('container')
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
                    <h5 class="font-bold text-lg xl:text-2xl mt-1 mb-3 text-gray-600">Rp
                        {{number_format($item['jumlah'], 0, ',','.')}}</h5>
                    <span
                        class="font-bold text-lg xl:text-3xl text-blue-800">{{(isset($getBudgeting[0]) && $getBudgeting[$index]->nama == 'tabungan') ? $getBudgeting[$index]->value : 0}}%</span>
                </div>
                @php
                $persentase = collect($persentaseBudgeting)->firstWhere('nama', 'tabungan');
                $persentase = $persentase ? round($persentase['persentase']) : 0;
                @endphp

                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 {{ $persentase < 0 ? 'hidden' : 'flex' }}">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                        style="width:{{ $persentase }}%">{{ $persentase }}%</div>
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
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
    <div class="col-span-3 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-72">
        @include('dashboard.anggaran.layouts.tabel_anggaran')
    </div>
    <div id="container-chart"
        class="col-span-3 md:col-span-1 bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 p-4 md:p-6 2xl:p-8">
        @include('dashboard.anggaran.layouts.charts.pie_chart_anggaran')
    </div>
</div>


<div id="modalBackdrop" modal-backdrop=""
    class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40 hidden"></div>
{{-- @include('dashboard.anggaran.layouts.pie_chart_anggaran') --}}
@include('dashboard.anggaran.layouts.create_budget')
<script src="js/request_ajax.js"></script>
<script src="js/pie_chart.js"></script>
<script src="js/pie_chart_flowbite.js"></script>
<script src="js/script.js"></script>
<script src="js/anggaran/create_budget.js"></script>
<script src="js/anggaran_transaksi_script.js"></script>
<script src="js/anggaran/donut_budgeting_kebutuhan.js"></script>
<script src="js/anggaran/pie_chart_budgeting_kebutuhan.js"></script>
<script src="js/anggaran/edit_budget.js"></script>
@endsection
