<section class="bg-white rounded-md shadow-md p-5">
    <div>
        <p class="text-xl font-semibold">Role : {{$data->name}}</p>
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
        <form action="/edit_permission" method="POST">
            @csrf
            <input type="hidden" value="{{$data->id}}" name="id">
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
                            <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                type="checkbox" name="permission[]" value="lihat transaksi" id=""
                                {{ in_array('lihat transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                type="checkbox" name="permission[]" value="tambah transaksi" id=""
                                {{ in_array('tambah transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                type="checkbox" name="permission[]" value="ubah transaksi" id=""
                                {{ in_array('ubah transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                type="checkbox" name="permission[]" value="hapus transaksi" id=""
                                 {{ in_array('hapus transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                type="checkbox" name="permission[]" value="cetak transaksi" id=""
                                {{ in_array('cetak transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
                <tbody id="kategori-transaksi" class="hidden">
                    <tr>
                        <td scope="col" class="px-4 py-3">Kategori Transaksi</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="lihat kategori transaksi" name="permission[]" id=""
                            {{ in_array('lihat kategori transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="tambah kategori transaksi" name="permission[]" id=""
                            {{ in_array('tambah kategori transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="ubah kategori transaksi" name="permission[]" id=""
                            {{ in_array('ubah kategori transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="hapus kategori transaksi" name="permission[]" id=""
                            {{ in_array('hapus kategori transaksi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="cetak kategori transaksi" name="permission[]" id=""
                            {{ in_array('cetal kategori transaksi', $rolePermissions) ? 'checked' : '' }}> --}}
                        </td>
                    </tr>
                </tbody>
                <tbody id="anggaran" class="hidden">
                    <tr>
                        <td scope="col" class="px-4 py-3">Anggaran</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="lihat anggaran" name="permission[]" id=""
                            {{ in_array('lihat anggaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="tambah anggaran" name="permission[]" id=""
                            {{ in_array('tambah anggaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="ubah anggaran" name="permission[]" id=""
                            {{ in_array('ubah anggaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="hapus anggaran" name="permission[]" id=""
                            {{ in_array('hapus anggaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                    </tr>
                </tbody>
                <tbody id="supplier" class="hidden">
                    <tr>
                        <td scope="col" class="px-4 py-3">CRUD Supplier</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="lihat supplier" name="permission[]" id=""
                            {{ in_array('lihat supplier', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="tambah supplier" name="permission[]" id=""
                            {{ in_array('tambah supplier', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="ubah supplier" name="permission[]" id=""
                            {{ in_array('ubah supplier', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" value="hapus supplier" name="permission[]" id=""
                            {{ in_array('hapus supplier', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                    </tr>
                </tbody>
                <tbody id="laporan" class="hidden">
                    <tr>
                        <td scope="col" class="px-4 py-3">Pemasukan</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat pemasukan" id=""
                            {{ in_array('lihat pemasukan', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="cetak pemasukan" id=""
                            {{ in_array('cetak pemasukan', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4 py-3">Pengeluaran</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat pengeluaran" id=""
                            {{ in_array('lihat pengeluaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="cetak pengeluaran" id=""
                            {{ in_array('cetak pengeluaran', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4 py-3">Laba Rugi</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat labarugi" id=""
                            {{ in_array('lihat labarugi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="cetak labarugi" id=""
                            {{ in_array('cetak labarugi', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
                <tbody id="administrator" class="hidden">
                    <tr>
                        <td scope="col" class="px-4 py-3">Users</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat user" id=""
                            {{ in_array('lihat user', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="tambah user" id=""
                            {{ in_array('tambah user', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="ubah user" id=""
                            {{ in_array('ubah user', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="hapus user" id=""
                            {{ in_array('hapus user', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4 py-3">Feedback Manage</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat feedback" id=""
                            {{ in_array('lihat feedback', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="ubah feedback" id=""
                            {{ in_array('ubah feedback', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="hapus feedback" id=""
                            {{ in_array('hapus feedback', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4 py-3">Akses Level</td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="lihat akseslevel" id=""
                            {{ in_array('lihat akseslevel', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="tambah akseslevel" id=""
                            {{ in_array('tambah akseslevel', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="ubah akseslevel" id=""
                            {{ in_array('ubah akseslevel', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" value="hapus akseslevel" id=""
                            {{ in_array('hapus akseslevel', $rolePermissions) ? 'checked' : '' }}>
                        </td>
                        <td align="center" scope="col" class="px-4 py-3">
                            {{-- <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permission[]" id=""> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
           <div class="flex justify-between mt-5 px-5">
            <a href="/akses_level">
                <button type="button" class="py-2 px-5 rounded-md bg-gray-300 text-gray-800">Kembali</button>
            </a>
            <button class="py-2 px-5 rounded-md bg-blue-600 text-white">Simpan</button>
           </div>
        </form>
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
