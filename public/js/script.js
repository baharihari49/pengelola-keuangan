// const { color } = require("echarts")

const containerChart = document.getElementById('container-chart')
const containerTabel = document.getElementById('container-table')

// window.addEventListener('load', function() {
//     const height = containerTabel.getClientRects()[0].height
//     containerChart.style.height = height + 'px'
// })






const btnToggleSideBar = document.getElementById('btn-toggle-sidebar')
const textSideBar = Array.from(document.querySelectorAll('#text-sidebar'))
const sideBar = document.getElementById('side-bar')
const iconSideBar = Array.from(document.querySelectorAll('#icon-sidebar'))
const containerSettings = Array.from(document.querySelectorAll('#container-settings'))
const mainSection = document.getElementById('main-section')

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
       }else{
        ts.style.display = ''
        sideBar.style.width = ''
        containerSettings.forEach(cs => {
            cs.style.flexDirection = 'row'
        })
        mainSection.style.marginLeft = ''
       }
    })
    show = !show
})

