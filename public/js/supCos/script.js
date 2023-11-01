const btnEditSup = Array.from(document.querySelectorAll('#btnEditSup'))
const namaBisnis = document.getElementById('nama_bisnis_detail')
const alamatBisnis = document.getElementById('alamat_detail')
const emailBisnis = document.getElementById('email_detail')
const noHp = document.getElementById('no_hp')
const optTipe = Array.from(document.querySelectorAll('#optTipe'))
const btnDeleteSupCos = document.getElementById('btnDeleteSup')

btnEditSup.forEach(btnEditSup => {
    btnEditSup.addEventListener('click', function() {
        // console.log(btnDeleteSupCos);
        fetch('get_sup_or_cos_by_no_hp/?no_hp=' + this.getAttribute('data'))
            .then(response => {
                if(!response.ok) {
                    throw new Error('Network response was not ok');
                }
    
                return response.json()
            }) 
            .then(data => {
                data.forEach(item => {
                    namaBisnis.value = item.nama_bisnis
                    alamatBisnis.value = item.alamat
                    emailBisnis.value = item.email
                    noHp.value = item.no_hp
                    btnDeleteSupCos.setAttribute('data-id', item.id)
                    console.log(btnDeleteSupCos);
                    optTipe.forEach(itemOpt => {
                        if(item.jenis_transaksi_id == itemOpt.value) {
                            itemOpt.selected = true
                        }
                    })
                });
                
            })
            .catch(error => {
                console.error('fetch error', error)
            })
    })
})