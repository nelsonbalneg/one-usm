@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Applicants Without Requirements
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16"> APPLICANTS WITHOUT REQUIREMENTS<span class="text-custom-500"> 1ST SEMESTER SY
                    2025-2026</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">No Requirements</a>
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
                        <h6 class="uppercase text-15 grow"> RECORDS
                        </h6>

                        <a type="button" href="{{ route('admin.prereg.export.no-requirements-applicants') }}"
                            class="bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                                class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export to Excel</a>
                    </div>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">#</th>
                                <th class="ltr:!text-left rtl:!text-right">Full Name</th>
                                <th class="ltr:!text-left rtl:!text-right">Program</th>
                                <th class="ltr:!text-left rtl:!text-right">Campus</th>
                                <th class="ltr:!text-left rtl:!text-right">Phone No</th>
                                <th class="ltr:!text-left rtl:!text-right">Email</th>
                                <th>Date Confirmed</th>
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
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

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
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    },
                ],
                language: {
                    processing: `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.prereg.no-requirements-applicants-list') }}",
                    type: "GET",
                    dataType: "JSON"
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
                        data: "full_name",
                        name: "full_name"
                    },
                    {
                        data: "programName",
                        name: "programName",
                    },
                    {
                        data: "campusName",
                        name: "campusName",
                    },

                    {
                        data: "mobile_no",
                        name: "mobile_no"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "date_confirmed",
                        name: "date_confirmed",
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
                    {
                        data: "action",
                        name: "action"
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // cancel prereg
        $('body').on('click', '.cancel-prereg', function(event) {
            event.preventDefault();
            let updateUrl = $(this).attr('href');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Cancel Preregistration',
                input: 'textarea',
                inputLabel: 'Reason for cancellation',
                inputPlaceholder: 'Enter your reason here...',
                inputValue: 'Cancelled due to non submission of requirements', // Pre-filled text
                showCancelButton: true,
                confirmButtonText: 'Submit',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to provide a reason!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let reason = result.value;

                    $.ajax({
                        type: 'PUT', // Or PATCH
                        url: updateUrl,
                        data: {
                            reason: reason
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                let table = $('#dbData').DataTable();
                                let currentPage = table.page();

                                Swal.fire('Success', data.message, 'success').then(() => {
                                    table.row(row).remove().draw(false);
                                    table.page(currentPage).draw(false);
                                });
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            let errorMsg = xhr.responseJSON?.message || 'Something went wrong.';
                            Swal.fire('Error', errorMsg, 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
