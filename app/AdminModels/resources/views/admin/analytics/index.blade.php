@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE Analytics
@endsection


@Section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USMCEE AND PRE-REGISTRATION ANALYTICS</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Analytics</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Index</a>
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">USM - COLLEGE ENTRANCE EXAMINATION OVERVIEW</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="stackedBarChart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="uppercase text-15 grow">CEE Results Overview</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="GroupedChart" class="apex-charts" data-chart-colors='["bg-custom-500", "bg-green-500"]'
                    dir="ltr"></div>
            </div>
        </div>

        <div class="col-span-12 card 2xl:col-span-12 2xl:row-span-2">
            <div class="card-body">
                <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">CEE Score Distribution</h6>
                <p class="rounded-md text-slate-500">
                    The figures below show the distribution of the CEE scores of the examinees.</p>

            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="GroupedChartScoreDistribution" class="apex-charts"
                    data-chart-colors='["bg-custom-500", "bg-green-500"]' dir="ltr"></div>
            </div>
        </div>


        <div class="xl:col-span-12 card md:col-span-12">

            <div class="card-body">
                <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">School Performance</h6>

                <p class="mb-4 rounded-md text-slate-500">
                    The figures below show the performance of the schools of cee takers.
                </p>
                <!-- SEARCH BAR -->
                <div class="mb-4">
                    <input type="text" id="searchInputforTopSchool" placeholder="Search School"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zink-700 dark:border-zink-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <table id="dataTableforTopSchool" class="w-full table-auto">
                    <thead>
                        <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                            <th class="px-4 py-2">#</th> <!-- Row number column -->
                            <th class="px-4 py-2 text-left">School</th>
                            <th class="px-4 py-2 text-left">Examinee</th>
                            <th class="px-4 py-2 text-left">Passers</th>
                            <th class="px-4 py-2 text-left">Failed</th>
                            <th class="px-4 py-2 text-left">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $index => $row)
                            <tr class="program-row-for-topschool">
                                <td class="px-4 py-2">{{ $index + 1 }}</td> <!-- Display row number -->
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.analytics.score-distribution.index', ['schoolName' => urlencode($row->school)]) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $row->school }}
                                    </a>
                                </td>
                                <td class="px-4 py-2">{{ $row->total_examinees }}</td>
                                <td class="px-4 py-2">{{ $row->total_passed }}</td>
                                <td class="px-4 py-2">{{ $row->total_failed }}</td>
                                <td class="px-4 py-2">{{ $row->passing_rate_percent }}%</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center">No matching records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $results->links() }}
                </div>


            </div>

        </div>


        <div class="xl:col-span-12 md:col-span-12 card">

            <div class="card-body">
                <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">TOP 40 CEE Examinee</h6>

                <p class="mb-4 rounded-md text-slate-500">
                    The figures below show the performance of the schools of cee takers.
                </p>

                <div class="mb-4">
                    <input type="text" id="searchInputforTopExaminee" placeholder="Search Examinee"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zink-700 dark:border-zink-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-green-500 bg-green-100">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Full Name</th>
                            <th class="px-4 py-2">School</th>
                            <th class="px-4 py-2">CSA</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($top20 as $index => $user)
                            <tr class="user-row">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $user->fullname }}</td>
                                <td class="px-4 py-2">{{ $user->shs_school }}</td>
                                <td class="px-4 py-2">{{ $user->csa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="xl:col-span-12 md:col-span-12 card">

            <div class="card-body">

                <div class="flex items-center justify-between w-full">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">USMCEE SCHOOL PERFORMANCE PER SUBJECT
                        AREA
                    </h6>

                    <a type="button" href="{{ route('admin.export.school.result-per-subject-area') }}"
                        class="mb-2 bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                            class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export to Excel</a>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr class="text-left text-green-500 bg-green-100">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">School</th>
                                <th class="px-4 py-2">Takers</th>
                                <th class="px-4 py-2">Science</th>
                                <th class="px-4 py-2">Math</th>
                                <th class="px-4 py-2">Humanities</th>
                                <th class="px-4 py-2">Inductive Reasoning</th>
                                <th class="px-4 py-2">CSA</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>


    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/choices/choices.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>

    {{-- cee score distribution --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('admin.analytics.cee-score-distribution.index') }}")
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data
                            .series, // Expect this format: [{ name: 'Session 1 - Male', group: 'Session 1', data: [...] }, ...]
                        chart: {
                            type: 'bar',
                            height: 600,
                            stacked: true,
                            stackType: 'normal' // Use '100%' for percentage stacking
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
                            categories: data.categories, // Score ranges like ["95-100", "90-94", ...]
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
                            offsetX: 40
                        },
                        colors: ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6']
                    };

                    var chart = new ApexCharts(document.querySelector("#GroupedChartScoreDistribution"),
                        options);
                    chart.render();
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('admin.analytics-stackbar') }}")
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data.series,
                        chart: {
                            type: "bar",
                            height: 400,
                            stacked: true
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: "60%"
                            }
                        },
                        xaxis: {
                            categories: data.categories
                        },
                        colors: [
                            "#1E40AF", // Registered (Blue)
                            "#10B981", // Confirmed (Green)
                            "#F59E0B", // Pending (Yellow/Orange)
                            "#EF4444" // Cancelled (Red)
                        ],
                        dataLabels: {
                            enabled: true, // Show raw values inside the bars
                            formatter: function(val) {
                                return `${val}`; // Only show the value (no percentage)
                            }
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            y: {
                                formatter: function(val, opts) {
                                    const dataPointIndex = opts.dataPointIndex;
                                    const allSeries = opts.w.globals.series;

                                    let total = 0;
                                    for (let i = 0; i < allSeries.length; i++) {
                                        total += allSeries[i][dataPointIndex];
                                    }

                                    const percentage = total === 0 ? 0 : (val / total * 100);
                                    return `${percentage.toFixed(1)}%`; // Show percentage only in tooltip
                                }
                            }
                        },
                        legend: {
                            position: "top"
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#stackedBarChart"), options);
                    chart.render();
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('admin.analytics-grouped-chart') }}") // Adjust to your actual route name
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data.series,
                        chart: {
                            type: 'bar',
                            height: 400,
                            stacked: false
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                columnWidth: '45%',
                                endingShape: 'rounded'
                            }
                        },
                        dataLabels: {
                            enabled: true
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: data.categories,
                            title: {
                                text: 'Number of Examinees'
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
                        colors: ['#10B981', '#EF4444'], // Passed = green, Failed = red
                        legend: {
                            position: 'top'
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#GroupedChart"), options);
                    chart.render();
                });
        });
    </script>

    <script>
        document.getElementById('searchInputforTopSchool').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableforTopSchool tbody .program-row-for-topschool');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });

        document.getElementById('searchInputforTopExaminee').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase(); // Get the search input and convert to lowercase
            var rows = document.querySelectorAll('#tableBody .user-row'); // Get all table rows

            rows.forEach(function(row) {
                var text = row.textContent
                    .toLowerCase(); // Get the text content of each row and convert to lowercase
                row.style.display = text.includes(searchValue) ? '' :
                    'none'; // Display or hide based on the search value
            });
        });
    </script>

    {{-- load datatable for  --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            loadData();
        });

        function loadData() {
            // Get the page number from sessionStorage if available
            let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem('currentPage')) : 0;

            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dbData')) {
                $('#dbData').DataTable().destroy();
            }

            var table = $('#dbData').DataTable({
                responsive: true,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.analytics-school-performance-perarea.get-data') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "shs_school",
                        name: "shs_school"
                    },
                    {
                        data: 'total_users_with_results',
                        name: 'total_users_with_results'
                    },
                    {
                        data: 'avg_science',
                        name: 'avg_science'
                    },
                    {
                        data: 'avg_math',
                        name: 'avg_math'
                    },
                    {
                        data: 'avg_humanities',
                        name: 'avg_humanities',
                    },
                    {
                        data: 'avg_inductive',
                        name: 'avg_inductive'
                    },
                    {
                        data: 'avg_csa',
                        name: 'avg_csa'
                    }
                ],
                order: [
                    [2, "desc"]
                ],
                drawCallback: function() {
                    lucide.createIcons();
                },
                // Once the table is initialized, move to the stored page
                initComplete: function() {
                    if (currentPage) {
                        table.page(currentPage).draw('page');
                    }
                }
            });
            // Save the current page in sessionStorage when page changes
            table.on('page.dt', function() {
                let pageInfo = table.page.info();
                sessionStorage.setItem('currentPage', pageInfo.page);
            });

            // Save the current page in sessionStorage when search is initiated
            $('#dbData_filter input').on('input', function() {
                let searchValue = $(this).val();

                // If the search is cleared, use the stored page number
                if (searchValue === '') {
                    currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                        'currentPage')) : 0;
                    table.page(currentPage).draw(false);
                } else {
                    let pageInfo = table.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                }
            });
        }
    </script>
@endpush
