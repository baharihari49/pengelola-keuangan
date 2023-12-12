<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pemasukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <div>
        <h1 class="text-2xl text-center font-semibold mb-5">Laporan Pemasukan {{($bulan != null) ? 'Bulan ' .$bulan : ''}}</h1>
    </div>
    <section>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead style="background: #F3F4F6" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3 border">no transaksi</th>
                    <th scope="col" class="px-4 py-3 border">Tanggal</th>
                    <th scope="col" class="px-4 py-3 border">kategori</th>
                    <th scope="col" class="px-4 py-3 border">costumer/supplier</th>
                    <th scope="col" class="px-4 py-3 border">Deskripsi</th>
                    <th scope="col" class="px-4 py-3 border">Jumlah</th>
                </tr>
            </thead>
            <tbody id="tabelBody">
                @foreach ($data as $item)
                <tr id="tabelRowPem" class="border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->no_transaksi}}</th>
                    <td class="px-4 py-3 border">{{$item->tanggal}}</td>
                    <td class="px-4 py-3 border">{{$item->kategori_transaksi->nama}}</td>
                    <td class="px-4 py-3 border">{{$item->suppliers_or_customers->nama_bisnis ?? '--'}}</td>
                    <td class="px-4 py-3 border">{{$item->deskripsi ?? '--'}}</td>
                    <td class="px-4 py-3 border">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr style="background: #F3F4F6" class="border-b dark:border-gray-700">
                    <th scope="row" align="left" colspan="5" class="px-4 py-3 border">Jumlah Total</th>
                    <td class="px-4 py-3 font-semibold border">Rp {{number_format($pemasukan, 0, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>
</html>