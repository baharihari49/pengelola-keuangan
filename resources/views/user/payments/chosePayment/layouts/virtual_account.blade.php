@extends('user.layouts.main_layouts')

@section('container')
    <section class="bg-50 h-screen w-screen flex justify-center items-center">
        <div class="px-7 py-7 rounded-md shadow-md flex flex-col items-center justify-center">
            <a href="#" class="flex items-center mb-8 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-20 mr-2" src="./image/logo/octans.png" alt="logo">
            </a>
            <div class="w-80">
                <p class="mb-3 class text-gray-700">Transfer ke virtual account</p>
                <p class="mb-2 uppercase">{{$sender_bank}}</p>
                <div class="bg-gray-200 px-5 py-3 rounded-md">
                    <p class="text-gray-600 font-semibold">{{$noVa}}</p>
                </div>
                <p class="my-3">Nominal Transafer</p>
                <div class="bg-gray-200 px-5 py-3 rounded-md">
                    <p class="text-gray-600 font-semibold">Rp {{number_format($amount, 0, ',', '.')}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
