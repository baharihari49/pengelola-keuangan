<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-3">Deskripsi</th>
            <th scope="col" class="px-4 py-3">Jumlah</th>
            <th scope="col" class="px-4 py-3">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tabungan as $item)
        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">{{$item->kategori_transaksi->nama ?? '--'}}</td>
            <td class="px-4 py-3">Rp {{number_format($item->jumlah_transaksi, 0, ',', '.')}}</td>
            <td class="px-4 py-3">{{$item->kategori_transaksi->nama ?? '--'}} Bulan Ini</td>
        </tr>
        @endforeach

        <tr class="border-b dark:border-gray-700 bg-blue-100 font-semibold text-gray-800">
            <td class="px-4 py-3">Total</td>
            <td class="px-4 py-3" colspan="2">Rp {{number_format($jumlahTabungan, 0, ',', '.')}}</td>
        </tr>

    </tbody>
</table>