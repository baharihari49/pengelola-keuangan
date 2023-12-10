<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="./image/logo/octans_logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,200;1,500&display=swap"
        rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title style="text-transform: capitalize;">{{ request()->path() }} - Octans by Boxity</title>
    <link rel="shortcut icon" href="https://www.octansidn.com/webpage/demos/business/images/octans/icon_2.ico"
        type="image/x-icon">
    <style>
        .grecaptcha-badge {
            visibility: hidden !important;
        }
    </style>
    {!! RecaptchaV3::initJs() !!}
</head>

<body class="font-body">
    <div style="min-height: 100vh" class="antialiased bg-gray-50 dark:bg-gray-900">
        <div>
            @yield('container')
        </div>
    </div>
</body>

</html>
