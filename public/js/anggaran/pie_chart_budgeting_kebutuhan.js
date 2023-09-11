const colors3 = ['#F98080', '#F05252', '#E02424', '#C81E1E', '#9B1C1C', '#771D1D', '#FACA15', '#E3A008', '#C27803', '#9F580A', '#8E4B10', '#723B13', '#633112', '#31C48D', '#0E9F6E', '#057A55', '#046C4E', '#03543F', '#014737', '#76A9FA', '#3F83F8', '#1C64F2', '#1A56DB', '#1E429F', '#233876', '#8DA2FB', '#6875F5', '#5850EC', '#5145CD', '#42389D', '#362F78', '#9061F9', '#7E3AF2', '#6C2BD9', '#5521B5', '#4A1D96', '#F17EB8', '#E74694', '#D61F69', '#BF125D', '#99154B', '#751A3D', '#16BDCA']

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


        const options = {
            style: 'currency',
            currency: 'IDR', // Kode mata uang untuk Rupiah Indonesia
            minimumFractionDigits: 0, // Jumlah desimal minimum (0 untuk Rupiah)
            maximumFractionDigits: 0, // Jumlah desimal maksimum (0 untuk Rupiah)
          };
          

        xhr.onload = function() {
            if(this.status === 200) {
                let response = JSON.parse(this.responseText)
                let legend_kebutuhan = [];
                let data_kebutuhan = [];
                response.forEach(res => {
                  if(res.kategori_anggaran == 1){
                    data_kebutuhan.push(parseInt(res.jumlah))
                    legend_kebutuhan.push(res.kategori_transaksi)
                  }
                });



                const getChartOptions2 = () => {
                    return {
                      series: data_kebutuhan,
                      colors: ["#1C64F2", "#16BDCA", "#9061F9"],
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
                            show: true,
                          },
                          size: "100%",
                          dataLabels: {
                            offset: -25
                          }
                        },
                      },
                      labels: legend_kebutuhan,
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
                            return value.toLocaleString('id-ID', options)
                          },
                        },
                      },
                      xaxis: {
                        labels: {
                          formatter: function (value) {
                            return value
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
            
                  if (document.getElementById("pie-chart_kebutuhan") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("pie-chart_kebutuhan"), getChartOptions2());
                    chart.render();
                  }
               
            }
        }
        
        xhr.open('GET', '/budgeting?data=kebutuhan', true)
        xhr.send()

    });