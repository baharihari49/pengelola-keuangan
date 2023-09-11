const btnDaysDropdwon = Array.from(document.querySelectorAll('#btn-days-dropdown'))
const tabelHeading = document.getElementById('tabel_heading')
const tabelRow = Array.from(document.querySelectorAll('#tabel-row'))
const tabelBody = document.getElementById('tabel-body')


btnDaysDropdwon.forEach(btn => {
    btn.addEventListener('click', function() {
        const xhr = new XMLHttpRequest();
        while(tabelBody.firstChild){
            tabelBody.removeChild(tabelBody.firstChild)
        }
        console.log(tabelRow)
        xhr.onload = function() {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
                console.log(response);
                response.forEach((res, index) => {
                    tabelRow2 = document.createElement('tr')
                    let element = `<th scope="row"
                                            class="px-4 py-3 text-base text-${(res.jenis_transaksi_id == 1) ? `green-600` : `red-600`} font-medium whitespace-nowrap dark:text-white">${(res.jenis_transaksi_id == 1 ) ? `+ ${res.jumlah}` : `- ${res.jumlah}`}</th>
                                        <td class="px-4 py-3 text-${(res.jenis_transaksi_id == 1) ? `green-600` : `red-600`} text-base">${res.kategori_transaksi}</td>`
                    tabelRow2.innerHTML = element
                    tabelBody.appendChild(tabelRow2)
                });
            }
        };

        xhr.open('GET', '/get_transaksi_by_days?days=' + this.textContent, true);
        xhr.send();
    });
});