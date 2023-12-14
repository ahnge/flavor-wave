@extends('layouts.app')

@section('content')
    <div class=" container bg-white  shadow  p-4 md:p-6 dark:bg-gray-800 rounded-md px-10 py-5 mx-auto max-w-screen-md">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <h1 class="text-2xl font-semibold mt-3 dark:text-white">Weekly data chart</h1>





        <div class="flex justify-center items-start w-full">
            <div class="flex-col items-center">
                <div class="py-3" id="pie-chart"></div>
            </div>


        </div>

    </div>

    <!-- Line Chart -->



    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: [1,2,2,],
                    colors: ["#1C64F2", "#16BDCA", "#9061F9", "#1C64F2", "#16BDCA", "#9061F9"],
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
                    labels: ["Direct", "Organic search", "Referrals"],
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

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }
        });
    </script>

    </div>

    <script>
        let chartsData = @json($chartsData);
        // Best Sales of the Week has 7 array and total sales has 14 arrays
        console.log(chartsData);
        // ApexCharts options and config
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: chartsData[3],
                    colors: ["#1C64F2", "#16BDCA", "#9061F9", "#F29F05", "#F2056E", "#05F259", "#A605F2",
                        "#F22D2D", "#2DF24D", "#2D6BF2", "#F22DE6", "#F2B22D", "#8B2DF2", "#2DF2EC"
                    ],
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
                    labels: chartsData[2],
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
                                return value
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
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
        });
    </script>
@endsection




@section('scripts')
    @apexchartsScripts
@endsection
