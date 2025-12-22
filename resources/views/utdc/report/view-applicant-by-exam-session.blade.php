@extends('utdc.layouts.master')
@section('title')
     USM-AES | UTDC - All Applicants
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">All Applicants</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Applicant Record for {{ $ceeActiveSession->name }} CEE Term</h6>
                        <div class="flex items-center gap-2 space-x-4">
                            <a type="button" href="{{ route('utdc.reservation.export.applicantByActiveCeeSession') }}"
                                class="bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                                    class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export to Excel</a>

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
                                            Filter by CEE Term
                                        </label>
                                        <select id="cee-term-select" name="cee_session_id" data-choices
                                            class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                                            <option disabled>Select Term</option>
                                            @foreach ($ceeSessions as $session)
                                                <option value="{{ $session->id }}"
                                                    {{ isset($activeSession) && $activeSession->id == $session->id ? 'selected' : '' }}>
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
                                <th class="ltr:!text-left rtl:!text-right">#</th>
                                <th>CEE Term</th>
                                <th>App #</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Campus</th>
                                <th>First Priority</th>
                                <th>Second Priority</th>
                                <th>Third Priority</th>
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

            // Get default selected session
            let activeSessionId = $('#cee-term-select').val();


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
                        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                ],
                language: {
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('utdc.reservation.view-applicant-by-active-cee-sessison.view') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.cee_session_id = $('#cee-term-select').val() ||
                            activeSessionId; // Load selected or default session
                    }
                },
                order: [
                    [3, 'asc'], // fullname
                ],
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        title: "#",
                        orderable: false, // Prevents sorting on the index column
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: "app_no",
                        name: "app_no"
                    },
                    {
                        data: "fullname",
                        name: "fullname"
                    },
                    {
                        data: "phone",
                        name: "phone"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "campus_name",
                        name: "campus_name"
                    },
                    {
                        data: "firstpriorty_desc",
                        name: "firstpriorty_desc"
                    },
                    {
                        data: "secondpriority_desc",
                        name: "secondpriority_desc"
                    },
                    {
                        data: "thirdpriorty_desc",
                        name: "thirdpriorty_desc"
                    }

                ],
                pageLength: 25, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
                drawCallback: function(settings) {
                    lucide.createIcons();
                },
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

            // Reload table when session is changed
            $('#cee-term-select').change(function() {
                table.ajax.reload(); // Refresh table based on new session ID
            });
        }
    </script>
@endpush
