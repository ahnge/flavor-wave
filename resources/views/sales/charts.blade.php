@extends('layouts.app')

@section('content')
    <div class="max-w-lg w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-5">
            <div>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">$12,423</h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
            </div>

        </div>
        <div id="data-labels-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
            <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">

                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li id="0"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yearly
                        </li>
                        <li id="2"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Monthly
                        </li>
                        <li id="4"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Weekly

                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </div>

    <script>
        let chartsData = @json($chartsData);

        // Yearly names and prices are [0],[1]
        // Monthly names and prices are [2],[3]
        // Weekly names and prices are [4],[5]
        console.log(chartsData);




        let dropdownButton = document.getElementById("lastDaysdropdown")




        let options = {
            // enable and customize data labels using the following example, learn more from here: https://apexcharts.com/docs/datalabels/
            dataLabels: {
                enabled: true,
                // offsetX: 10,
                style: {
                    cssClass: 'text-xs text-white font-medium'
                },
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 16,
                    right: 16,
                    top: -26
                },
            },
            series: [{
                    name: "Developer Edition",
                    data: chartsData[1],
                    color: "#1A56DB",
                },

            ],
            chart: {
                height: "100%",
                maxWidth: "100%",
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
            legend: {
                show: true
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
            stroke: {
                width: 6,
            },
            xaxis: {
                categories: chartsData[0],
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
                labels: {
                    formatter: function(value) {
                        return '$' + value;
                    }
                }
            },
        }

        dropdownButton.addEventListener("click", function(e) {
            if (document.getElementById("data-labels-chart") && typeof ApexCharts !== 'undefined') {
                const selectedId = parseInt(e.target.id);
                const newChartData = chartsData[selectedId + 1];

                const chart = new ApexCharts(document.getElementById("data-labels-chart"), {
                    ...options,
                    series: [{
                        name: "Developer Edition",
                        data: newChartData,
                        color: "#1A56DB",
                    }],
                    xaxis: {
                        categories: chartsData[selectedId],
                        labels: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                });

                chart.render();
            }
        });


        // ApexCharts options and config


        window.addEventListener("load", function() {


            if (document.getElementById("data-labels-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("data-labels-chart"), options);
                chart.render();
            }
        });
    </script>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
