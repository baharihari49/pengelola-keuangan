@include('dashboard.transaksi.layouts.create_transaksi')
@include('dashboard.transaksi.layouts.update_transaksi')

<section class="">
    @if (session()->has('error'))
        <div id="modalError" tabindex="-1"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full flex"
            aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-md h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button onclick="hiddenModal()" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div
                        class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg class="w-6 h-6 text-red-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Anggaran anda telah terpenuhi
                    </p>
                    <button onclick="hiddenModal()" type="button"
                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900">
                        Continue
                    </button>
                </div>
            </div>
        </div>
        <div id="modal-backdrop" modal-backdrop=""
            class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
    @endif

    @if (session()->has('sucsess') || session()->has('succes_update'))
        <div id="modalError" tabindex="-1"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full flex"
            aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-md h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button onclick="hiddenModal()" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div
                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Transaksi anda berhasil
                        {{ session()->has('sucsess') ? 'dibuat' : 'diubah' }}</p>
                        <button data-modal-toggle="defaultModal" onclick="hiddenModal()" type="button"
                        class="py-2 px-3 text-sm font-medium text-center border-2 rounded-lg text-gray-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900 hover:text-white hover:border-none">
                        + Transaksi Lagi
                    </button>
                    <button onclick="hiddenModal()" type="button"
                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900">
                        Continue
                    </button>
                </div>
            </div>
        </div>
        <div id="modal-backdrop" modal-backdrop=""
            class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
    @endif


    <div class="mx-auto w-full">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">

                    <form>
                        <div class="flex">
                            <label for="search-dropdown"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                Email</label>
                            <button id="dropdown-button" data-dropdown-toggle="dropdown-search"
                                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                                type="button">Semua<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <div id="dropdown-search"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdown-button">
                                    <li>
                                        <button id="btn-dropdwon-child" type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</button>
                                    </li>
                                    <li>
                                        <button id="btn-dropdwon-child" type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kategori</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative w-full">
                                <input type="search" id="search-dropdown"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                    required>
                                <button type="submit"
                                    class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="filterTabel w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="addTransaksi" data-modal-toggle="defaultModal"
                        class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Transaksi
                    </button>


                    <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                            Tabel
                        </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownBgHoverButton">
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="checkbox-item-4" type="checkbox" value="kategori"
                                        class="filterTabel w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-item-4"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Kategori Transaksi</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="checkbox-item-5" type="checkbox" value="supplier"
                                        class="filterTabel w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-item-5"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Supplier/Customer</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="checkbox-item-6" type="checkbox" value="deskripsi"
                                        class="filterTabel w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-item-6"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Deskripsi</label>
                                </div>
                            </li>
                        </ul>
                    </div>



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
                        <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                            <a id="linkPrint" href="/pdf_transaksi_month/?id=all"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Print</a>
                        </li>
                        <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                            <a id="linkExcel" href="/transaksi_xlsx/?id=all"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to excel</a>
                        </li>
                    </ul>
                </div>

                <button id="periodeDropdownButton" data-dropdown-toggle="periodeDropdown"
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
                        aria-labelledby="periodeDropdownButton">
                        <li id="filterPeriode" data-id-2="1" data-id="0">
                            <a
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                        </li>
                        @foreach ($dataBulan as $item)
                        <li id="filterPeriode" data-id-2="1"
                            data-id="{{$item->id_bulan}}">
                            <a
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$item->bulan_transaksi}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <div class="">
                            <select id="select-transaksi"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <option selected value="all">Semua</option>
                                <option value="1">Pemasukan</option>
                                <option value="2">Pengeluaran</option>
                                <option value="3">Tabungan</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table
                    class="min-w-full w-max 2xl:w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-x-auto md:overflow-hidden">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            {{-- <th scope="col" class="px-4 py-3">No</th> --}}
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">No transaksi</th>
                            <th scope="col" class="px-4 py-3">Jenis Transaksi</th>
                            <th scope="col" id="tabel-heading-kategori" class="px-4 py-3 hidden">Kategori</th>
                            <th scope="col" id="tabel-heading-supplier" class="px-4 py-3 hidden">Customer/Supplier</th>
                            <th scope="col" id="tabel-heading-deskripsi" class="px-4 py-3 hidden">Deskripsi</th>
                            <th scope="col" class="px-4 py-3" align="right">Jumlah</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $t)
                            <tr id="tabel-row" class="border-b dark:border-gray-700">
                                <div id="container-tabel-date">
                                    {{-- <td class="px-4 py-3 w-3">
                                        {{ request()->page > 1 ? $index + request()->page * 15 - 14 : $index + 1 }}
                                    </td> --}}
                                    <th id="tabel-date" scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $t->tanggal }}</th>
                                    <td id="tabel-date" class="px-4 py-3">{{ $t->no_transaksi ?? '--' }}</td>
                                    <td id="tabel-date" class="px-4 py-3">
                                        @if ($t->jenis_transaksi->nama == 'Pemasukan')
                                            <div class="flex gap-2 items-center">
                                                <svg class="w-3 h-3 font-medium text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9"/>
                                                  </svg>
                                                    <span>Pemasukan</span>
                                            </div>
                                        @elseif ($t->jenis_transaksi->nama == 'Pengeluaran')
                                           <div class="flex gap-2 items-center">
                                            <svg class="w-3 h-3 text-red-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                                              </svg>
                                                    <span>Pengeluaran</span>
                                            </div>
                                        @elseif ($t->jenis_transaksi->nama == 'Tabungan')
                                             <div class="flex gap-2 items-center">
                                                <svg class="w-3 h-3 text-blue-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z"/>
                                                    <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z"/>
                                                  </svg>
                                                    <span>Tabungan</span>
                                            </div>
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td id="tabel-kategori" class="px-4 py-3 hidden">{{ $t->kategori_transaksi->nama ?? '--' }}
                                    </td>
                                    <td id="tabel-suppllier" class="px-4 py-3 hidden">
                                        {{ $t->suppliers_or_customers->nama_bisnis ?? '--' }}</td>
                                    <td id="tabel-deskripsi" class="px-4 py-3 max-w-sm hidden">{{ $t->deskripsi ?? '--' }}</td>
                                    <td id="tabel-date" class="px-4 py-3 text-right">Rp
                                        {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <div class="flex gap-5 mr-5">
                                            <button class="p-3 border bg-red-600 text-white rounded-xl"
                                                style="border-radius: 50%;" data-uuid="{{ $t->uuid }}"
                                                id="updateProductButton" title="Void Transaksi">
                                                <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z" />
                                                </svg>
                                            </button>
                                            <a href="/detail_transaksi/?uuid={{$t->uuid}}" class="p-3 border bg-blue-600 text-white rounded-xl"
                                                style="border-radius: 50%;"
                                                id="detailProductModal" title="Detail Transaksi">
                                                <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                                </svg>
                                            </a >
                                        </div>
                                    </td>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                {{ $transaksi->links() }}
            </nav>
        </div>
    </div>
</section>


<style>
    .display-hidden {
        display: none
    }
</style>


<script>
    const btnDelete = document.getElementById('btn-delete')
    btnDelete.addEventListener('click', function() {
        let xhr = new XMLHttpRequest()

        if (confirm('anda yakin ingin menghapus')) {
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    window.location.href = "/transaksi";
                }
            }

            xhr.open('DELETE', '/transaksi/?uuid=' + this.getAttribute('data-uuid'), true)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send()
        }

    })



    // fitur filter tabel

    const filterTabel = Array.from(document.querySelectorAll('.filterTabel'))
    const tdKategori = Array.from(document.querySelectorAll('#tabel-kategori'))
    const thKategori = document.querySelector('#tabel-heading-kategori')
    const tdSupplier = Array.from(document.querySelectorAll('#tabel-suppllier'))
    const thSupplier = document.querySelector('#tabel-heading-supplier')
    const tdDeskripsi = Array.from(document.querySelectorAll('#tabel-deskripsi'))
    const thDeskripsi = document.querySelector('#tabel-heading-deskripsi')

    filterTabel.forEach((item, index) => {
        item.addEventListener('click', function() {
            if(item.checked) {
                if(item.value == 'kategori') {
                    tdKategori.forEach((tdk,i) => {
                        tdKategori[i].classList.remove('hidden')
                    })
                    thKategori.classList.remove('hidden')
                }

                if(item.value == 'supplier'){
                    tdSupplier.forEach(tds => {
                        tds.classList.remove('hidden')
                    })
                    thSupplier.classList.remove('hidden')
                }

                if(item.value =='deskripsi'){
                    tdDeskripsi.forEach(tdd => {
                        tdd.classList.remove('hidden')
                    })
                    thDeskripsi.classList.remove('hidden')
                }
            }else{
                if(item.value == 'kategori') {
                    tdKategori.forEach(tdk => {
                        tdk.classList.add('hidden')
                    })
                    thKategori.classList.add('hidden')
                }

                if(item.value == 'supplier'){
                    tdSupplier.forEach(tds => {
                        tds.classList.add('hidden')
                    })
                    thSupplier.classList.add('hidden')
                }

                if(item.value == 'deskripsi'){
                    tdDeskripsi.forEach(tds => {
                        tds.classList.add('hidden')
                    })
                    thDeskripsi.classList.add('hidden')
                }
            }
        })
    })

    // const addTransaksi = document.getElementById('addTransaksi')
    // addTransaksi.addEventListener('click', async function () {
    //     try{
    //         const response = await fetch('/get_kategori_transaksi_all')
    //         if(!response.ok) {
    //             throw new Error(`HTTP error! Status: ${response.status}`);
    //         }

    //         const data = await response.json()
    //         const kategori = document.getElementById('kategori');
    //         kategori.innerHTML = '<option selected="">Select category</option>';
    //         jenis_transaksi.addEventListener('input', function() {
    //            data.forEach(res => {
    //             if(res.jenis_transaksi_id == jenis_transaksi.value){
    //                 let option = document.createElement('option');
    //                 option.value = res.id;
    //                 option.textContent = res.nama;
    //                 kategori.appendChild(option);
    //             }
    //            });
    //         })

    //     }catch (error) {
    //         console.error('Error', error)
    //     }
    // })


</script>
