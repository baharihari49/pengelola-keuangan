<?php echo $__env->make('dashboard.anggaran.layouts.create_anggaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.anggaran.layouts.update_anggaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="">
    <div class="mx-auto w-full">
        <!-- Start coding here -->
        <div id="container-table"
            class="bg-white min-h-[290px] dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <?php if(auth()->user()->can('tambah anggaran')): ?>
                        <button type="button" id="defaultModalButton"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Anggaran
                        </button>
                    <?php else: ?>
                        <button disabled type="button" id="defaultModalButton"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Anggaran
                        </button>
                    <?php endif; ?>

                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Kategori Anggaran</th>
                            <th scope="col" class="px-4 py-3">Kategori Budgeting</th>
                            <th scope="col" class="px-4 py-3">Sisa Anggaran</th>
                            <th scope="col" class="px-4 py-3">Jumlah</th>
                            <th scope="col" class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $Anggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="tabel-row" class="border-b dark:border-gray-700">

                                <td class="px-4 py-3"><?php echo e($a->kategori_transaksi->nama); ?></td>
                                <td class="px-4 py-3">
                                    <?php echo e($a->kategori_anggaran->nama ?? '--'); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-300 w-[100%] h-[7px] relative rounded">
                                            <div style="width: <?php echo e(round($a->persentase)); ?>%"
                                                class="bg-blue-600 h-[7px] absolute rounded"></div>
                                        </div>
                                        <P><?php echo e(round($a->persentase)); ?>%</P>
                                    </div>
                                </td>

                                <td scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo e(number_format($a->jumlah, 0, ',', '.')); ?>

                                </td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex gap-5 mr-5">
                                        <?php if(auth()->user()->can('ubah anggaran')): ?>
                                            <button data-id="<?php echo e($a->id); ?>" id="updateProductButton">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                                </svg>
                                            </button>
                                        <?php else: ?>
                                            <button disabled data-id="<?php echo e($a->id); ?>" id="updateProductButton">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                                </svg>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                
            </nav>
        </div>
    </div>
</section>


<script>
    const btnDelete = document.getElementById('btn-delete')
    // delete
    btnDelete.addEventListener('click', function() {
        if (confirm('Anda yakin ingin melakukan tindakan ini??')) {
            this.setAttribute('data-id', dataId)
            const idDelete = this.getAttribute('data-id')

            const xhr = new XMLHttpRequest()

            xhr.onreadystatechange = () => {
                if (xhr.status === 200 && xhr.readyState === 4) {
                    window.location.href = "/anggaran";
                }
            }

            xhr.open('DELETE', '/anggaran/?id=' + this.getAttribute('data-id'), true)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
            xhr.send()

        }
    })
</script>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/anggaran/layouts/tabel_anggaran.blade.php ENDPATH**/ ?>