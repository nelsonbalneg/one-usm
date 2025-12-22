@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Confirmed Applicants
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - CONFIRMED APPLICANT LIST </h5>
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
                List
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
                        <h6 class="uppercase text-15 grow">CONFIRMED APPLICANTS FOR <span class="text-custom-500">
                                {{ $programName->programName }}{{ $programName->majorDiscDesc ? ' - ' . $programName->majorDiscDesc : '' }}</span>
                        </h6>
                    </div>
                    <input type="hidden" id="policy_id_input" value="{{ $programName->policyId }}">
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">#</th>
                                <th class="ltr:!text-left rtl:!text-right">PID</th>
                                <th class="ltr:!text-left rtl:!text-right">Full Name</th>
                                <th class="ltr:!text-left rtl:!text-right">Email</th>
                                <th class="ltr:!text-left rtl:!text-right">Phone No</th>
                                <th class="ltr:!text-left rtl:!text-right">Requirements</th>
                                <th>Date Confirmed</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
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
                        targets: [0, 1, 2, 3, 4]
                    },
                ],
                language: {
                    "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.prereg.confirmed-applicants-getdata') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.policy_id = $('#policy_id_input')
                            .val(); // assuming there's an <input> or <select> with this ID
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        title: "#",
                        width: "30px"
                    },
                    {
                        data: "policyId",
                        name: "policyId",
                        width: "30px"
                    },
                    {
                        data: "fullname",
                        name: "fullname",
                        render: function(data, type, row) {
                            // Convert fullname to uppercase
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "mobile_no",
                        name: "mobile_no"
                    },
                    {
                        data: 'has_requirements',
                        name: 'has_requirements'
                    },
                    {
                        data: "date_program_selected",
                        name: "date_program_selected",
                        render: function(data, type, row) {
                            // Skip formatting if data is null or undefined
                            if (!data) return data;

                            // Create a Date object from the date string
                            const date = new Date(data);

                            // Check if date is valid
                            if (isNaN(date.getTime())) return data;

                            // Format the date as "Month Day, Year Hour:Minute AM/PM"
                            return date.toLocaleString('en-US', {
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            });
                        }
                    },
                ],
                order: [
                    [2, "asc"]
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
