@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - CHED Profiling
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USM-Admission and Enrollment System | CHED Profiling</h5>
            <span
                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                ACTIVE CEE TERM: {{ $activecee_session->name }}</span>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Report</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Ched Profiling
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="order-1 ">

        </div><!--end col-->

        <div
            class=" bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-4 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-orange-500 rounded-md size-12 text-15 text-orange-50">
                    <i data-lucide="pencil"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value"
                        data-target="{{ $count_draft }}">{{ $count_draft }}</span></h5>
                <p class="text-slate-500 dark:text-slate-200">Draft Profiles</p>
            </div>
        </div><!--end col-->

        <div
            class=" bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-4 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="list-filter"
                    class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center rounded-md size-12 bg-sky-500 text-15 text-sky-50">
                    <i data-lucide="check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $count_published }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">Publihed Profiles </p>
            </div>
        </div><!--end col-->

        <div
            class=" bg-green-100 dark:bg-green-500/20 card 2xl:col-span-4 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                    <i data-lucide="users"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $count_all_profile }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">All Profiles </p>
            </div>
        </div><!--end col-->

        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        {{-- <h6 class="text-15 grow">Showing Records under {{ $activecee_session->name }} CEE Exam Session</h6> --}}
                        <h6 class="uppercase text-15 grow">List of Applicant Completed Thier Profile</h6>
                        <div class="flex items-center gap-2 space-x-4">
                            <a type="button" href="{{ route('admin.reservation.room.view-all-applicant') }}"
                                class="bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                                    class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export</a>

                            <!-- Dropdown for Filter -->
                            <div class="relative dropdown">
                                <button type="button"
                                    class="flex items-center justify-center p-0 bg-white size-8 text-slate-500 btn hover:text-slate-600 hover:bg-slate-100 focus:text-slate-600 focus:bg-slate-100 active:text-slate-700 active:bg-slate-200 dark:bg-zinc-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle"
                                    id="dailyVisitInsightsDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-2 bg-white rounded-md shadow-md dropdown-menu min-w-[14rem] dark:bg-zinc-600"
                                    aria-labelledby="dailyVisitInsightsDropdown">
                                    <div class="px-3 py-2">
                                        <label for="cee-term-select"
                                            class="block text-sm font-medium text-slate-600 dark:text-white">
                                            Filter by CEE Terms
                                        </label>
                                        <select id="cee-term-select" name="cee_session_id" data-choices
                                            class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                                            <option disabled>Select Term</option>
                                            @foreach ($ceeSessions as $session)
                                                <option value="{{ $session->id }}"
                                                    {{ isset($activecee_session) && $activecee_session->id == $session->id ? 'selected' : '' }}>
                                                    {{ $session->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">App No</th>
                                <th>Full Name</th>
                                <th>Profile Status</th>
                                <th>Date Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
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
                        targets: [0, 1, 2, 3, 4]
                    },
                ],
                language: {
                    processing: `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.cee.report.ched-profile.index.getdata') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.cee_session_id = $('#cee-term-select').val(); // send selected value
                    }
                },
                columns: [{
                        data: "app_no",
                        name: "app_no"
                    },
                    {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: "status",
                        name: "status"
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [3, "desc"]
                ],
                pageLength: 25, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
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

            // Reload DataTable when selection changes
            $('#cee-term-select').on('change', function() {
                table.ajax.reload();
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
