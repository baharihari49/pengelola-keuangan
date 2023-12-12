<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-3">Kategori</th>
            <th scope="col" class="px-4 py-3">Keterangan</th>
            <th scope="col" class="px-4 py-3">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemasukan as $item)
            <tr class="border-b dark:border-gray-700">
                <td class="px-4 py-3">{{$item->kategori_transaksi->nama}}</td>
                <td class="px-4 py-3">{{$item->kategori_transaksi->nama}} Bulan Ini</td>
                <td class="px-4 py-3">Rp {{number_format($item->jumlah_transaksi, 0, ',', '.')}}</td>
            </tr>
        @endforeach
        <tr class="border-b dark:border-gray-700 bg-green-100">
            <td class="px-4 py-3 font-bold text-gray-800">Total</td>
            <td class="px-4 py-3 font-bold text-gray-800" colspan="2">Rp {{number_format($totalPemasukan, 0, ',', '.')}}</td>
        </tr>
    </tbody>
</table>
