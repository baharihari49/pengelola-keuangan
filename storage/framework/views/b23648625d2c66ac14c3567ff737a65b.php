<?php $__env->startSection('container'); ?>
<h1 class="text-2xl lg:text-3xl my-5 font-bold text-gray-800">Laporan Pengeluaran</h1>
<div class="bg-white p-5 rounded-md my-5 shadow-md text-2xl lg:text-3xl font-semibold">
    <span>Rp <?php echo e(number_format($pengeluaran, 0, ',', '.')); ?></span>
    <p class="text-gray-500 text-sm font-medium mt-1">Total Pengeluaran</p>
</div>

<?php echo $__env->make('dashboard.laporan.pengeluaran.layouts.container_laporan_pengeluaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="./js/laporan/pemasukan&pengeluaran.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/laporan/pengeluaran/index.blade.php ENDPATH**/ ?>