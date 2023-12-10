<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14  transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <h5 style="margin: 1.5rem 0 1rem 0;"><b>Main</b></h5>
        <ul class="space-y-2">
            <li>
                <a id="icon-sidebar" href="/"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('/') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6.143 1H1.857A.857.857 0 0 0 1 1.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 7 6.143V1.857A.857.857 0 0 0 6.143 1Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 17 6.143V1.857A.857.857 0 0 0 16.143 1Zm-10 10H1.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 7 16.143v-4.286A.857.857 0 0 0 6.143 11Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/transaksi"
                    class="flex items-center p-2 text-base font-medium {{ request()->is('transaksi') ? 'bg-gray-100' : '' }} text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"
                            d="M2 5h17m-9 8V6M2 1h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Transaksi</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/kategori_transaksi"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('kategori_transaksi') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none"
                        viewBox="0 0 20 14">
                        <path stroke="currentColor" stroke-width="2"
                            d="M1 5h18M1 9h18m-9-4v8m-8 0h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Kategori Transaksi</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/anggaran"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('anggaran') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 15V9m4 6V9m4 6V9m4 6V9M2 16h16M1 19h18M2 7v1h16V7l-8-6-8 6Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Anggaran</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/supplier_costumer"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('supplier_costumer') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4H1m3 4H1m3 4H1m3 4H1m6.071.286a3.429 3.429 0 1 1 6.858 0M4 1h12a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm9 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Supplier/Costumer</span>
                </a>
            </li>

            <li>
                <button id="icon-sidebar" type="button"
                    class="flex items-center w-full p-2 text-base {{ request()->path() == 'pemasukan' || request()->path() == 'pengeluaran' || request()->path() == 'laba_rugi' ? 'bg-gray-100' : '' }} font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                    aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z" />
                    </svg>
                    <span id="text-sidebar" class="flex-1 ml-3 text-left whitespace-nowrap"
                        sidebar-toggle-item>Laporan</span>
                </button>
                <ul id="dropdown-pages"
                    class="{{ request()->path() == 'pemasukan' || request()->path() == 'pengeluaran' || request()->path() == 'laba_rugi' ? '' : 'hidden' }}
                  py-2 space-y-2">
                    <li>
                        <a href="/pemasukan"
                            class="flex items-center p-2 text-base {{ request()->path() == 'pemasukan' ? 'bg-gray-100' : '' }} text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Pemasukan</a>
                    </li>
                    <li>
                        <a href="/pengeluaran"
                            class="flex items-center p-2 text-base text-gray-900 {{ request()->path() == 'pengeluaran' ? 'bg-gray-100' : '' }} transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Pengeluaran</a>
                    </li>
                    <li>
                        <a href="/laba_rugi/?id=all"
                            class="flex items-center p-2 {{ request()->path() == 'laba_rugi' ? 'bg-gary-100' : '' }} text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Laba
                            Rugi</a>
                    </li>
                </ul>
            </li>

            <li>
                <a id="icon-sidebar" href="/feedback"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('feedback') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Saran / Aduan</span>
                </a>
            </li>

            @role('super admin')
                <hr class="my-5">
                <h5 style="margin-top: 1.3rem;"><b>Management</b></h5>
                <ul>
                    @if (auth()->user()->can('lihat user'))
                        <li>
                            <a id="icon-sidebar" href="/user"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('user') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Users</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a id="icon-sidebar" href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('user') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Users</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->can('lihat feedback'))
                        <li>
                            <a id="icon-sidebar" href="/feedback_manage"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('feedback_manage') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 5h8m-1-3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1m6 0v3H6V2m6 0h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m0 9.464 2.025 1.965L12 9.571" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Feedback</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a id="icon-sidebar" href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('feedback_manage') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 16.5c0-1-8-2.7-9-2V1.8c1-1 9 .707 9 1.706M10 16.5V3.506M10 16.5c0-1 8-2.7 9-2V1.8c-1-1-9 .707-9 1.706" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Feedback</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a id="icon-sidebar" href="/manage-kategori"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('manage-kategori') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25" />
                            </svg>
                            <span id="text-sidebar" class="ml-3">Kategori</span>
                        </a>
                    </li>

                    @if (auth()->user()->can('lihat akses level'))
                        <li>
                            <a id="icon-sidebar" href="/akses_level"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('akses_level') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm6-3.976-2-.01A4.015 4.015 0 0 1 3 7m10 4a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Akses Level</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a id="icon-sidebar" href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('akses_level') ? 'bg-gray-100' : '' }}">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12.167v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                                </svg>
                                <span id="text-sidebar" class="ml-3">Akses Level</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a id="icon-sidebar" href="payment-manage"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('payment-manage') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11.6 16.733c.234.268.548.456.895.534a1.4 1.4 0 0 0 1.75-.762c.172-.615-.445-1.287-1.242-1.481-.796-.194-1.41-.862-1.241-1.481a1.4 1.4 0 0 1 1.75-.763c.343.078.654.261.888.525m-1.358 4.017v.617m0-5.94v.726M1 10l5-4 4 1 7-6m0 0h-3.207M17 1v3.207M5 19v-6m-4 6v-4m17 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                            </svg>
                            <span id="text-sidebar" class="ml-3">Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a id="icon-sidebar" href="/log-viewer" target="_blank"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('log-viewer') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 3 6 2V1m5 2 1-1V1M9 7v11M9 7a5 5 0 0 1 5 5M9 7a5 5 0 0 0-5 5m5-5a4.959 4.959 0 0 1 2.973 1H12V6a3 3 0 0 0-6 0v2h.027A4.959 4.959 0 0 1 9 7Zm-5 5H1m3 0v2a5 5 0 0 0 10 0v-2m3 0h-3m-9.975 4H2a1 1 0 0 0-1 1v2m13-3h2.025a1 1 0 0 1 1 1v2M13 9h2.025a1 1 0 0 0 1-1V6m-11 3H3a1 1 0 0 1-1-1V6" />
                            </svg>
                            <span id="text-sidebar" class="ml-3">Log Viewer</span>
                        </a>
                    </li>
                </ul>
            @endrole


        </ul>
    </div>
</aside>
