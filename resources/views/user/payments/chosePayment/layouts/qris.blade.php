@extends('user.layouts.main_layouts')

@section('container')
<section class="bg-50 h-screen w-screen flex justify-center items-center">
    <div class="p-5 rounded-md shadow-md flex flex-col items-center justify-center">
        <a href="#" class="flex items-center mb-8 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="h-20 mr-2" src="./image/logo/octans.png" alt="logo">
        </a>
        <p class="mb-3 text-sm text-gray-600">Bayar menggunakan QRIS</p>
        <figure class="mx-auto">
            <img class="w-80" src="./image/qr_code.png" alt="">
        </figure>
    </div>
</section>
@endsection
