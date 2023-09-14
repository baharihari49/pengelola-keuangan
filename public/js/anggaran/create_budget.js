const btnBudget = Array.from(document.querySelectorAll('#btn_modal'))
const createBudget = document.getElementById('createBudget')

const btnCLose = document.getElementById('btnCloseModalBudget')
const modalBackdrop = document.getElementById('modalBackdrop')
const inputValue = document.getElementById('inputValue')
const fromBudget = document.getElementById('fromBudget')
const btnDeleteBudget = document.getElementById('btnDeleteBudget')
const fromDelete = document.getElementById('fromDelete')

const showModal = function(btnClicked, routes){

        createBudget.classList.remove('hidden')
        createBudget.classList.add('flex')
        modalBackdrop.classList.toggle('hidden')
        const dataBudget = btnClicked.getAttribute('data-budget')
        inputValue.value = dataBudget
        fromBudget.setAttribute('action', routes)

        reqAjax('GET', '/get_kategori_anggaran', function(err, response) {
            const dataBudget = btnClicked.getAttribute('data-budget')
            let show = false
            response.forEach((res, index) => {
                if(res.nama == dataBudget){
                    fromDelete.setAttribute('action', '/budgeting_delete?id=' + res.id)
                    show = true
                }else{
                    // btnDeleteBudget.style.display = 'none'
                }
            })

            if(show == true){
                btnDeleteBudget.style.display = ''
            }else{
                btnDeleteBudget.style.display = 'none'
            }
        })

}

btnBudget.forEach(bg => {
    bg.addEventListener('click', function() {
        
        showModal(bg, '/budgeting_post')
    })
})


btnCLose.addEventListener('click', function() {
    createBudget.classList.remove('flex')
    createBudget.classList.add('hidden')
    modalBackdrop.classList.toggle('hidden')
})
