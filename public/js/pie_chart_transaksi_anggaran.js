    window.addEventListener("load", function() {

        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if(this.status === 200) {
                let response = JSON.parse(this.responseText)
                console.log(response);
                const getChartOptions = () => {
                return {
                  series: response,
                  colors: ['#F05252', '#0E9F6E'],
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
                  labels: ['Anggaran', 'Sisa pendapatan'],
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
                        return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).split(',')[0];
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
        
                if (document.getElementById("pie-chart-persentase-transaksi-anggaran") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("pie-chart-persentase-transaksi-anggaran"), getChartOptions());
                    chart.render();
                }
            }
        }
        
        xhr.open('GET', '/get_persentase_transaksi_anggaran', true)
        xhr.send()

    });