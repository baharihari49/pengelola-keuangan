<section class="mb-20">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-sm">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-sm">Jumlah</th>
                            <th scope="col" class="px-4 py-3 text-sm">Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-body">
                        @foreach ($transaksiTerkini as $item)
                            <tr id="tabel-row" class="border-b dark:border-gray-700">
                                <td style="color: {{ $item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424') }}"
                                    class="px-4 py-3 font-medium text-sm">
                                    {{-- {{ substr($item['kategori_transaksi']->nama, 0, 25) ?? '--' }} --}}
                                    @if (strlen($item['kategori_transaksi']->nama ?? '--') <= 15)
                                        {{ $item['kategori_transaksi']->nama ?? '-- ' }}
                                    @else
                                        {{ Str::limit($item['kategori_transaksi']->nama, 15) }}
                                    @endif
                                </td>

                                <th scope="row"
                                    style="color: {{ $item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424') }}"
                                    class="px-4 py-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    {{ $item['jenis_transaksi_id'] == 1 ? '+ Rp ' : '- Rp ' }}{{ number_format($item['jumlah'], 0, ',', '.') }}
                                </th>
                                <th scope="row"
                                    style="color: {{ $item['jenis_transaksi_id'] == 1 || $item['jenis_transaksi_id'] == 4 ? '#057A55' : ($item['jenis_transaksi_id'] == 3 ? '#1C64F2' : '#E02424') }}"
                                    class="px-4 py-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    {{ $item['tanggal'] }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
