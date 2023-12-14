@extends('layouts.app')

@section('content')
    <div class=" container bg-white  shadow  p-4 md:p-6 dark:bg-gray-800 rounded-md px-10 py-5 mx-auto max-w-screen-md">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <div class="flex flex-col  justify-center items-center  gap-4">
            <h1 class="text-2xl font-semibold mt-3 dark:text-white">Best Seller in this week</h1>


            <div class="flex justify-center items-start w-full">
                <div class="flex-col items-center">
                    <div class="py-3" id="pie-chart"></div>
                </div>


            </div>
        </div>


        <div class="flex flex-col  justify-center items-center  gap-4 mt-6">
            <h1 class="text-2xl font-semibold mt-3 dark:text-white">Best Sellers of All Time</h1>


            <div class="flex justify-center items-start w-full">
                <div class="flex-col items-center">
                    <div class="py-3" id="circle-chart"></div>
                </div>


            </div>
        </div>



    </div>

    <!-- Line Chart -->

    </div>
@endsection




@section('scripts')
    @apexchartsScripts

    <script>
        // ApexCharts options and config

        let chartsData = @json($chartsData);
        // Best Sales of the Week has 7 array and total sales has 14 arrays
        console.log(chartsData);

        const pieChartData = {};
        pieChartData.labels = chartsData[0].slice(0,9);
        pieChartData.data = chartsData[1].slice(0,9);

        const circleChartData = {};
        // get  only 4 element
        circleChartData.labels = chartsData[2].slice(0, 4);
        circleChartData.data = chartsData[3].slice(0, 4);

        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: pieChartData.data,
                    // colors:
                    chart: {
                        height: 420,
                        width: "130%",
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
                    labels: pieChartData.labels,
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
                            formatter: function(value) {
                                return value + "%"
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value + "%"
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

            const getCircleChartOptions = () => {
                return {
                    series: circleChartData.data,
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
                                        label: "Total Sales",
                                        fontFamily: "Inter, sans-serif",
                                        formatter: function(w) {
                                            const sum = w.globals.seriesTotals.reduce((a, b) => {
                                                return a + b
                                            }, 0)
                                            return `${sum}`
                                        },
                                    },
                                    value: {
                                        show: true,
                                        fontFamily: "Inter, sans-serif",
                                        offsetY: -20,
                                        formatter: function(value) {
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
                    labels: circleChartData.labels,
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value + "k"
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
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

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }

            if (document.getElementById("circle-chart") && typeof ApexCharts !== 'undefined') {
                const circleChart = new ApexCharts(document.getElementById("circle-chart"), getCircleChartOptions());
                circleChart.render();
            }
        });
    </script>
@endsection
