<table>
    <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">No transaksi</th>
        <th scope="col">Jenis Transaksi</th>
        <th>Kategori Transaksi</th>
        <th>Supplier/Costumer</th>
        <th>Deskripsi</th>
        <th scope="col" align="right">Jumlah</th>
    </tr>
        <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <div>
                <th scope="row">
                    <?php echo e($t->tanggal); ?></th>
                <td><?php echo e($t->no_transaksi ?? '--'); ?></td>
                <td>
                    <?php if($t->jenis_transaksi->nama == 'Pendapatan Tetap'): ?>
                    Pendapatan Tetap
                    <?php elseif($t->jenis_transaksi->nama == 'Pendapatan Tidak Tetap'): ?>
                    Pendapatan Tidak Tetap
                    <?php elseif($t->jenis_transaksi->nama == 'Pengeluaran Pokok'): ?>
                    Pengeluaran Pokok
                    <?php elseif($t->jenis_transaksi->nama == 'Pengeluaran Tambahan'): ?>
                    Pengeluaran Tambahan
                    <?php elseif($t->jenis_transaksi->nama == 'Tabungan'): ?>
                    Tabungan
                    <?php else: ?>
                    --
                    <?php endif; ?>
                </td>
                <td><?php echo e($t->kategori_transaksi->nama); ?></td>
                <td><?php echo e($t->suppliers_or_customers->nama_bisnis ?? '--'); ?></td>
                <td><?php echo e($t->deskripsi ?? '--'); ?></td>
                <td align="right">Rp
                    <?php echo e(number_format($t->jumlah, 0, ',', '.')); ?></td>
            </div>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/transaksi/layouts/tabel_xlsx.blade.php ENDPATH**/ ?>