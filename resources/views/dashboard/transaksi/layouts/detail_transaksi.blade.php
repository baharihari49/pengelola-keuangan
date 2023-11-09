@extends('dashboard.layouts.main')

@section('container')
@include('dashboard.transaksi.layouts.update_transaksi')
<section class="bg-white rounded-xl shadow-md p-5 mb-32">
    <div class="grid grid-cols-2 text-base text-gray-700">
        <div class="col-span-1">
            <table class="w-full">
                <tr class="">
                    <td class="py-3">No Transaksi</td>
                    <td> : {{$data[0]->no_transaksi}}</td>
                </tr>
                <tr>
                    <td class="py-3">Tanggal</td>
                    <td> : {{$data[0]->tanggal}}</td>
                </tr>
                <tr>
                    <td class="py-3">Deskripsi</td>
                    <td> : {{$data[0]->deskripsi ?? '--'}}</td>
                </tr>
                <tr>
                    <td class="py-3">Jenis Transaksi</td>
                    <td> : {{$data[0]->jenis_transaksi->nama}}</td>
                </tr>
            </table>
        </div>
        <div class="col-span-1">
            <table class="w-full">
                <tr class="">
                    <td class="py-3">Kategori Transaksi</td>
                    <td> : {{$data[0]->kategori_transaksi->nama}}</td>
                </tr>
                <tr class="">
                    <td class="py-3">{{($data[0]->jenis_transaksi_id == 1) ? 'Customer' : 'Supplier'}}</td>
                    <td> : {{$data[0]->supplier_or_customer->nama_bisnis ?? '--'}}</td>
                </tr>
                <tr class="">
                    <td class="py-3">Dibuat oleh</td>
                    <td> : {{(auth()->user()->nama != null) ? auth()->user()->nama : auth()->user()->username}}</td>
                </tr>
            </table>
        </div>
    </div>
    <hr class="mt-2 mb-6">
    <table class="w-full">
        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="w-full">
                <th scope="col" class="px-4 py-3 text-left">Kategori Transaksi</th>
                <th scope="col" class="pl-4 pr-7 py-3" align="right">Jumlah</th>
            </tr>
        </thead>
        <tr class="">
            <td class="text-lift px-4 py-3 text-gray-700">{{$data[0]->kategori_transaksi->nama}}</td>
            <td class="text-right pl-4 pr-7 py-3 font-bold text-base text-gray-700">
                {{number_format($data[0]->jumlah, 0, ',', '.')}}</td>
        </tr>
        <tr class="bg-gray-100">
            <td class="text-lift px-4 py-3 text-gray-700">Jumlah</td>
            <td class="text-right pl-4 pr-7 py-3 font-bold text-base text-gray-700">
                {{number_format($data[0]->jumlah, 0, ',', '.')}}</td>
        </tr>
    </table>
    <hr class="my-5">
    <nav>
        <div class="flex items-center gap-3">
            <button class="py-3 px-8 border rounded-md bg-red-600 text-white" data-uuid="{{ $data[0]->uuid }}" id="updateProductButtonDetail"
                title="Void Transaksi">
                <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z" />
                </svg>
            </button>
            <button class="bg-blue-700 py-2 px-6 text-white rounded-md font-medium">Print</button>
        </div>
    </nav>
</section>
<script>
   const updateProductButton = document.querySelectorAll('#updateProductButton')
    const detailTanggal = document.getElementById('detail-tanggal')
    const detailJumlah = document.getElementById('detail-jumlah')
    const optionTransaksi = document.querySelectorAll('#opt-jenis-transaksi')
    const jenisTransaksi = document.querySelectorAll('#jenis_transaksi')
    const detailKategori = document.getElementById('detail-kategori')
    const detailDeskripsi = document.getElementById('detail-deskripsi')
    const uuidDetail = document.getElementById('uuid')
    const kategoriTransaksiIdDetail = document.getElementById('kategori_transaksi_id')
    const oldKategoriTransaksiId = document.getElementById('old-kategori-transaksi-id')
    const updateProductModal = document.getElementById('updateProductModal')
    const btnCloseModal = document.getElementById('close-modal-update')
    const kategoriSuplayerId = document.getElementById('suplayer_id')
    const anggaranBollean = document.getElementById('anggaranBollean')
    const detailTransaksiButton = Array.from(document.querySelectorAll('#detailTransaksiButton'))
    const modalDetailTransaksi = document.getElementById('detailProductModal')
    const updateProductButtonDetail = document.getElementById('updateProductButtonDetail')
    const responseDataTransaksi = async function () {
        try {
            const uuid = this.getAttribute('data-uuid');
            let jenisTransaksiId;
            let kategoriTransaksiId;
    
            updateProductModal.classList.replace('hidden', 'flex');
            document.body.appendChild(newElement);
    
            // Fetch data dari API dengan menggunakan async/await
            const response = await fetch(`/get_transaksi/?uuid=${uuid}`);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            const data = await response.json();
            data.forEach(res => {
                detailTanggal.value = res.tanggal;
                detailJumlah.value = res.jumlah;
                detailDeskripsi.value = res.deskripsi;
                uuidDetail.value = uuid;
                oldKategoriTransaksiId.value = res.kategori_transaksi_id;
                anggaranBollean.value = res.anggaran
                console.log(res);
                if (res.jenis_transaksi_id == 1) {
                    console.log('okee1');
                    optionTransaksi[0].selected = true;
                } else if (res.jenis_transaksi_id == 2) {
                    console.log('okee2');
                    optionTransaksi[1].selected = true;
                }
            });

            const response2 = await fetch('/get_kategori_transaksi_by_jenis_transaksi_id/?id=' + data[0].jenis_transaksi_id)

            const data2 = await response2.json()

            detailKategori.innerHTML = '<option value="0" selected="">Select Kategori</option>';

            data2.forEach(res => {
                let option = document.createElement('option');
                option.value = res.id;
                option.textContent = res.nama;
                
                if(data[0].kategori_transaksi_id == res.id) {
                    option.selected = true
                }
                detailKategori.appendChild(option);
            })

            const jenis_transaksi_update = document.getElementById('jenis_transaks_update')



            jenis_transaksi_update.addEventListener('input', async function () {
                try {
                    const response = await fetch(`/get_kategori_transaksi_by_jenis_transaksi_id/?id=${ jenis_transaksi_update.value}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log(data);

                    const kategori = document.getElementById('detail-kategori');
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

        } catch (error) {
        }
    }

    btnCloseModal.addEventListener('click', function() {
        // const layarGelap = document.getElementById('layar-gelap')
        updateProductModal.classList.toggle('hidden')
        document.body.removeChild(newElement)    
    })

    let newElement = document.createElement('div')
    newElement.setAttribute('modal-backdrop', '')
    newElement.setAttribute('class', 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40')
    newElement.setAttribute('id', 'layar-gelap')


    updateProductButtonDetail.addEventListener('click', responseDataTransaksi)
</script>
@endsection
