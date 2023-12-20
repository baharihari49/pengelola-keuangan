@extends('user.layouts.main_layouts')


@section('container')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-16 mr-2"
                    src="https://res.cloudinary.com/du0tz73ma/image/upload/v1702445620/octansidnByBoxity_vwv8wi.png"
                    alt="OctansIDN Logo Official">
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Masuk Ke Akun Anda
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="/login">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@gmail.com" required="">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">I am
                                        sorry,</span> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata
                                Sandi</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        {!! RecaptchaV3::field('submit') !!}
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Masuk</button>
                       <div class="flex justify-between">
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Belum mempunyai akun? <a href="/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
                        </p>
                        <a href="/forgot-password" class="text-sm text-blue-500 font-medium">Lupa Password</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
