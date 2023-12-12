<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="./image/logo/octans_logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <title style="text-transform: capitalize;"><?php echo e(request()->path()); ?> - Octans by Boxity</title>
    <link rel="shortcut icon" href="https://www.octansidn.com/webpage/demos/business/images/octans/icon_2.ico"
        type="image/x-icon">
    <style>
        .grecaptcha-badge {
            visibility: hidden !important;
        }
        * {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <?php echo RecaptchaV3::initJs(); ?>

</head>

<body class="font-body">
    <div style="min-height: 100vh" class="antialiased bg-gray-50 dark:bg-gray-900">
        <div>
            <?php echo $__env->yieldContent('container'); ?>
        </div>
    </div>
</body>

</html>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/user/layouts/main_layouts.blade.php ENDPATH**/ ?>