<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-3">Deskripsi</th>
            <th scope="col" class="px-4 py-3">Kategori</th>
            <th scope="col" class="px-4 py-3">Jumlah</th>
            <th scope="col" class="px-4 py-3">Anggaran</th>
            <th scope="col" class="px-4 py-3">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengeluaranKebutuhan as $index => $item)
            @php
               $index = $index + 1
            @endphp
        @endforeach
        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3 border-b" {{(isset($index) ? 'rowspan="$index"'  : 0)}}>{{ $pengeluaranKebutuhan[0]->kategori_anggaran ?? '' }}</td>
            @foreach ($pengeluaranKebutuhan as $item)
            <td class="px-4 py-3 border-b">{{ $item->kategori_transaksi->nama }}</td>
            <td class="px-4 py-3 border-b">Rp {{ number_format($item->jumlah_transaksi, 0, ',', '.') }}</td>
            <td class="px-4 py-3 border-b">Rp {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
            <td class="px-4 py-3 border-b">{{ $item->kategori_transaksi->nama }} Bulan Ini</td>
        </tr>
        @endforeach

        @foreach ($jumlahTransaksiKebutuhan as $item)
        <tr class="border-b dark:border-gray-700 bg-red-100 font-semibold text-gray-800">
            <td class="px-4 py-3" colspan="2">Total</td>
            <td class="px-4 py-3">Rp {{number_format($item['jumlah_transaksi'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($item['jumlah_anggaran'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($item['selisih'], 0, ',', '.')}}</td>
        </tr>
        @endforeach


        @foreach ($pengeluaranKeinginan as $index => $item)
            @php
                $index = $index + 1
            @endphp
        @endforeach

        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3 border-b" {{(isset($index) ? 'rowspan="$index"'  : 0)}}>{{ $pengeluaranKeinginan[0]->kategori_anggaran ?? ''}}</td>
            @foreach ($pengeluaranKeinginan as $item)
            <td class="px-4 py-3 border-b">{{ $item->kategori_transaksi->nama }}</td>
            <td class="px-4 py-3 border-b">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            <td class="px-4 py-3 border-b">Rp {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
            <td class="px-4 py-3 border-b">{{ $item->kategori_transaksi->nama }} Bulan Ini</td>
        </tr>
        @endforeach


        @foreach ($jumlahTransaksiKeinginan as $item)
        <tr class="border-b dark:border-gray-700 bg-red-100 font-semibold text-gray-800">
            <td class="px-4 py-3" colspan="2">Total</td>
            <td class="px-4 py-3">Rp {{number_format($item['jumlah_transaksi'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($item['jumlah_anggaran'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($item['selisih'], 0, ',', '.')}}</td>
        </tr>
        @endforeach


        <tr class="border-b dark:border-gray-700 bg-red-200 font-semibold text-gray-800">
            <td class="px-4 py-3" colspan="2">Total Pengeluaran</td>
            <td class="px-4 py-3">Rp {{number_format($jumlahPengeluaran['jumlah_transaksi'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($jumlahPengeluaran['jumlah_anggaran'], 0, ',', '.')}}</td>
            <td class="px-4 py-3">Rp {{number_format($jumlahPengeluaran['selisih'], 0, ',', '.')}}</td>
        </tr>


        {{-- <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">Pendidikan</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Pembayaran Biaya Sekolah</td>
        </tr>

        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">Transportasi</td>
            <td class="px-4 py-3">Rp 2.000.000</td>
            <td class="px-4 py-3">Rp 2.100.000</td>
            <td class="px-4 py-3">Bensin</td>
        </tr>

        <tr class="border-b dark:border-gray-700 bg-red-100 font-semibold text-gray-800">
            <td class="px-4 py-3" rowspan="">Total</td>
            <td class="px-4 py-3">Kebutuhan</td>
            <td class="px-4 py-3" colspan="">Rp 12.000.000</td>
            <td class="px-4 py-3" colspan="">Rp 12.100.000</td>
            <td class="px-4 py-3" colspan="">Rp 100.000</td>
        </tr>

        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3" rowspan="3">Keinginan</td>
            <td class="px-4 py-3">Shoping</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Beli scin care</td>
        </tr>
        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">Bioskop</td>
            <td class="px-4 py-3">Rp 1.000.000</td>
            <td class="px-4 py-3">Rp 1.000.000</td>
            <td class="px-4 py-3">Nonton bioskop</td>
        </tr>
        <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">Belanja Barang Pribadi</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Rp 5.000.000</td>
            <td class="px-4 py-3">Beli Pakain</td>
        </tr>

        <tr class="border-b dark:border-gray-700 bg-red-100 font-semibold text-gray-800">
            <td class="px-4 py-3" rowspan="">Total</td>
            <td class="px-4 py-3">Keinginan</td>
            <td class="px-4 py-3" colspan="">Rp 11.000.000</td>
            <td class="px-4 py-3" colspan="">Rp 11.000.000</td>
            <td class="px-4 py-3" colspan="">Rp 0</td>
        </tr>

        <tr class="border-b dark:border-gray-700 bg-red-100 font-semibold text-gray-800">
            <td class="px-4 py-3" colspan="2">Total Pengeluaran</td>
            <td class="px-4 py-3" colspan="">Rp 21.000.000</td>
            <td class="px-4 py-3" colspan="">Rp 21.100.000</td>
            <td class="px-4 py-3" colspan="">Rp 100.000</td>
        </tr> --}}
    </tbody>
</table>