@extends('layouts.app')

@section('content')
    <div class=" container rounded-md px-10 py-5 mx-auto max-w-screen-lg">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <h1 class="text-2xl font-semibold my-7 dark:text-white">Data charts</h1>



        <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 pb-4">
            <div class="flex justify-between items-center pt-5  px-8">
                <div class="">

                </div>
                <!-- Button -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                    data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    This Week
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
                        <li>
                            <a data-period="week"
                                class="chartPeriod block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">This
                                Week</a>
                        </li>
                        <li>
                            <a data-period="month"
                                class="chartPeriod block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">This
                                Month</a>
                        </li>
                        <li>
                            <a data-period="year"
                                class="chartPeriod block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">This
                                Year</a>
                        </li>
                    </ul>
                </div>
                {{-- <a href="#"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Sales Report
                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </a> --}}
            </div>
            <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
                <div>
                    <h5 id="totalAmount" class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2"></h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
                </div>
                {{-- <div
                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                    23%
                    <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div> --}}
            </div>
            <div id="labels-chart" class="px-2.5"></div>

        </div>





    </div>
@endsection

@section('scripts')
    <script type="module">
        window.addEventListener("load", function() {

            let chartData = @json($chartsData);
            console.log(chartData)

            const thisYearLabels = chartData[0];
            const thisYearData = chartData[1];

            const ThisMonthLabel = chartData[2];
            const ThisMonthData = chartData[3];

            const ThisWeekLabel = chartData[4];
            const ThisWeekData = chartData[5];

            const intitalChart = {};
            intitalChart.labels = ThisWeekLabel;
            intitalChart.data = ThisWeekData;

            let lastData = Math.max(...ThisWeekData)  <=  0 ? "0" : Math.max(...ThisWeekData);

            $("#totalAmount").text(lastData + "Ks");

            let options = {
                // set the labels option to true to show the labels on the X and Y axis
                xaxis: {
                    show: true,
                    categories: intitalChart.labels,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: true,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        },
                        formatter: function(value) {
                            return value + "Ks";
                        }
                    }
                },
                series: [{
                        name: "Total Sales",
                        data: intitalChart.data,
                        color: "#1A56DB",
                    },

                ],
                chart: {
                    sparkline: {
                        enabled: false
                    },
                    height: "100%",
                    width: "100%",
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
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false,
                },
            }

            if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("labels-chart"), options);
                chart.render();


                const changePeriod = (period) => {
                    if (period == 'week') {
                        $("#dropdownDefaultButton").text('This Week');
                        intitalChart.labels = ThisWeekLabel;
                        intitalChart.data = ThisWeekData;
                        // last index of  data
                        let lastData = Math.max(...ThisWeekData) <= 0 ? "0" : Math.max(...ThisWeekData);

                        $("#totalAmount").text(lastData  + "Ks");

                    } else if (period == 'month') {
                        $("#dropdownDefaultButton").text('This Month')
                        intitalChart.labels = ThisMonthLabel;
                        intitalChart.data = ThisMonthData;
                        let lastData = ThisMonthData.slice(-1) <= 0 ? "0" : ThisMonthData.slice(-1);

                        $("#totalAmount").text(lastData  + "Ks");
                    } else if (period == 'year') {
                        $("#dropdownDefaultButton").text('This Year')
                        intitalChart.labels = thisYearLabels;
                        intitalChart.data = thisYearData;
                        let lastData = thisYearData.slice(-1) <= 0 ? "0" : thisYearData.slice(-1);

                        $("#totalAmount").text(lastData  + "Ks");
                    }
                    // refresh  option with  new intitalChart
                    console.log(intitalChart);
                    // options.series[0].data = intitalChart.data;
                    // options.xaxis.categories = intitalChart.labels;
                    chart.updateOptions({
                        series: [{
                            data: intitalChart.data
                        }],
                        xaxis: {
                            categories: intitalChart.labels
                        }
                    })
                }

                $(".chartPeriod").each(function() {
                    $(this).click(function() {
                        const period = $(this).data('period');
                        changePeriod(period);
                    })
                });
            }




        });
    </script>
    @apexchartsScripts
@endsection
