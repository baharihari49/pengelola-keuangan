window.addEventListener("load", function() {

    const xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if(this.status === 200) {
            let response = JSON.parse(this.responseText)
            let nama = response.map(res => res.nama)
            let jumlah = response.map(res => parseInt(res.jumlah))

            const getChartOptions = () => {
            return {
              series: jumlah,
              colors: ['#d24f98','#5d369c', '#9345a3'],
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
              labels: nama,
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
                  show: true,
                },
              },
            }
            }

            if (document.getElementById("pie-chart-budgeting") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart-budgeting"), getChartOptions());
                chart.render();
            }
        }
    }

    xhr.open('GET', '/get_budgeting', true)
    xhr.send()

});
