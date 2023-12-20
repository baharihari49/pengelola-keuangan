<section class="bg-gray-50 dark:bg-gray-900 mb-28">
    <div class="mx-auto">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 rounded-md relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Akun</th>
                            <th scope="col" class="px-4 py-3 text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">*
                                Pemasukan</th>
                            <td class="px-4 py-3 text-base text-right">Rp {{ number_format($pemasukan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @foreach ($pemasukanByKategori as $item)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white pl-10">
                                    - @if (strlen($item->nama) <= 19)
                                        {{ $item->nama }}
                                    @else
                                        {{ Str::limit($item->nama, 19) }}
                                    @endif
                                </th>
                                <td class="px-4 py-3 text-base text-right">Rp
                                    {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="border-b bg-gray-100 dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">TOTAL
                                PENDAPATAN</th>
                            <td class="px-4 py-3 text-base text-gray-800 font-semibold text-right">Rp
                                {{ number_format($pemasukan, 0, ',', '.') }}</td>
                        </tr>

                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">*
                                Pengeluaran</th>
                            <td class="px-4 py-3 text-base text-right">Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                            </td>
                        </tr>
                        @foreach ($pengeluaranByKategori as $item)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white pl-10">
                                    - @if (strlen($item->nama) <= 19)
                                        {{ $item->nama }}
                                    @else
                                        {{ Str::limit($item->nama, 19) }}
                                    @endif
                                </th>
                                <td class="px-4 py-3 text-base text-right">Rp
                                    {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="border-b bg-gray-100 dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">TOTAL
                                PENGELUARAN</th>
                            <td class="px-4 py-3 text-base text-gray-800 font-semibold text-right">Rp
                                {{ number_format($pengeluaran, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
