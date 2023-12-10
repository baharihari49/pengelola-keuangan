window.addEventListener("load", function() {
   const xhr = new XMLHttpRequest();
   xhr.onload = function() {
    let response = JSON.parse(this.responseText)
    const getChartOptions = () => {
      return {
        series: response,
        colors: ["#F05252", "#0E9F6E"],
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
                  label: "Pendapatan bulan ini",
                  fontFamily: "Inter, sans-serif",
                  formatter: function (w) {
                    const sum = w.globals.seriesTotals.reduce((a, b) => {
                      return a + b
                    }, 0)
                    return sum.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).split(',')[0]
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
        labels: ["Pengeluaran","Sisa uang"],
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
              return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).split(',')[0];
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return value  + "k"
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

    if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
      chart.render();
    }
   }

  xhr.open('GET', '/get_perbandingan_pemasukan_pengeluaran', true)
  xhr.send()

});
