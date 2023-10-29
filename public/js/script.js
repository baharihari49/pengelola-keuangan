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



// preview image

const imageInput = document.querySelector('.file_input');
const profileImage = document.getElementById('user-image-review');
const dropzoneTailwind = document.getElementById('dropzone-tailwind');
const hapusButton = document.getElementById('hapus-preview')
const simpanGambar = document.getElementById('simpan-gambar')

hapusButton.addEventListener('click', function () {
    // Menghapus gambar preview dan mengatur kembali input file
    profileImage.src = '';
    imageInput.value = ''; // Mengatur kembali input file ke null
    hapusButton.classList.add('hidden')
    dropzoneTailwind.classList.remove('hidden');
    simpanGambar.disabled = true
  });
  
imageInput.addEventListener('change', function() {
  console.log('okee');
  const file = imageInput.files[0]; // Mengambil file dari input

    const imagePreview = new FileReader();

    imagePreview.onload = function (e) {
      profileImage.src = e.target.result; // Menampilkan gambar dalam elemen img
      dropzoneTailwind.classList.add('hidden');
      hapusButton.classList.remove('hidden')
      simpanGambar.disabled = false
    };

    imagePreview.readAsDataURL(file); // Membaca file sebagai data URL
});

function previewImage() {
  
}



// delete image 

