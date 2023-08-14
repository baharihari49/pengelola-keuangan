 // ApexCharts options and config
 window.addEventListener("load", function() {

    const lineChart = function(jumlahPendapatan, jumlahPengeluaran, dataTanggal) {
        let options = {
            // set the labels option to true to show the labels on the X and Y axis
            xaxis: {
              show: true,
              categories: dataTanggal,
              labels: {
                show: true,
                style: {
                  fontFamily: "Inter, sans-serif",
                  cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
              },
              axisBorder: {
                show: false,
              },
              axisTicks: {
                show: false,
              },
            },
            yaxis: {
              show: true,
              labels: {
                show: true,
                style: {
                  fontFamily: "Inter, sans-serif",
                  cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function (value) {
                  return 'Rp ' + value;
                }
              }
            },
            series: [
              {
                name: "Pendapatan",
                data: jumlahPendapatan,
                color: "#31C48D",
              },
              {
                name: "Pengeluaran",
                data: jumlahPengeluaran,
                color: "#F05252",
              },
            ],
            chart: {
              sparkline: {
                enabled: false
              },
              height: "100%",
              width: "100%",
              type: "area",
              fontFamily: "Inter, sans-serif",
              dropShadow: {
                enabled: false,
              },
              toolbar: {
                show: false,
              },
            },
            tooltip: {
              enabled: true,
              x: {
                show: false,
              },
            },
            fill: {
              type: "gradient",
              gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
              },
            },
            dataLabels: {
              enabled: true,
            },
            stroke: {
              width: 6,
            },
            legend: {
              show: true
            },
            grid: {
              show: false,
            },
          }
      
          if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("labels-chart"), options);
            chart.render();
          }
    }

    
    const xhr = new XMLHttpRequest();


    xhr.onload = function() {
        if(this.status === 200) {
            let response = JSON.parse(this.responseText)
            console.log(response);
            const dataJumlahPendapatan = response.map(res => res.jumlah)
           
            const xhr2 = new XMLHttpRequest()

            xhr2.onload = function() {
                if(this.status === 200) {
                    let response = JSON.parse(this.responseText)
                    console.log(response)
                    const dataJumlahPengeluaran = response.map(res => res.jumlah)
                    const dataTanggal = response.map(res => res.tanggal)
                    lineChart(dataJumlahPendapatan, dataJumlahPengeluaran)
                }
            }

            xhr2.open('GET', '/get_transaksi_by_jenis_transaksi_id_line_chart?id=2')
            xhr2.send()
        }
    }

    xhr.open('GET', '/get_transaksi_by_jenis_transaksi_id_line_chart?id=1', true)
    xhr.send()


  });