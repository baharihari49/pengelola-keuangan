const btnDaysDropdwon = Array.from(document.querySelectorAll('#btn-days-dropdown'))
const tabelHeading = document.getElementById('tabel_heading')
const tabelRow = document.getElementById('tabel-row')


btnDaysDropdwon.forEach(btn => {
    btn.addEventListener('click', function() {
        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
                tabelRow.innerHTML = ''; // Menghapus semua isi dari <tbody>
                response.forEach(res => {
                    const tr = document.createElement('tr'); // Buat elemen <tr> baru
                    const th = document.createElement('th');
                    th.textContent = res.jumlah;
                    const td = document.createElement('td');
                    td.textContent = res.kategori_transaksi_id;
                    tr.appendChild(th); // Tambahkan <th> ke dalam <tr>
                    tr.appendChild(td); // Tambahkan <td> ke dalam <tr>
                    tabelRow.appendChild(tr); // Tambahkan <tr> ke dalam <tbody>
                });
            }
        };

        xhr.open('GET', '/get_transaksi_by_days?days=' + this.textContent, true);
        xhr.send();
    });
});