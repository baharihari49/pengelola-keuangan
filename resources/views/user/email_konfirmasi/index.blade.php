@extends('user.layouts.main_layouts')


@section('container')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-16 mr-2" src="../image/logo/octans.png" alt="logo">
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-2 md:space-y-4 sm:px-8 sm:py-8 sm:pb-5">
                    <h1 class="text-x text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Konfirmasi Email Anda
                    </h1>
                    <p class="text-sm text-gray-500 text-center">Silahkan buka email anda dan klik konfirmasi untuk melanjutkan pendaftaran</p>
                </div>
                <form class="text-center pb-2" action="/email/verification-notification" method="POST">
                    @csrf
                    <input type="hidden">
                    <button class="text-sm text-blue-500">Kirim ulang</button>
                </form>
            </div>
        </div>
    </section>
@endsection
