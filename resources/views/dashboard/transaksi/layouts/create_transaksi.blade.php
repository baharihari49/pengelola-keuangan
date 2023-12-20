<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full border md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-2xl h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah transaksi
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="/transaksi" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="tanggal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                    </div>
                    <div>
                        <label for="jumlah"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">jumlah</label>
                            <input oninput="updateFormattedCurrency(this)" type="number" name="jumlah" id="jumlah"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="250.000" required="">
                        <div id="formattedCurrency"></div>

                    </div>
                    <div>
                        <label for="jenis_transaksi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                        <select name="jenis_transaksi_id" id="jenis_transaksi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select Jenis Transaksi</option>
                            @foreach ($jenis_transaksi as $jt)
                            <option value="{{$jt->id}}">{{$jt->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="kategori"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="kategori_transaksi_id" id="kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select Kategory</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="suplayer"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier/Customer</label>
                        <select name="suppliers_or_customers_id" id="suplayer_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option id="0" selected="">Select Supplier/Customer</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="deskripsi" id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tulis deskripsi transaksi seperti belanja sayuran buat kebutuhan dapur"></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Transaksi Baru
                </button>
            </form>
        </div>
    </div>
</div>

<script>

    const jenis_transaksi = document.getElementById('jenis_transaksi')
    const kategori = document.getElementById('kategori')

    // jenis_transaksi.addEventListener('click', async function () {
    //     try {
    //         const response = await fetch(`/get_kategori_transaksi_by_jenis_transaksi_id/?id=${jenis_transaksi.value}`);
    //         if (!response.ok) {
    //             throw new Error(`HTTP error! Status: ${response.status}`);
    //         }

    //         const data = await response.json();
    //         console.log(data);

    //         const kategori = document.getElementById('kategori');
    //         kategori.innerHTML = '<option selected="">Select category</option>';

    //         data.forEach(res => {
    //             let option = document.createElement('option');
    //             option.value = res.id;
    //             option.textContent = res.nama;
    //             kategori.appendChild(option);
    //         });
    //         kategori.disabled = false;
    //     } catch (error) {
    //         console.error('Error:', error);
    //     }
    // });


    jenis_transaksi.addEventListener('input', async function () {
        try {
            const response = await fetch(`/get_kategori_transaksi_by_jenis_transaksi_id/?id=${jenis_transaksi.value}`);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            console.log(data);

            const kategori = document.getElementById('kategori');
            kategori.innerHTML = '<option selected="">Select Kategory</option>';

            data.forEach(res => {
                let option = document.createElement('option');
                option.value = res.id;
                option.textContent = res.nama;
                kategori.appendChild(option);
            });
            kategori.disabled = false;
        } catch (error) {
            console.error('Error:', error);
        }
    });

    function updateFormattedCurrency(input) {
    // Mengambil nilai yang dimasukkan oleh pengguna
    let value = input.value;

    // Menghilangkan semua karakter selain digit dan koma (,)
    value = value.replace(/[^\d,]/g, '');

    // Mengganti semua koma (,) yang tidak memiliki digit setelahnya dengan titik (.)
    value = value.replace(/,(?![\d,]*\d)/g, '.');

    // Menghapus semua simbol "Rp"
    value = value.replace(/Rp/g, '');

    // Mengubah nilai menjadi format angka
    const numericValue = parseFloat(value) || 0;

    // Mengubah nilai menjadi format mata uang
    const formatMataUang = numericValue.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });

    // Menampilkan nilai dalam format mata uang di elemen lain
    document.getElementById("formattedCurrency").textContent = formatMataUang;
}




</script>
