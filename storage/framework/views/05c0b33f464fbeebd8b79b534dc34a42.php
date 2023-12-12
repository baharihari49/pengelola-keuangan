<?php $__env->startSection('container'); ?>
<section class="bg-50 h-screen w-screen flex justify-center items-center">
    <div class="p-5 rounded-md shadow-md flex flex-col items-center justify-center">
        <a href="#" class="flex items-center mb-8 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="h-20 mr-2" src="./image/logo/octans.png" alt="logo">
        </a>
        <p class="mb-3 text-sm text-gray-600">Bayar menggunakan QRIS</p>
        
        <div class="visible-print text-center">
            <?php echo SimpleSoftwareIO\QrCode\Facades\QrCode::size(330)->generate($qrCode); ?>

            
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.main_layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/user/payments/chosePayment/layouts/qris.blade.php ENDPATH**/ ?>