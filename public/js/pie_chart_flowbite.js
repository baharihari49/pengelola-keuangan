const colors = ['#F98080', '#F05252', '#E02424', '#C81E1E', '#9B1C1C', '#771D1D', '#FACA15', '#E3A008', '#C27803', '#9F580A', '#8E4B10', '#723B13', '#633112', '#31C48D', '#0E9F6E', '#057A55', '#046C4E', '#03543F', '#014737', '#76A9FA', '#3F83F8', '#1C64F2', '#1A56DB', '#1E429F', '#233876', '#8DA2FB', '#6875F5', '#5850EC', '#5145CD', '#42389D', '#362F78', '#9061F9', '#7E3AF2', '#6C2BD9', '#5521B5', '#4A1D96', '#F17EB8', '#E74694', '#D61F69', '#BF125D', '#99154B', '#751A3D', '#16BDCA']

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }
    // ApexCharts options and config
    window.addEventListener("load", function() {

        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if(this.status === 200) {
                let response = JSON.parse(this.responseText)
                const kategoriAnggaran = response.kategori_anggaran
                const jumlahAnggaran = response.anggaran
                
                const getChartOptions = () => {
                return {
                  series: jumlahAnggaran,
                  colors: shuffleArray(colors),
                  chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                  },
                  stroke: {
                    colors: ["white"],
                    lineCap: "",
                  },
                  plotOptions: {
                    pie: {
                      labels: {
                        show: false,
                      },
                      size: "100%",
                      dataLabels: {
                        offset: -25
                      }
                    },
                  },
                  labels: kategoriAnggaran,
                  dataLabels: {
                    enabled: true,
                    style: {
                      fontFamily: "Inter, sans-serif",
                    },
                  },
                  legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                  },
                  yaxis: {
                    labels: {
                      formatter: function (value) {
                        return value
                      },
                    },
                  },
                  xaxis: {
                    labels: {
                      formatter: function (value) {
                        return value  + "%"
                      },
                    },
                    axisTicks: {
                      show: false,
                    },
                    axisBorder: {
                      show: false,
                    },
                  },
                }
                }
        
                if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                    chart.render();
                }
            }
        }
        
        xhr.open('GET', '/get_all_anggaran', true)
        xhr.send()

    });