<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link rel="icon" href="https://drive.google.com/file/d/1lOQcnPpV5U0QQoT7w-bml-Z-YRgqM5oL/view?usp=drive_link" type="image/svg+xml"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{(request()->path() == '/' ) ? 'Dashboard' : request()->path()}}</title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
</head>
<body class="font-body">

    <div style="min-height: 100vh" class="antialiased bg-gray-50 dark:bg-gray-900">

    @include('dashboard.layouts.nav')
    @include('dashboard.layouts.sidebar')

    <main id="container-main" class="">
        <div style="min-height: 100vh" id="main-section" class="p-4 md:ml-64 h-auto pt-20 border">
            @yield('container')
        </div>
        <div id="footer-section" class="md:ml-64 h-auto relative">
            @include('dashboard.layouts.footer')
        </div>
    </main>


</div>
<script src="js/script.js"></script>
</body>
</html>