<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <section class="bg-white rounded-xl shadow-md p-5 mb-32">
        <div class="text-sm text-gray-700">
            <div class="">
                <table class="w-full">
                    <tr class="">
                        <td class="py-1">No Transaksi</td>
                        <td> : {{$data[0]->no_transaksi}}</td>
                        <td class="py-1">Kategori Transaksi</td>
                        <td> : {{$data[0]->kategori_transaksi->nama}}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Tanggal</td>
                        <td> : {{$data[0]->tanggal}}</td>
                        <td class="py-1">{{($data[0]->jenis_transaksi_id == 1) ? 'Customer' : 'Supplier'}}</td>
                        <td> : {{$data[0]->supplier_or_customer->nama_bisnis ?? '--'}}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Deskripsi</td>
                        <td> : {{$data[0]->deskripsi ?? '--'}}</td>
                        <td class="py-1">Dibuat oleh</td>
                        <td> : {{(auth()->user()->nama != null) ? auth()->user()->nama : auth()->user()->username}}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Jenis Transaksi</td>
                        <td> : {{$data[0]->jenis_transaksi->nama}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="mt-2 mb-6">
        <table class="w-full border text-sm">
            <thead style="background: #F3F4F6" class="text-sm text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr class="w-full border">
                    <th scope="col" class="px-4 py-3 border text-left">Kategori Transaksi</th>
                    <th scope="col" class="px-5 py-3 border" align="right">Jumlah</th>
                </tr>
            </thead>
            <tr class="border">
                <td class="text-lift px-4 py-3 text-gray-700 border">{{$data[0]->kategori_transaksi->nama}}</td>
                <td class="text-right px-4 py-3 font-bold border text-base text-gray-700">
                    {{number_format($data[0]->jumlah, 0, ',', '.')}}</td>
            </tr>
            <tr style="background: #F3F4F6" class="bg-gray-100">
                <td class="text-lift px-4 py-3 text-gray-700">Jumlah</td>
                <td class="text-right px-4 py-3 font-bold text-base text-gray-700">
                    {{number_format($data[0]->jumlah, 0, ',', '.')}}</td>
            </tr>
        </table>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>
</html> 