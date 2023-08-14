window.addEventListener('load', function() {       
    const xhr = new XMLHttpRequest()

    xhr.onreadystatechange = function() {
        if(this.status === 200 && this.readyState === 4) {
            let response = JSON.parse(this.responseText)
            let anggaran = response.anggaran
            let kategoriAnggaran = response.kategori_anggaran

            let dataChart = anggaran.map((value, index) => {
                return {
                    value: value,
                    name: kategoriAnggaran[index]
                }
            })

            var myChart = echarts.init(document.getElementById('main'));

            // Specify the configuration items and data for the chart
            option = {
                title: {
                  // show: false,
                  text: 'Data Anggaran',
                  // subtext: 'Fake Data',
                  left: 'center'
                },
                tooltip: {
                  trigger: 'item'
                },
                legend: {
                  show: false,
                  orient: 'vertical',
                  left: 'left'
                },
                series: [
                  {
                    name: 'Access From',
                    type: 'pie',
                    radius: '50%',
                    data: dataChart,
                    emphasis: {
                      itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                      }
                    }
                  }
                ]
              };
            
            // Display the chart using the configuration items and data just specified.
            myChart.setOption(option);


        }
    }

    xhr.open('GET', '/get_all_anggaran', true)
    xhr.send()
})