@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE Score Distribution for {{ $schoolName }}
@endsection


@Section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">CEE SCORE Distribution</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Analytics</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Score Distribution</a>
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 card 2xl:col-span-12 2xl:row-span-2">
            <div class="card-body">
                <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">CEE Score Distribution for
                    {{ urlDecode($schoolName) }}</h6>
                <p class="rounded-md text-slate-500">
                    The figures below show the distribution of the CEE scores of the examinees.</p>

            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="GroupedChartScoreDistributionPerSchool" class="apex-charts"
                    data-chart-colors='["bg-custom-500", "bg-green-500"]' dir="ltr"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- cee score distribution per school --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let schoolName = "{{ $schoolName }}"; // Ensure this is sanitized

            fetch("{{ route('admin.analytics.cee-score-distribution-per-school', ['schoolName' => $schoolName]) }}")
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data.series, // Expecting multiple series, each with a group/stack
                        chart: {
                            type: 'bar',
                            height: 500,
                            stacked: true,
                            stackType: 'normal' // Or '100%' for percentage stacking
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

                    var chart = new ApexCharts(document.querySelector(
                        "#GroupedChartScoreDistributionPerSchool"), options);
                    chart.render();
                });
        });
    </script>
@endpush
