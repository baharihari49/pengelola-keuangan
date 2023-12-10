<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./image/logo/octans_logo.png" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,200;1,500&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://www.octansidn.com/webpage/demos/business/images/octans/icon_2.ico"
        type="image/x-icon">
    <title class="capitalize" style="text-transform: capitalize;">
        {{ request()->path() == '/' ? 'Dashboard - Octans by Boxity' : request()->path() . ' - Octans by Boxity' }}
    </title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</head>

<body class="font-body">

    <div style="min-height: 100vh" class="antialiased bg-gray-50 dark:bg-gray-900">

        @include('dashboard.layouts.nav')
        @include('dashboard.layouts.sidebar')

        <main id="container-main" class="">
            <div style="min-height: 100vh" id="main-section" class="p-4 md:ml-64 h-auto pt-20 border overflow-hidden">
                @yield('container')
            </div>
            <div id="footer-section" class="md:ml-64 h-auto relative">
                @include('dashboard.layouts.footer')
            </div>
        </main>


    </div>
    {{-- <script>
    const btnDeleteImage = document.getElementById('delete-image');
    console.log('okeee');

    btnDeleteImage.addEventListener('click', function () {
        if (confirm('Anda yakin ingin menghapus?')) {
            const foto = this.getAttribute('data-foto');

            fetch(`/delete_foto/?foto=${foto}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => {
                if (response.status === 200) {
                    window.location.href = "/";
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }
    });
</script> --}}
    <script src="js/script.js"></script>
</body>

</html>
