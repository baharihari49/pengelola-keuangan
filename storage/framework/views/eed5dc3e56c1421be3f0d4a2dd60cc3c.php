<?php $__env->startSection('container'); ?>
  <div class="bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-4">
    <?php echo $__env->make('dashboard.kategori.layouts.tabel_categori_transaksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

<script src="js/kategori_transaksi_script.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/kategori/index.blade.php ENDPATH**/ ?>