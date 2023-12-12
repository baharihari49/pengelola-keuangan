<?php $__env->startSection('container'); ?>
    <div class="flex items-center justify-between">
        <h3 class="text-3xl font-bold text-gray-800 my-5">Laporan Laba Rugi <?php echo e(($bulan != null) ? 'Periode ' .$bulan : 'Semua Periode'); ?></h3>
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
                    <?php if(auth()->user()->can('cetak labarugi')): ?>
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkPrint" href="/pdf_laba_rugi/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Print</a>
                                </li>
                                <li onclick="" id="filterKategori" data-id-2="1" data-id="all">
                                    <a id="linkExcel" href="/laba_rugi_xlsx/?id=all"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                        to excel</a>
                                </li>
                                <?php else: ?>
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
                                <?php endif; ?>
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
                    <?php $__currentLoopData = $dataBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li id="filterKategori" data-id-2="1"
                        data-id="<?php echo e($item->id_bulan); ?>">
                        <a href="/laba_rugi/?id=<?php echo e($item->id_bulan); ?>"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo e($item->bulan_transaksi); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <?php echo $__env->make('dashboard.laporan.labarugi.layouts.tabel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/laporan/labarugi/index.blade.php ENDPATH**/ ?>