const btnBudget = Array.from(document.querySelectorAll('#btn_modal'))
const createBudget = document.getElementById('createBudget')

const btnCLose = document.getElementById('btnCloseModalBudget')
const modalBackdrop = document.getElementById('modalBackdrop')
const inputValue = document.getElementById('inputValue')
const fromBudget = document.getElementById('fromBudget')
const btnDeleteBudget = document.getElementById('btnDeleteBudget')

const showModal = function(btnClicked, routes){
    const xhr = new XMLHttpRequest();
    
        xhr.onload = function() {
            if(this.status === 200){
                let response = JSON.parse(this.responseText)
                const dataBudget = btnClicked.getAttribute('data-budget')
                console.log(response);
                console.log(dataBudget);
            }
        }
    
        xhr.open('GET','/get_kategori_anggaran', true)
        xhr.send()
        createBudget.classList.remove('hidden')
        createBudget.classList.add('flex')
        modalBackdrop.classList.toggle('hidden')
        const dataBudget = btnClicked.getAttribute('data-budget')
        inputValue.value = dataBudget
        fromBudget.setAttribute('action', routes)
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
