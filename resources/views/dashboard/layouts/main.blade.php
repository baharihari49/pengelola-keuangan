<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="{{ asset('js/echarts.min.js') }}"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    {{-- <script src="https://unpkg.com/feather-icons"></script> --}}
</head>
<body>

    <div class="antialiased bg-gray-50 dark:bg-gray-900 h-screen">

    @include('dashboard.layouts.nav')
    @include('dashboard.layouts.sidebar')

    <main id="main-section" class="p-4 md:ml-64 h-auto pt-20">
        @yield('container')
    </main>

</div>
<script src="js/script.js"></script>
</body>
</html>