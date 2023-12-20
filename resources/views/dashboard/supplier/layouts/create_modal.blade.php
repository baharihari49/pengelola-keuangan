<!-- Main modal -->
<div id="create_sup_cos" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Product
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="create_sup_cos">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="/supplier_or_customer">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="nama_bisnis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Bisnis</label>
                        <input type="text" name="nama_bisnis" id="nama_bisnis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="PT Boxity Central Indonesia" required="">
                    </div>
                    <div>
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Alamat bisnis" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="boxity@gmail.com" required="">
                    </div>
                    <div>
                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Handphone</label>
                        <input type="number" name="no_hp" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="083176939236" required="">
                    </div>
                    <div class="sm:col-span-2 grid grid-cols-2 gap-4">
                        <div class="">
                            <label for="tipe-supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe</label>
                            <select id="tipe-supplier" name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select Tipe</option>
                                <option value="1">Customer</option>
                                <option value="2">Supplier</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="jenis_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                            <select id="jenis_transaksi" name="jenis_transaksi_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select Jenis transaksi</option>
                                {{-- @foreach ($tipe as $item)
                                <option value="{{$item->id}}">{{($item->id === 1) ? 'Costumer' : 'Supplier'}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new product
                </button>
            </form>
        </div>
    </div>
    <script>

        const tipeSupllier = document.getElementById('tipe-supplier')
        const jenisTransaksi = document.getElementById('jenis_transaksi')

        tipeSupllier.addEventListener('input', async function () {
        try {
            const response = await fetch(`/get-jenis-transaksi-by-tipe-supplier/?id=${tipeSupllier.value}`);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            console.log(data);

            const jenisTransaksi = document.getElementById('jenis_transaksi')
            jenisTransaksi.innerHTML = '<option selected="">Select Jenis transaksi</option>'

            // const kategori = document.getElementById('kategori');
            // kategori.innerHTML = '<option selected="">Select Kategory</option>';

            data.forEach(res => {
                let option = document.createElement('option');
                option.value = res.id;
                option.textContent = res.nama;
                jenisTransaksi.appendChild(option);
            });
            // kategori.disabled = false;
        } catch (error) {
            console.error('Error:', error);
        }
    });
    </script>
</div>
