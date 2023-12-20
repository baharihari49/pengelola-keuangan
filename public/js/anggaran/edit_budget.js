const btnEditBudget = Array.from(document.querySelectorAll('.btnEditBudget'))


btnEditBudget.forEach(item => {
    item.addEventListener('click', function() {
        showModal(item, '/budgeting_edit')
    })
})
