
<!-- Main modal -->
{{-- <div id="createBudget" tabindex="-1" aria-hidden="true"class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-screen inset-0 h-full border">
    <div class="relative p-4 w-full max-w-2xl h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white w-max rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Product
                </h3>
                <button id="btnCloseModalBudget" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createBudgett">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex flex-col items-center">
                <div class="w-fit">
                    @include('dashboard.anggaran.layouts.charts.donut_chart_budgeting_kebutuhan')
                </div>
                <form id="fromBudget" method="POST" class="">
                    <p class="text-xs text-gray-800 mb-1 mt-2">Keungan yang sehat umumnya 50% kebutuhan 30% kenginan 20% tabungan</p>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="persentase">Atur penggunaan uang kamu</label>
                    <input name="value" id="persentase" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" placeholder="50%">
                    <input id="inputValue" type="hidden" name="nama" value="">
                    @csrf
                <div class="flex gap-2">
                        <button type="submit" class="text-white mt-2 w-full text-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Simpan</button>
                </div>

                </form>
                <form id="fromDelete" method="POST" action="/budgeting_delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btnDeleteBudget"
                     class="text-white mt-2 w-full text-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Hapus
                    </button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div> --}}


<div id="createBudget" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-2xl h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah kategori transaksi
                </h3>
                <button id="btnCloseModalBudget" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createBudgett">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex flex-col items-center">
                <div class="w-fit">
                    @include('dashboard.anggaran.layouts.charts.donut_chart_budgeting_kebutuhan')
                </div>
                <form id="fromBudget" method="POST" class="">
                    <p class="text-xs text-gray-800 mb-1 mt-2">Keungan yang sehat umumnya 50% kebutuhan 30% kenginan 20% tabungan</p>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="persentase">Atur penggunaan uang kamu</label>
                    <input name="value" id="persentase" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" placeholder="50%">
                    <input id="inputValue" type="hidden" name="nama" value="">
                    @csrf
                <div class="flex w-full gap-2">
                            <div class="flex gap-2 w-full">
                                <button type="submit" class="text-white mt-2 w-full text-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Simpan</button>
                            </div>

                            </form>
                            <form id="fromDelete" method="POST" action="/budgeting_delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="btnDeleteBudget"
                                class="text-white mt-2 w-full text-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Hapus
                                </button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
