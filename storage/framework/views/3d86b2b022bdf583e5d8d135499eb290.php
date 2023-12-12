<section class="">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-sm">Persentase</th>
                            <th scope="col" class="px-4 py-3 text-sm">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-sm">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-body">
                        <?php $__currentLoopData = $anggarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="tabel-row" class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-300 w-[100%] h-[7px] relative rounded">
                                        <div style="width: <?php echo e(round($item->persentase)); ?>%" class="bg-blue-600 h-[7px] absolute rounded"></div>
                                    </div>
                                    <P><?php echo e(round($item->persentase)); ?>%</P>
                                </div>
                            </td>
                            <td class="px-4 py-3"><?php echo e($item->kategori_transaksi->nama); ?></td>
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"> <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/anggaran_tabel.blade.php ENDPATH**/ ?>