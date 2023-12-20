// const btnEditSup = Array.from(document.querySelectorAll('#btnEditSup'))
// const namaBisnis = document.getElementById('nama_bisnis_detail')
// const alamatBisnis = document.getElementById('alamat_detail')
// const emailBisnis = document.getElementById('email_detail')
// const noHp = document.getElementById('no_hp')
// const optTipe = Array.from(document.querySelectorAll('#optTipe'))
// const btnDeleteSupCos = document.getElementById('btnDeleteSup')
// const jnTransaksiSup = Array.from(document.querySelectorAll('#jnTransaksiSup'))

// btnEditSup.forEach(btnEditSup => {
//     btnEditSup.addEventListener('click', function() {
//         // console.log(btnDeleteSupCos);
//         fetch('get_sup_or_cos_by_no_hp/?id=' + this.getAttribute('data'))
//             .then(response => {
//                 if(!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }

//                 return response.json()
//             })
//             .then(data => {
//                 data.forEach(item => {
//                     namaBisnis.value = item.nama_bisnis
//                     alamatBisnis.value = item.alamat
//                     emailBisnis.value = item.email
//                     noHp.value = item.no_hp
//                     btnDeleteSupCos.setAttribute('data-id', item.id)
//                     optTipe.forEach(itemOpt => {
//                         if(item.jenis_transaksi_id == 1 || item.jenis_transaksi_id == 2) {
//                             optTipe[0].selected = true
//                         }else if(item.jenis_transaksi_id == 3 || item.jenis_transaksi_id == 4){
//                             optTipe[1].selected = true
//                         }
//                     })
//                     jnTransaksiSup.forEach((itemJnTran, index) => {
//                         if(item.jenis_transaksi_id == itemJnTran.value){
//                             itemJnTran.selected = true
//                             console.log(itemJnTran.value);
//                         }
//                     })
//                 });

//             })
//             .catch(error => {
//                 console.error('fetch error', error)
//             })
//     })
// })
