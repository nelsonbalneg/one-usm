@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration Analytics
@endsection


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">PRE-REGISTRATION Analytics </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Analytics
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

        <!-- Chart 1 -->
        <div class="xl:col-span-12">
            <div class="card" id="usersTable">
                <div class="card-body">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500">PRE-REGISTRATION ANALYTICS</h6>
                    <p class="rounded-md text-slate-500">
                        The figures below show the turnout of CEE passers versus enrolled examinees.
                    </p>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <div id="GroupedChartTurnout" class="apex-charts" data-chart-colors='["bg-custom-500", "bg-green-500"]'
                        dir="ltr"></div>
                </div>
            </div>
        </div>

        <!-- Chart 2 -->
        <div class="xl:col-span-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500">FIRST GENERATION STUDENTS</h6>
                    <p class="rounded-md text-slate-500">
                        The figures below show the number of first generation enrolled freshmen students.
                    </p>

                    <div class="flex flex-wrap gap-2 mt-2 toolbar">
                        @foreach ($cee_sessions as $session)
                            <a href="{{ route('admin.preregistration.analytics.first-generation-students.details', ['termid' => $session->id]) }}"
                                class="session-btn px-2 py-1.5 text-xs text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white [&.active]:bg-custom-500 [&.active]:text-white">
                                {{ $session->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <div id="lineAreaChart" class="apex-charts" data-chart-colors='["bg-custom-200", "bg-green-500"]'
                        dir="ltr"></div>
                </div>
            </div>
        </div>

        <!-- Two-column section -->
        <div class="xl:col-span-12">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 xl:gap-8">

                <!-- Card 1 -->
                <div class="h-full card">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500">Sex Orientation</h6>
                        <p class="rounded-md text-slate-500">
                            The data below show the number of male and female enrolled freshmen students per CEE Term.
                        </p>

                        <div class="flex flex-wrap gap-2 mt-2 toolbar">
                            @foreach ($cee_sessions as $session)
                                <a href="{{ route('admin.preregistration.analytics.first-generation-students.details', ['termid' => $session->id]) }}"
                                    class="session-btn px-2 py-1.5 text-xs text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white [&.active]:bg-custom-500 [&.active]:text-white">
                                    {{ $session->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div id="splineChartSexOrientation" class="w-full apex-charts"
                            data-chart-colors='["bg-custom-200", "bg-green-500"]' dir="ltr"></div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="h-full card">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500">Person with Disability</h6>
                        <p class="rounded-md text-slate-500">
                            The data below show the data number of enrolled freshmen students with disabilities for each CEE
                            term.
                        </p>

                        <div class="flex flex-wrap gap-2 mt-2 toolbar">
                            @foreach ($cee_sessions as $session)
                                <a href="{{ route('admin.preregistration.analytics.first-generation-students.details', ['termid' => $session->id]) }}"
                                    class="session-btn px-2 py-1.5 text-xs text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white [&.active]:bg-custom-500 [&.active]:text-white">
                                    {{ $session->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div id="pwdChart" class="w-full apex-charts" data-chart-colors='["bg-custom-200", "bg-green-500"]'
                            dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two-column section -->
        <div class="xl:col-span-12">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 xl:gap-8">

                <!-- Card 1 -->
                <div class="h-full card">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500">Indigenous Peoples</h6>
                        <p class="rounded-md text-slate-500">
                            The data below show the number of enrolled freshmen students who are members of Indigenous
                            Peoples (IP) for each CEE term.
                        </p>

                        <div class="flex flex-wrap gap-2 mt-2 toolbar">
                            @foreach ($cee_sessions as $session)
                                <a href="{{ route('admin.preregistration.analytics.first-generation-students.details', ['termid' => $session->id]) }}"
                                    class="session-btn px-2 py-1.5 text-xs text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white [&.active]:bg-custom-500 [&.active]:text-white">
                                    {{ $session->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div id="stackedChartIP" class="w-full apex-charts"
                            data-chart-colors='["bg-custom-200", "bg-green-500"]' dir="ltr"></div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="h-full card">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500">Person with Disability </h6>
                        <p class="rounded-md text-slate-500">
                            Example for the second column.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div><!--end grid-->
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('admin.preregistration.analytics.turn-out') }}")
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data
                            .series,
                        chart: {
                            type: 'bar',
                            height: 500,
                            stacked: true,
                            stackType: 'normal'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                columnWidth: '60%',
                                endingShape: 'rounded'
                            }
                        },
                        dataLabels: {
                            enabled: true
                        },
                        xaxis: {
                            categories: data.categories,
                            title: {
                                text: 'Number of Examinees'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Score Ranges'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " examinees";
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left',
                            offsetX: 70
                        },
                        colors: ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6']
                    };

                    var chart = new ApexCharts(document.querySelector("#GroupedChartTurnout"),
                        options);
                    chart.render();
                });
        });
    </script>

    {{-- first gen student --}}
    <script>
        fetch("{{ route('admin.preregistration.analytics.first-generation-students') }}") // Adjust route if needed
            .then(res => res.json())
            .then(data => {
                var options = {
                    series: data.series,
                    chart: {
                        height: 350,
                        type: 'line'
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    colors: ['#fab1a0', '#74b9ff'],
                    labels: data.categories, // these already include the total
                    markers: {
                        size: 6,
                        hover: {
                            size: 8
                        }

                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function(y) {
                                return y.toFixed(0) + " students";
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Students'
                        }
                    },
                    xaxis: {
                        categories: data.categories
                    }
                };


                var chart = new ApexCharts(document.querySelector("#lineAreaChart"), options);
                chart.render();
            });
    </script>

    {{-- sex stat --}}
    <script>
        async function renderSexOrientationSplineChart() {
            try {
                const response = await fetch("{{ route('admin.preregistration.analytics.sex-orientation-chart') }}");
                const data = await response.json();

                // Combine term name with total
                const categoriesWithTotals = data.sessions.map((session, index) => {
                    return `${session} (${data.totals[index]})`;
                });

                const options = {
                    chart: {
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: ['#3b82f6', '#10b981'], // blue & green
                    series: [{
                            name: 'Male',
                            data: data.maleData
                        },
                        {
                            name: 'Female',
                            data: data.femaleData
                        }
                    ],
                    xaxis: {
                        categories: categoriesWithTotals,
                        title: {
                            text: 'CEE Terms'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Students'
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right'
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    }
                };

                const chart = new ApexCharts(document.querySelector("#splineChartSexOrientation"), options);
                chart.render();
            } catch (error) {
                console.error("Error loading chart:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", renderSexOrientationSplineChart);
    </script>

    {{-- for PWD --}}
    <script>
        async function renderPWDBarChart() {
            try {
                const response = await fetch("{{ route('admin.preregistration.analytics.pwd-chart') }}");
                const data = await response.json();

                // Combine term name with total
                const categoriesWithTotals = data.sessions.map((session, index) => {
                    return `${session} (${data.totals[index]})`;
                });

                const options = {
                    chart: {
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: ['#3b82f6', '#10b981'], // blue & green
                    series: [{
                            name: 'Male',
                            data: data.maleData
                        },
                        {
                            name: 'Female',
                            data: data.femaleData
                        }
                    ],
                    xaxis: {
                        categories: categoriesWithTotals,
                        title: {
                            text: 'CEE Terms'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Students'
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    }
                };

                const chart = new ApexCharts(document.querySelector("#pwdChart"), options);
                chart.render();
            } catch (error) {
                console.error("Error loading chart:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", renderPWDBarChart);
    </script>

    {{-- for IP --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            fetch("{{ route('admin.preregistration.analytics.ip-chart') }}")
                .then(response => response.json())
                .then(data => {

                    const categoriesWithTotals = data.sessions.map((session, index) => {
                        return `${session} (${data.totals[index]})`;
                    });

                    var options = {
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: true,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                                name: "Male",
                                data: data.male
                            },
                            {
                                name: "Female",
                                data: data.female
                            }
                        ],
                        xaxis: {
                            categories: categoriesWithTotals
                        },
                        yaxis: {
                            title: {
                                text: 'Total Students'
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',

                        },
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        fill: {
                            opacity: 1
                        }
                    };

                    var chart = new ApexCharts(
                        document.querySelector("#stackedChartIP"),
                        options
                    );

                    chart.render();
                });
        });
    </script>

    
@endpush
