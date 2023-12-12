<section class="mb-20">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-sm">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-sm">Jumlah</th>
                            <th scope="col" class="px-4 py-3 text-sm">Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-body">
                        <?php $__currentLoopData = $transaksiTerkini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="tabel-row" class="border-b dark:border-gray-700">
                                <td style="color: <?php echo e($item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424')); ?>"
                                    class="px-4 py-3 font-medium text-sm">
                                    <?php echo e(substr($item['kategori_transaksi']->nama, 0, 25) ?? '--'); ?></td>

                                <th scope="row"
                                    style="color: <?php echo e($item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424')); ?>"
                                    class="px-4 py-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    <?php echo e($item['jenis_transaksi_id'] == 1 ? '+ Rp ' : '- Rp '); ?><?php echo e(number_format($item['jumlah'], 0, ',', '.')); ?>

                                </th>
                                <th scope="row"
                                    style="color: <?php echo e($item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424')); ?>"
                                    class="px-4 py-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    <?php echo e($item['tanggal']); ?></th>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</section>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/transaksi_terkini.blade.php ENDPATH**/ ?>