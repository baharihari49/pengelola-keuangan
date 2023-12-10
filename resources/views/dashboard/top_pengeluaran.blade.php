<section class="">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-sm">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-sm">jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-body">
                        @foreach ($topPengeluaran as $index => $item)
                            <tr id="tabel-row" class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 text-red-600 font-medium">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-red-600 font-medium">
                                    {{ substr($item['nama'], 0, 15) }}
                                </td>
                                <td class="px-4 py-3 text-red-600 font-medium">Rp
                                    {{ number_format($item['total_jumlah'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
