window.addEventListener("load", function () {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        let response = JSON.parse(this.responseText);
        function formatRupiah(angka) {
            if (isNaN(angka)) {
                return "N/A";
            }
            const formattedAngka = angka.toString().replace(/[^0-9\.]/g, "");
            const rupiah =
                "Rp. " +
                formattedAngka.toFixed(2).replace(/\d(?=(\d{3})+[^\d])/g, ".");
            return rupiah;
        }

        function getChartOptions() {
            return {
                colors: ["#d24f98", "#5d369c", "#9345a3"],
                chart: {
                    height: 320,
                    width: "100%",
                    type: "bar",
                },
                series: response.map((data) => ({
                    name: data.monthName,
                    data: [
                        numeral(data.income).format("0.0.0"),
                        numeral(data.outcome).format("0.0.0"),
                        numeral(data.saldo).format("0.0.0"),
                    ],
                })),
                chart: {
                    type: "bar",
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true,
                    },
                    zoom: {
                        enabled: true,
                    },
                },
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: "bottom",
                                offsetX: -10,
                                offsetY: 0,
                            },
                        },
                    },
                ],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: "13px",
                                    fontWeight: 900,
                                },
                            },
                        },
                    },
                },
                xaxis: {
                    type: "category",
                    categories: response.map((data) => data.monthName),
                    labels: {
                        formatter: function (value) {
                            return value.toUpperCase(); // Ubah ke huruf kapital
                        },
                    },
                },
                legend: {
                    position: "right",
                    offsetY: 40,
                },
            };
        }

        var chart = new ApexCharts(
            document.querySelector("#transaksiBulanan"),
            getChartOptions()
        );
        chart.render();
    };
    xhr.open("GET", "/get_keuangan_bulanan", true);
    xhr.send();
});
