window.addEventListener("load", function () {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        let response = JSON.parse(this.responseText);

        function formatRupiah(angka) {
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "Rp. ",
            });
            return formatter.format(angka);
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
                    name: data.bulan_transaksi,
                    data: [
                        formatRupiah(data.income),
                        formatRupiah(data.outcome),
                        formatRupiah(data.saldo),
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
                    categories: response.map((data) => {
                        const date = new Date(data.bulan_transaksi, 0, 1);
                        console.log(date);
                        const formatter = new Intl.DateTimeFormat("id-ID", {
                            month: "long",
                        });
                        return formatter.format(date);
                    }),
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
