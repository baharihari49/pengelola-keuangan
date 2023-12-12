window.addEventListener("load", function () {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        let response = JSON.parse(this.responseText);

        function getChartOptions() {
            return {
                colors: ["#d24f98", "#5d369c", "#9345a3"],
                chart: {
                    height: 320,
                    width: "100%",
                    type: "bar",
                },
                series: [
                    {
                        name: "Income",
                        data: response.map((data) => data.income),
                    },
                    {
                        name: "Outcome",
                        data: response.map((data) => data.outcome),
                    },
                    {
                        name: "Saldo",
                        data: response.map((data) => data.saldo),
                    },
                ],
                xaxis: {
                    type: "category",
                    categories: response.map((data) => data.monthName),
                    labels: {
                        formatter: function (value) {
                            return value ? value.toUpperCase() : "";
                        },
                    },
                },
                yaxis: {
                    title: {
                        text: "IDR (Rupiahs)",
                    },
                    labels: {
                        formatter: function (value) {
                            return (
                                "Rp. " +
                                value.toLocaleString("id-ID", {
                                    minimumFractionDigits: 2,
                                })
                            );
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            // Convert the value to a number if it's a string
                            const value =
                                typeof val === "string" ? parseFloat(val) : val;
                            // Format the number with the thousands separator and two decimal places
                            return (
                                "Rp. " +
                                value.toLocaleString("id-ID", {
                                    minimumFractionDigits: 2,
                                })
                            );
                        },
                    },
                },
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
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
            };
        }

        var chart = new ApexCharts(
            document.querySelector("#donut-chart"),
            getChartOptions()
        );
        chart.render();
    };
    xhr.open("GET", "/get_keuangan_bulanan", true);
    xhr.send();
});
