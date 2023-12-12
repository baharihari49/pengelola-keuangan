window.addEventListener("load", function () {
  const persentaseBudgeting = document.getElementById('persentase')
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    let response = JSON.parse(this.responseText)
    console.log(response);
    const getChartOptions = () => {
      return {
        series: [response],
        colors: ['#3F83F8', '#0E9F6E'],
        chart: {
          height: 320,
          width: "100%",
          type: "donut",
        },
        stroke: {
          colors: ["transparent"],
          lineCap: "",
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                name: {
                  show: true,
                  fontFamily: "Inter, sans-serif",
                  offsetY: 20,
                },
                total: {
                  showAlways: true,
                  show: true,
                  label: "Budget",
                  fontFamily: "Inter, sans-serif",
                  formatter: function (w) {
                    const sum = w.globals.seriesTotals.reduce((a, b) => {
                      return a + b
                    }, 0)

                    // Dapatkan nilai hasil dari array series (sebagai hasil index 0)
                    const hasil = w.globals.series[0];

                    const result = sum - hasil

                    return 'Rp ' + result.toLocaleString('id-ID')
                  },
                },
                value: {
                  show: true,
                  fontFamily: "Inter, sans-serif",
                  offsetY: -20,
                  formatter: function (value) {
                    return value + "k"
                  },
                },
              },
              size: "80%",
            },
          },
        },
        grid: {
          padding: {
            top: -2,
          },
        },
        labels: ["Pendapatan", "Sisa uang"],
        dataLabels: {
          enabled: false,
        },
        legend: {
          position: "bottom",
          fontFamily: "Inter, sans-serif",
        },
        yaxis: {
          labels: {
            formatter: function (value) {
              return value.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR', // Anda dapat mengganti mata uang sesuai kebutuhan, 'id-ID' untuk Bahasa Indonesia
                minimumFractionDigits: 0, // Jumlah desimal minimum (0 untuk Rupiah)
                maximumFractionDigits: 0, // Jumlah desimal maksimum (0 untuk Rupiah)
              });
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return value + "k"
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

    if (document.getElementById("donut-chart-budgeting-pemasukan") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("donut-chart-budgeting-pemasukan"), getChartOptions());
      chart.render();

      const test = function (event, chart) {
        if (persentaseBudgeting.value.length > 0) {
          const value = parseInt(persentaseBudgeting.value)
          const hasil = response * value / 100
          chart.updateSeries([hasil, response - hasil])
        } else {
          chart.updateSeries([response])
        }

      }

      persentaseBudgeting.addEventListener('keyup', (event) => test(event, chart))
    }
  }
   xhr.open('GET', '/budgeting', true)
   xhr.send()
   
});