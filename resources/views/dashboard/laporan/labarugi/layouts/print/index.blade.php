<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Laba Rugi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <div>
        <h1 class="text-2xl font-bold mb-5 text-center">Laporan Laba Rugi</h1>
    </div>
    <section>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr style="background: #F3F4F6">
                    <th scope="col" class="px-4 py-3 text-left">Nama Akun</th>
                    <th scope="col" class="px-4 py-3 text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">* Pemasukan</th>
                    <td class="px-4 py-3 text-right">Rp {{number_format($pemasukan, 0, ',', '.')}}</td>
                </tr>
                @foreach ($pemasukanByKategori as $item)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white pl-10 text-left">- {{$item->nama}}</th>
                    <td class="px-4 py-3 text-right">Rp {{number_format($item->jumlah, 0, ',', '.')}}</td>
                </tr>
                @endforeach
                <tr style="background: #F3F4F6" class="border-b bg-gray-100 dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white text-left">TOTAL PENDAPATAN</th>
                    <td class="px-4 py-3 text-gray-800 font-semibold text-right">Rp {{number_format($pemasukan, 0, ',', '.')}}</td>
                </tr>

                <tr class="border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">* Pengeluaran</th>
                    <td class="px-4 py-3 text-right">Rp {{number_format($pengeluaran, 0, ',', '.')}}</td>
                </tr>
                @foreach ($pengeluaranByKategori as $item)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white pl-10 text-left">- {{$item->nama}}</th>
                    <td class="px-4 py-3 text-right">Rp {{number_format($item->jumlah, 0, ',', '.')}}</td>
                </tr>
                @endforeach
                <tr style="background: #F3F4F6" class="border-b bg-gray-100 dark:border-gray-700">
                    <th scope="row"
                        class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white text-left">TOTAL PENGELUARAN</th>
                    <td class="px-4 py-3 text-gray-800 font-semibold text-right">Rp {{number_format($pengeluaran, 0, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>
</html>