{{-- <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800"> --}}
<div class="flex justify-between p-3 md:p-6 pb-0 md:pb-0">
    <div>
        <p class="text-sm lg:text-base font-normal text-gray-500 dark:text-gray-400">Pendapatan bulan ini</p>
        <h5 class="leading-none text-xl lg:text-3xl font-bold text-gray-900 dark:text-white pb-2">Rp
            {{ number_format($pendapatan_bulan_ini, 0, ',', '.') }}
        </h5>
    </div>
    <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
        @if ($persentasePerbandingan['persentaseSelisihPendapatBulanBerjalan'] > 0)
            <div class="flex items-center xl:gap-1">
                <p class="text-green-500 text-xs xl:text-base font-semibold">
                    {{ $persentasePerbandingan['persentaseSelisihPendapatBulanBerjalan'] }}%</p>
                <svg class="w-3 h-3 xl:w-4 xl:h-4 text-green-500 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13V1m0 0L1 5m4-4 4 4" />
                </svg>
            </div>
        @elseif ($persentasePerbandingan['persentaseSelisihPendapatBulanBerjalan'] < 0)
            <div class="flex items-center xl:gap-1">
                <p class="text-red-500 text-xs xl:text-base font-semibold">
                    {{ $persentasePerbandingan['persentaseSelisihPendapatBulanBerjalan'] }}%</p>
                <svg class="w-3 h-3 text-red-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 14">
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
</div>
<div id="labels-chart" class="px-2.5"></div>
<div
    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
    <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
            type="button">
            Last 30 days
        </button>
        <a aria-disabled="true" href="/pemasukan"
            class="uppercase text-xs lg:text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
            Laporan Detail
            <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
        </a>
    </div>
</div>
{{-- </div> --}}
