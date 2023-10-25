// const { color } = require("echarts")

const containerChart = document.getElementById('container-chart')
const containerTabel = document.getElementById('container-table')






const btnToggleSideBar = document.getElementById('btn-toggle-sidebar')
const textSideBar = Array.from(document.querySelectorAll('#text-sidebar'))
const sideBar = document.getElementById('default-sidebar')
const iconSideBar = Array.from(document.querySelectorAll('#icon-sidebar'))
const containerSettings = Array.from(document.querySelectorAll('#container-settings'))
const mainSection = document.getElementById('main-section')
const footerSection = document.getElementById('footer-section')
const containerMain = document.getElementById('container-main')

let show = true

btnToggleSideBar.addEventListener('click', function() {
    textSideBar.forEach((ts, index) => {
       if(show) {
        ts.style.display = 'none'
        sideBar.style.width = '70px'
        containerSettings.forEach(cs => {
            cs.style.flexDirection = 'column'
        })
        mainSection.style.marginLeft = '4rem'
        console.log(footerSection);
        footerSection.style.marginLeft = '4rem'
       }else{
        ts.style.display = ''
        sideBar.style.width = ''
        containerSettings.forEach(cs => {
            cs.style.flexDirection = 'row'
        })
        mainSection.style.marginLeft = ''
        footerSection.style.marginLeft = ''
       }
    })
    show = !show
})

