<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="">
        <h1 class="text-center text-2xl text-gray-700 font-bold">Data Transaksi {{($bulan != null) ? 'Bulan ' .$bulan : ''}}</h1>
        {{-- <table>
            <tr>
                <td>Nama</td>
            </tr>
        </table> --}}
    </div>
    <hr style="margin-top: 1.25rem; margin-bottom: 1.25rem" class="">
    <section>
        <table
            class=" w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-x-auto md:overflow-hidden">
            <thead style="background: #F3F4F6" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="border">
                    {{-- <th scope="col" class="px-4 py-3">No</th> --}}
                    <th scope="col" class="px-4 py-3 border">Tanggal</th>
                    <th scope="col" class="px-4 py-3 border">No transaksi</th>
                    <th scope="col" class="px-4 py-3 border">Jenis Transaksi</th>
                    <th scope="col" class="px-4 py-3 border">Kategori</th>
                            <th scope="col" class="px-4 py-3 border">Customer/Supplier</th>
                            <th scope="col" class="px-4 py-3 border">Deskripsi</th>
                    <th scope="col" class="px-4 py-3 border" align="right">Jumlah</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                @foreach ($transaksi as $index => $t)
                <tr id="tabel-row" class="border-b dark:border-gray-700">
                    <th id="tabel-date" scope="row"
                        class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $t->tanggal }}</th>
                    <td id="tabel-date" class="px-4 py-3 border">{{ $t->no_transaksi ?? '--' }}</td>
                    <td id="tabel-date" class="px-4 py-3 border">
                        @if ($t->jenis_transaksi->nama == 'Pemasukan')
                        <i class="fa-solid fa-arrow-down-long" style="color: #25c137;"></i>
                        Pemasukan
                        @elseif ($t->jenis_transaksi->nama == 'Pengeluaran')
                        <i class="fa-solid fa-arrow-up-long" style="color: #e61e1e;"></i>
                        Pengeluaran
                        @elseif ($t->jenis_transaksi->nama == 'Tabungan')
                        <i class="fa-solid fa-wallet" style="color: #1C64F2"></i> Tabungan
                        @else
                        --
                        @endif
                    </td>
                    <td id="tabel-date" class="px-4 py-3 border">{{$t->kategori_transaksi->nama}}</td>
                    <td id="tabel-date" class="px-4 py-3 border">{{$t->suppliers_or_customers->nama_bisnis ?? '--'}}</td>
                    <td id="tabel-date" class="px-4 py-3 border">{{$t->deskripsi ?? '--'}}</td>
                    <td id="tabel-date" class="px-4 py-3 border text-right">Rp
                        {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>

</html>