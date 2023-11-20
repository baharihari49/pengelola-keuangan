<section class="bg-white rounded-md shadow-md p-5">
    <div>
        <p>Role : Super Admin</p>
    </div>
    <hr class="mt-4 mb-6">
    <div class="flex relative mb-3">
        <button id="transaksi" class="btn_akses px-8 pb-3 border-b-4 z-10 border-blue-700">Transaksi</button>
        <button id="kategori-transaksi" class="btn_akses px-8 pb-3 border-b-4 z-10">Kategori Transaksi</button>
        <button id="anggaran" class="btn_akses px-8 pb-3 border-b-4 z-10">Anggaran</button>
        <button id="supplier" class="btn_akses px-8 pb-3 border-b-4 z-10">Supplier/Customer</button>
        <button id="laporan" class="btn_akses px-8 pb-3 border-b-4 z-10">Laporan</button>
        <button id="administrator" class="btn_akses px-8 pb-3 border-b-4 z-10">Administarator</button>
        <hr class="w-full absolute bottom-0 z-0 border-2">
    </div>
    <div>
        <table class="w-full">
            <thead>
                <th align="left" scope="col" class="px-4 py-3">Nama fitur</th>
                <th scope="col" class="px-4 py-3">Lihat</th>
                <th scope="col" class="px-4 py-3">Tambah</th>
                <th scope="col" class="px-4 py-3">ubah</th>
                <th scope="col" class="px-4 py-3">hapus</th>
                <th scope="col" class="px-4 py-3">cetak</th>
            </thead>
            <tbody id="transaksi" class="">
                <tr>
                    <td scope="col" class="px-4 py-3">CRUD Transaksi</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                </tr>
            </tbody>
            <tbody id="kategori-transaksi" class="hidden">
                <tr>
                    <td scope="col" class="px-4 py-3">Kategori Transaksi</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                </tr>
            </tbody>
            <tbody id="anggaran" class="hidden">
                <tr>
                    <td scope="col" class="px-4 py-3">Anggaran</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                </tr>
            </tbody>
            <tbody id="supplier" class="hidden">
                <tr>
                    <td scope="col" class="px-4 py-3">CRUD Supplier</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                </tr>
            </tbody>
            <tbody id="laporan" class="hidden">
                <tr>
                    <td scope="col" class="px-4 py-3">Pemasukan</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td scope="col" class="px-4 py-3">Pengeluaran</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td scope="col" class="px-4 py-3">Laba Rugi</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                </tr>
            </tbody>
            <tbody id="administrator" class="hidden">
                <tr>
                    <td scope="col" class="px-4 py-3">Users</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                </tr>
                <tr>
                    <td scope="col" class="px-4 py-3">Feedback Manage</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                </tr>
                <tr>
                    <td scope="col" class="px-4 py-3">Akses Level</td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id="">
                    </td>
                    <td align="center" scope="col" class="px-4 py-3">
                        {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="" id=""> --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<script>
const btnAkses = Array.from(document.querySelectorAll('.btn_akses'))
const tBody = Array.from(document.getElementsByTagName('tbody'))

btnAkses.forEach(item => {
    item.addEventListener('click', function() {
        btnAkses.forEach(btn => btn.classList.remove('border-blue-700'))
        item.classList.add('border-blue-700')
        console.log(item.getAttribute('id'));
        tBody.forEach(tb => {
            if(item.getAttribute('id') == tb.getAttribute('id')){
                console.log(tb.getAttribute('id'));
                tBody.forEach(tbd => tbd.classList.add('hidden'))
                tb.classList.remove('hidden')
            }
        })
    })
});
</script>
