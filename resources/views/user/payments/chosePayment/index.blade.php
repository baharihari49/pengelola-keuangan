@extends('user.layouts.main_layouts')

@section('container')
    <section class="bg-gray-50 flex flex-col justify-center items-center h-screen">
        <a href="#" class="flex items-center mb-8 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="h-20 mr-2" src="./image/logo/octans.png" alt="logo">
        </a>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 container px-3 lg:px-32">
            <div class="border lg:col-span-2 bg-white shadow-md rounded-md p-10">
                <h3 class="text-center font-semibold text-2xl mb-10">Pilih Metode Pembayaran</h3>
                <div class="flex gap-3 justify-center">
                    <div class="border rounded-md flex items-center px-5 text-blue-500 font-semibold text-xl text-center lg:text-2xl"><p>Virtual Account</p></div>
                    <form class="border cursor-pointer rounded-md p-5 hover:bg-gray-100" action="create_payment" method="POST">
                        @csrf
                        <button class="submit" class="">
                            <img class="w-28" src="image/logo/logo_qris.png" alt="logo qris">
                        </button>
                    </form>
                    {{-- <div data-modal-target="default-modal" data-modal-toggle="default-modal"  class="border cursor-pointer rounded-md p-5 hover:bg-gray-100">
                        <img class="w-28" src="image/logo/logo_qris.png" alt="logo qris">
                    </div> --}}
                </div>
            </div>
            <div class="border bg-white w-full rounded-md shadow-md lg:col-span-1 p-5">
                <h3 class="text-center text-lg">Ringkasan Orderan</h3>
                <hr class="my-2">

                <p class="text-center text-sm text-gray-600">No Tagihan : 57575346</p>
                <br>
                <table class="w-full" style="border: none">
                    <tr class="">
                        <td class="text-gray-600 text-sm">Langganan octans</td>
                        <td class="text-right">Rp55.074</td>
                    </tr>
                    <tr class="">
                        <td class="text-gray-600 text-sm pt-3 pb-4">Pajak 0%</td>
                        <td class="text-right pt-3 pb-4">Rp0</td>
                    </tr>
                    <tr class="border-t-2">
                        <td class="text-gray-800 font-medium pt-1">Total</td>
                        <td class="text-right text-blue-500 pt-1 font-medium text-lg">Rp55.0</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
