<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14  transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <li>
                <a id="icon-sidebar" href="/"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('/') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/transaksi"
                    class="flex items-center p-2 text-base font-medium {{ request()->is('transaksi') ? 'bg-gray-100' : '' }} text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3V0H2Zm16 0h-3v16h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 0H7v16h6V0Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Transaksi</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/kategori_transaksi"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('kategori_transaksi') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z" />
                        <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Kategori Transaksi</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/anggaran"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('anggaran') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m14.556 7.799-2.43 5.482A2 2 0 0 0 14 15.98h3.114a2.001 2.001 0 0 0 1.873-2.7l-2.43-5.482v-.925c.33.07.664.107 1 .107a1 1 0 1 0 0-2 3.378 3.378 0 0 1-2.267-1.006 8.567 8.567 0 0 0-2.79-1.571 3 3 0 0 0-5.888.034c-.827.32-1.585.8-2.228 1.412a3.6 3.6 0 0 1-2.827 1.13 1 1 0 0 0 0 2 7.379 7.379 0 0 0 1-.07v.889L.127 13.28A2 2 0 0 0 2 15.98h3.114a2.001 2.001 0 0 0 1.873-2.7l-2.43-5.482v-1.57a8.355 8.355 0 0 0 1.133-.865 5.713 5.713 0 0 1 1.282-.882 2.993 2.993 0 0 0 1.585 1.316V17.98h-7a1 1 0 1 0 0 2h16a1 1 0 0 0 0-2h-7V5.797a3 3 0 0 0 1.62-1.384 7.17 7.17 0 0 1 1.89 1.143c.16.124.327.25.5.377 0 .017-.01.03-.01.048v1.818Zm-5-3.818a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Anggaran</span>
                </a>
            </li>

            <li>
                <a id="icon-sidebar" href="/supplier_costumer"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('supplier_costumer') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 1v4a1 1 0 0 1-1 1H1m8-2h3M9 7h3m-4 3v6m-4-3h8m3-11v16a.969.969 0 0 1-.932 1H1.934A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.829 1h8.239A.969.969 0 0 1 15 2ZM4 10h8v6H4v-6Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Supplier/Costumer</span>
                </a>
            </li>

            <li>
                <button id="icon-sidebar" type="button"
                    class="flex items-center w-full p-2 text-base {{ request()->path() == 'pemasukan' || request()->path() == 'pengeluaran' || request()->path() == 'laba_rugi' ? 'bg-gray-100' : '' }} font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                    aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z" />
                    </svg>
                    <span id="text-sidebar" class="flex-1 ml-3 text-left whitespace-nowrap"
                        sidebar-toggle-item>Laporan</span>
                    <svg id="text-sidebar" sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
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
                        <a
                            class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Tabungan</a>
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
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.5 6.5h.01m4.49 0h.01m4.49 0h.01M18 1H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                    </svg>
                    <span id="text-sidebar" class="ml-3">Kirim Umpan Balik</span>
                </a>
            </li>
            <li>
                <a id="icon-sidebar" href="/log-viewer" target="_blank"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('log-viewer') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                    <span id="text-sidebar" class="ml-3">Log Viewer</span>
                </a>
            </li>

            @role('admin')
            <hr class="my-5">
            <ul>
                <li>
                    <a id="icon-sidebar" href="/user"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('supplier_costumer') ? 'bg-gray-100' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                          </svg>
                        <span id="text-sidebar" class="ml-3">Users</span>
                    </a>
                </li>

                <li>
                    <a id="icon-sidebar" href="/feedback_manage"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->is('supplier_costumer') ? 'bg-gray-100' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 16.5c0-1-8-2.7-9-2V1.8c1-1 9 .707 9 1.706M10 16.5V3.506M10 16.5c0-1 8-2.7 9-2V1.8c-1-1-9 .707-9 1.706"/>
                          </svg>
                        <span id="text-sidebar" class="ml-3">Feedback Manage</span>
                    </a>
                </li>
            </ul>
            @endrole


        </ul>
    </div>
</aside>
