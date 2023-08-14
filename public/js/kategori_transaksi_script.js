const btnUpdate = Array.from(document.querySelectorAll('#updateProductButton'))
const detailNama = document.getElementById('detail-nama')
const jenisTransaksi = document.getElementById('jenis_transaksi_id')
const options = Array.from(document.querySelectorAll('.options'))
const fromUpdate = document.getElementById('form-update')



let newElement = document.createElement('div')
    newElement.setAttribute('modal-backdrop', '')
    newElement.setAttribute('class', 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40')
    newElement.setAttribute('id', 'layar-gelap')

const updateProductModal = document.getElementById('updateProductModal')
const btnCloseModal = document.getElementById('btn-close-modal')

const resData = function() {
    updateProductModal.classList.replace('hidden', 'flex')
    
    document.body.appendChild(newElement)  
    let xhr = new XMLHttpRequest()
    xhr.onload = function () {
        if(this.status === 200) {
            let respone = JSON.parse(xhr.responseText)
            respone.forEach(res => {
                detailNama.value = res.nama
                btnDelete.setAttribute('data-id', res.id)
                fromUpdate.setAttribute('action', '/kategori_transaksi/?id=' + res.id)
                for(let i = 0; i < options.length; i++){
                    if(options[i].value == res.jenis_transaksi_id){
                        options[i].selected = true
                    }else if (options[i].value == res.jenis_transaksi_id){
                        options[i].selected = true
                    }
                }
            })
        }
    }
    xhr.open('GET', '/get_kategori_transaksi_by_id/?id=' + this.getAttribute('data-id'), true);
    xhr.send()
}


btnUpdate.forEach(btnUpdate => {
    btnUpdate.addEventListener('click', resData)
});

btnCloseModal.addEventListener('click', function(){
    updateProductModal.classList.toggle('hidden')
    document.body.removeChild(newElement)
})





const selectKategoriTransaksion = document.getElementById('select-transaksi')

selectKategoriTransaksion.addEventListener('change', function(){
    const xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if(this.status === 200 && this.readyState === 4){
            let response = JSON.parse(this.responseText)
            tabelRow.forEach(tr => {
                while(tr.firstChild) {
                    tr.removeChild(tr.firstChild)
                }
            })
            response.forEach((res, index) => {
                let element = `<th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.nama}
                                </th>
                                <td class="px-4 py-3">${(res.jenis_transaksi_id == 1) ? 'Pendapatan' : 'Pengeluaran'}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex gap-5 mr-5">
                                    <button data-id="${res.id}" id="updateProductButton">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                        </svg>
                                    </button>
                                    </div>
                                </td>`

                tabelRow[index].innerHTML = element;
                const btnUpdate = Array.from(document.querySelectorAll('#updateProductButton'))

                btnUpdate.forEach(btnUpdate => {
                    btnUpdate.addEventListener('click', resData)
                });
            })
        }
    }

    xhr.open('GET', '/get_kategori_transaksi_by_jenis_transaksi_select?id=' + this.value, true)
    xhr.send()
})











// FItur Live Search

const simpleSearch = document.getElementById('simple-search')
const tabelRow = Array.from(document.querySelectorAll('#tabel-row'))

simpleSearch.addEventListener('keyup', function() {
    const xhr = new XMLHttpRequest()

    xhr.onreadystatechange = function() {
        if(this.status === 200 && this.readyState === 4) {
            let response = JSON.parse(this.responseText)
            tabelRow.forEach(tr => {
                while(tr.firstChild) {
                    tr.removeChild(tr.firstChild)
                }
            })
            response.forEach((res, index) => {
                let element = `<th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${res.nama}
                                </th>
                                <td class="px-4 py-3">${(res.jenis_transaksi_id == 1) ? 'Pendapatan' : 'Pengeluaran'}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex gap-5 mr-5">
                                    <button data-id="${res.id}" id="updateProductButton">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                        </svg>
                                    </button>
                                    </div>
                                </td>`

                tabelRow[index].innerHTML = element;
                const btnUpdate = Array.from(document.querySelectorAll('#updateProductButton'))

                btnUpdate.forEach(btnUpdate => {
                    btnUpdate.addEventListener('click', resData)
                });
            })
        }
    }

    xhr.open('GET', '/get_kategori_transaksi_by_search?search=' + this.value, true)
    xhr.send()
})

// FItur Live Search End
