<?php $__env->startSection('container'); ?>
    <div class="bg-white overflow-x-auto shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-32 lg:mb-24">
      <?php if(request()->is('transaksi')): ?>
      <?php echo $__env->make('dashboard.transaksi.layouts.tabel_transaksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>

    </div>

  <script src="js/transaksi_script.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/transaksi/index.blade.php ENDPATH**/ ?>