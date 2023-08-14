const defaultModalButton = document.getElementById('defaultModalButton')
const kategoriAnggaran = document.getElementById('kategori-anggaran')
const updateProductButton = Array.from(document.querySelectorAll('#updateProductButton'))
const kategoriAnggaranUpdate = document.getElementById('kategori-anggaran-update')
const detailJumlah = document.getElementById('detail-jumlah')
const idAnggran = document.getElementById('id')
let dataId

defaultModalButton.addEventListener('click', function() {
    const xhr = new XMLHttpRequest();

    kategoriAnggaran.innerHTML = '<option selected="">Select category</option>'
    xhr.onload = function() {
        if(this.status === 200) {
            let response = JSON.parse(xhr.responseText);
            console.log(response);
            response.forEach(res => {
                const option = document.createElement('option')
                option.value = res.id
                option.textContent = res.nama
                kategoriAnggaran.appendChild(option)
            });
        }
    }

    xhr.open('GET', '/get_kategori_transaksi_by_jenis_transaksi_id_not_show/?id=2', true)
    xhr.send();
})

updateProductButton.forEach(updateProductButton => {
    updateProductButton.addEventListener('click', function() {
        const id = updateProductButton.getAttribute('data-id')
        const xhr = new XMLHttpRequest()

        kategoriAnggaranUpdate.innerHTML = '<option selected="">Select category</option>'
        
        let kategori

        xhr.onload = function() {
            if(this.status === 200) {
                const xhr2 = new XMLHttpRequest()
                xhr2.open('GET', '/get_anggaran_by_id?id=' + id, true)

                xhr2.onload = ()=> {
                    if(xhr2.status === 200) {
                        let response = JSON.parse(xhr2.responseText)
                        response.forEach(res => {
                            detailJumlah.value = res.jumlah
                            idAnggran.value = res.id
                            kategori = res.kategori_transaksi_id
                            dataId = res.id
                        })
                    }
                }
                xhr2.send()

                let response = JSON.parse(xhr.responseText)
                // Akan lebih baik menggunakan async await
                setTimeout(() => {
                    response.forEach(res => {
                    const option = document.createElement('option')
                    option.value = res.id
                    option.textContent = res.nama
                    if(res.id == kategori) {
                        option.selected = true
                    }
                    kategoriAnggaranUpdate.appendChild(option)
                });
                }, 100);
                // Akan lebih baik menggunakan async await
            }
        }

        xhr.open('GET', '/get_kategori_transaksi_by_jenis_transaksi_id_not_show/?id=2', true)
        xhr.send()
    })
})


// fitur Live search

const simpleSearch = document.getElementById('simple-search')
const tabelRow = Array.from(document.querySelectorAll('#tabel-row'))

simpleSearch.addEventListener('keyup', function() {
    const xhr = new XMLHttpRequest()

    xhr.onload = function() {
        if(this.status === 200) {
            let response = JSON.parse(this.responseText)
            tabelRow.forEach(tr => {
                while(tr.firstChild) {
                    tr.removeChild(tr.firstChild)
                }
            })
            response.forEach((res, index) => {
                let element = `<th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"> ${res.jumlah}
                                </th>
                                <td class="px-4 py-3">${res.kategori_transaksi}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-300 w-[100%] h-[7px] relative rounded">
                                            <div style="width: ${res.persentase}%" class="bg-blue-600 h-[7px] absolute rounded"></div>
                                        </div>
                                        <P>${res.persentase}%</P>
                                    </div>
                                </td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex gap-5 mr-5">
                                    <button data-id="{{$a->id}}" id="updateProductButton" data-modal-toggle="updateProductModal">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                        </svg>
                                    </button>
                                    </div>
                                </td>`
                tabelRow[index].innerHTML = element
            })
        }
    }

    xhr.open('GET', '/get_anggaran_by_kategori_transaksi?nama=' + this.value, true)
    xhr.send()
})

// fitur Live search End