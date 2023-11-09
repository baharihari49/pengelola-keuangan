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

 

    const modalError = document.getElementById('modalError')
    const modalBackdrop = document.getElementById('modal-backdrop')

    const selectTransaksi = document.getElementById('select-transaksi')
    const tabelDates = Array.from(document.querySelectorAll('#tabel-date'))
    const tabelRow = Array.from(document.querySelectorAll('#tabel-row'))
    const containerTabelDate = document.getElementById('container-tabel-date')
    const coloumnTotalTransaksi = document.getElementById('colom-total-transaksi')
    const rowTotalTransaksi = document.getElementById('baris-total-transaksi')

    selectTransaksi.addEventListener('change', function() {
        const xhr = new XMLHttpRequest()
        xhr.onload = function () {
            if(this.status === 200) {
                let response = JSON.parse(this.responseText)
                tabelRow.forEach(tr => {
                    while(tr.firstChild) {
                        tr.removeChild(tr.firstChild)
                    }
                })
                if(response.length > 0) {
                    response.forEach((res, index) => {  
                        let element = `
                                        <th id="tabel-date" scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.tanggal}</th>
                                        <td id="tabel-date" class="px-4 py-3">${res.no_transaksi}</td>
                                        <td id="tabel-date" class="px-4 py-3">${(res.jenis_transaksi_id == 1) ? '<i class="fa-solid fa-arrow-down-long" style="color: #25c137;"></i> Pemasukan' : (res.jenis_transaksi_id == 2) ? '<i class="fa-solid fa-arrow-up-long" style="color: #e61e1e;"></i> Pengeluaran' : `<i class="fa-solid fa-wallet" style="color: #1C64F2"></i> Tabungan`}</td>
                                        <td id="tabel-date" class="px-4 py-3 text-right">${Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR', 
                                            minimumFractionDigits: 0,
                                        }).format(res.jumlah)}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                <div class="flex gap-5 mr-5">
                                   <button data-uuid="${res.uuid}" id="updateProductButton" class="p-3 border bg-red-600 text-white rounded-full">
                                   <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                   viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                   <path
                                       d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z" />
                                    </svg>
                                   </button>

                                   <a href="/detail_transaksi/?uuid=${res.uuid}" class="p-3 border bg-blue-600 text-white rounded-xl"
                                                style="border-radius: 50%;"
                                                id="detailProductModal" title="Detail Transaksi">
                                                <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                                </svg>
                                            </a >
                                </div>
                            </td>`
                            

                            tabelRow[index].innerHTML = element
                            const modalDetailTransaksi = document.querySelectorAll('#modalDetailTransaksi')
                            updateProductButton.forEach(upb => {
                                upb.addEventListener('click', responseDataTransaksi)
                            });
                    })
                }else{
                    tabelRow.forEach(tr => {
                        while(tr.firstChild) {
                            tr.removeChild(tr.firstChild)
                        }
                    })
                }
            }
        }

        xhr.open('GET', 'get_transaksi_by_jenis_transaksi_id/?id=' + this.value, true)
        xhr.send()
    })

    function hiddenModal() {
        modalError.classList.add('hidden')
        modalBackdrop.remove()
    }


    const responseDataTransaksi = async function () {
        console.log(btnCloseModal);
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
                btnDelete.setAttribute('data-uuid', res.uuid);
                if (res.jenis_transaksi_id == 1) {
                    optionTransaksi[0].selected = true;
                } else if (res.jenis_transaksi_id == 2) {
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
    
// Assuming you have an array of jenisTransaksi elements
jenisTransaksi.forEach(jt => {
    jt.addEventListener('change', async function () {
        // Clear the supplier and detailKategori options
        kategoriSuplayerId.innerHTML = '<option value="0" selected="">Select Supplier/Customer</option>';

        try {
            // Fetch data supplier based on jenis_transaksi_id
            const response2 = await fetch(`/get_suplier_by_jenis_transaksi_id/?id=${jt.value}`);
            if (!response2.ok) {
                throw new Error(`HTTP error! Status: ${response2.status}`);
            }

            const data2 = await response2.json();

            data2.forEach(res => {
                let option = document.createElement('option');
                option.value = res.id;
                option.textContent = res.nama_bisnis;
                kategoriSuplayerId.appendChild(option);
            });

        } catch (error) {
            console.error('Error:', error);
        }
    });
});
    
    let newElement = document.createElement('div')
    newElement.setAttribute('modal-backdrop', '')
    newElement.setAttribute('class', 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40')
    newElement.setAttribute('id', 'layar-gelap')

    updateProductButton.forEach(upb => {
        upb.addEventListener('click', responseDataTransaksi)
    });

    updateProductButtonDetail.addEventListener('click', responseDataTransaksi)
  

    // detailTransaksiButton.forEach(item => {
    //     item.addEventListener('click', responseDataTransaksiDetail)
    // })




    // close modal
    // close modal End


   



    // buat fitu live search
    

    const barisSearch = document.getElementById('search-dropdown')
    const dropdwonBtn = document.getElementById('dropdown-button')
    const btnDropdwonChild = Array.from(document.querySelectorAll('#btn-dropdwon-child'))

    let param = 'Semua'
    btnDropdwonChild.forEach(btn => {
        btn.addEventListener('click', function() {
            dropdwonBtn.textContent = this.textContent
            barisSearch.placeholder =  this.textContent
            param = this.textContent
        })
    })

    barisSearch.addEventListener('keyup', function() {
        const xhr = new XMLHttpRequest()      
        xhr.onload = function() {
            if(this.status === 200) {
                let response = JSON.parse(this.responseText)
                tabelRow.forEach(tr => {
                    while(tr.firstChild) {
                        tr.removeChild(tr.firstChild)
                    }
                })
                // rowTotalTransaksi.removeChild(rowTotalTransaksi.firstChild)
                if(response.length > 0) {
                    response.forEach((res, index) => {

                        let element = `
                                        <th id="tabel-date" scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.tanggal}</th>
                                        <td id="tabel-date" class="px-4 py-3">${res.no_transaksi}</td>
                                        <td id="tabel-date" class="px-4 py-3">${(res.jenis_transaksi_id == 1) ? '<i class="fa-solid fa-arrow-down-long" style="color: #25c137;"></i> Pemasukan' : (res.jenis_transaksi_id == 2) ? '<i class="fa-solid fa-arrow-up-long" style="color: #e61e1e;"></i> Pengeluaran' : `<i class="fa-solid fa-wallet" style="color: #1C64F2"></i> Tabungan`}</td>
                                        <td id="tabel-date" class="px-4 py-3 text-right">${Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR', 
                                            minimumFractionDigits: 0,
                                        }).format(res.jumlah)}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                <div class="flex gap-5 mr-5">
                                   <button data-uuid="${res.uuid}" id="updateProductButton" class="p-3 border bg-red-600 text-white rounded-full">
                                   <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                   viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                   <path
                                       d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z" />
                                    </svg>
                                   </button>

                                   <button data-uuid="${res.uuid}" id="updateProductButton" class="p-3 border bg-blue-600 text-white rounded-full">
                                   <svg style="fill: #ffff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                                </svg>
                                   </button>
                                </div>
                            </td>`
                            

                            tabelRow[index].innerHTML = element
                            const updateProductButton = document.querySelectorAll('#updateProductButton')
                            updateProductButton.forEach(upb => {
                                upb.addEventListener('click', responseDataTransaksi)
                            });
                    })
                }else{
                    tabelRow.forEach(tr => {
                        while(tr.firstChild) {
                            tr.removeChild(tr.firstChild)
                        }
                    })
                }
            }
        }

        xhr.open('GET', '/get_transaksi_by_search?' + param + '=' + this.value, true)
        xhr.send();
    })

    // buat fitu live search End