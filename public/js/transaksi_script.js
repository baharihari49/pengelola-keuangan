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


    const modalError = document.getElementById('modalError')
    const modalBackdrop = document.getElementById('modal-backdrop')

    function hiddenModal() {
        modalError.classList.add('hidden')
        modalBackdrop.remove()
    }


    const responseDataTransaksi = function() {
        const xhr = new XMLHttpRequest()

            const uuid = this.getAttribute('data-uuid')

            let jenisTransaksiId
            let kategoriTransaksiId

            updateProductModal.classList.replace('hidden', 'flex')

            document.body.appendChild(newElement)  
            
            xhr.onreadystatechange = async function () {
                if(this.readyState === 4 && this.status === 200) {
                    let response = JSON.parse(xhr.responseText)
                    response.forEach(res => {
                        detailTanggal.value = res.tanggal
                        detailJumlah.value = res.jumlah
                        detailDeskripsi.value = res.deskripsi
                        uuidDetail.value = uuid
                        oldKategoriTransaksiId.value = res.kategori_transaksi_id
                        btnDelete.setAttribute('data-uuid', res.uuid)
                        if(res.jenis_transaksi_id == 1) {
                            optionTransaksi[0].selected = true
                        }else if (res.jenis_transaksi_id == 2) {
                            optionTransaksi[1].selected = true
                        }
                        jenisTransaksiId = res.jenis_transaksi_id
                        kategoriTransaksiId = res.kategori_transaksi_id
                    })

                    let xhr2 = new XMLHttpRequest()

                    detailKategori.innerHTML = '<option selected="">Select category</option>'

                    await new Promise((resolve) => {
                        xhr2.onreadystatechange = function () {
                            if (this.readyState === 4 && this.status === 200) {
                                let response2 = JSON.parse(xhr2.responseText);
                                response2.forEach(res2 => {
                                    let option2 = document.createElement('option');
                                    option2.value = res2.id;
                                    option2.textContent = res2.nama;
                                    option2.classList.add('optionsDetailTransaksi');
                                    detailKategori.appendChild(option2);
                                });
                                resolve(); // Menyelesaikan promise saat selesai
                            }
                        };
                        xhr2.open('GET', 'get_kategori_transaksi_all_show_by_jenis_kategori_transaksi/?id=' + jenisTransaksiId, true);
                        xhr2.send();
                    });

                    // sedikit perbaikan, ini bisa menggunakan asyn await agar menjadi lebih baik

                    const optionsDetailTransaksi = Array.from(document.querySelectorAll('.optionsDetailTransaksi'));
                    for (let i = 0; i < optionsDetailTransaksi.length; i++) {
                        if (optionsDetailTransaksi[i].value == kategoriTransaksiId) {
                            optionsDetailTransaksi[i].selected = true;
                        }
                    }

                    // sedikit perbaikan, ini bisa menggunakan asyn await agar menjadi lebih baik


                }
            }

            jenisTransaksi.forEach(jt => {
                jt.addEventListener('change', function(){
                    detailKategori.innerHTML = '<option selected="">Select category</option>'
                    const xhr = new XMLHttpRequest()
                    xhr.onreadystatechange = function() {
                        if(this.readyState === 4 && this.status === 200) {
                            let response = JSON.parse(xhr.responseText)
                            response.forEach(res => {
                                let option = document.createElement('option')
                                option.value = res.id
                                option.textContent = res.nama
                                detailKategori.appendChild(option)
                            })
                        }
                    }
                    xhr.open('GET', '/get_kategori_transaksi_by_jenis_transaksi_id/?id=' +  jt.value, true)
                    xhr.send()
                })
            })


            xhr.open('GET', 'get_transaksi/?uuid=' + uuid, true)
            xhr.send()
    }

    let newElement = document.createElement('div')
    newElement.setAttribute('modal-backdrop', '')
    newElement.setAttribute('class', 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40')
    newElement.setAttribute('id', 'layar-gelap')

    updateProductButton.forEach(upb => {
        upb.addEventListener('click', responseDataTransaksi)
    });


    // close modal
        btnCloseModal.addEventListener('click', function() {
            // const layarGelap = document.getElementById('layar-gelap')
            updateProductModal.classList.toggle('hidden')
            document.body.removeChild(newElement)    
        })
    // close modal End


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
                console.log(response);
                tabelRow.forEach(tr => {
                    while(tr.firstChild) {
                        tr.removeChild(tr.firstChild)
                    }
                })
                if(response.length > 0) {
                    response.forEach((res, index) => {

                        let element = `<td class="px-4 py-3 w-3">${index + 1}</td>
                                        <th id="tabel-date" scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.tanggal}</th>
                                        <td id="tabel-date" class="px-4 py-3">${Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR', 
                                            minimumFractionDigits: 0,
                                        }).format(res.jumlah)}</td>
                                        <td id="tabel-date" class="px-4 py-3">${res.nama}</td>
                                        <td id="tabel-date" class="px-4 py-3">${(res.jenis_transaksi == 1) ? 'Pemasukan' : 'Pengeluaran'}</td>
                                        <td id="tabel-date" class="px-4 py-3">${res.deskripsi}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                <div class="flex gap-5 mr-5">
                                   <button data-uuid="${res.uuid}" id="updateProductButton">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                        <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
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

        xhr.open('GET', 'get_transaksi_by_jenis_transaksi_id/?id=' + this.value, true)
        xhr.send()
    })



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
                console.log(response);
                tabelRow.forEach(tr => {
                    while(tr.firstChild) {
                        tr.removeChild(tr.firstChild)
                    }
                })
                // rowTotalTransaksi.removeChild(rowTotalTransaksi.firstChild)
                if(response.length > 0) {
                    response.forEach((res, index) => {

                        let element = `<td class="px-4 py-3 w-3">${index + 1}</td>
                                        <th id="tabel-date" scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.tanggal}</th>
                                        <td id="tabel-date" class="px-4 py-3">${Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR', 
                                            minimumFractionDigits: 0,
                                        }).format(res.jumlah)}</td>
                                        <td id="tabel-date" class="px-4 py-3">${res.kategori_transaksi}</td>
                                        <td id="tabel-date" class="px-4 py-3">${(res.jenis_transaksi == 1) ? 'Pemasukan' : 'Pengeluaran'}</td>
                                        <td id="tabel-date" class="px-4 py-3">${res.deskripsi}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                <div class="flex gap-5 mr-5">
                                   <button data-uuid="${res.uuid}" id="updateProductButton">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                        <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
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