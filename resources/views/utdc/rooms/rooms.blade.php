@extends('utdc.layouts.master')
@section('title')
    USM-AES | Room Management
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Rooms</a>
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
                        <h6 class="text-15 grow">Records</h6>
                        <div class="shrink-0">
                            <button id="openModalButton" type="button"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Room</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">Room</th>
                                <th>College</th>
                                <th>Available Slots</th>
                                <th>Batch</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
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
    {{-- data table scripts --}}
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{-- <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            loadData();
        })

        function loadData() {
            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dbData')) {
                $('#dbData').DataTable().destroy();
            }

            var loadData = $('#dbData').DataTable({
                responsive: true,
                pageLength: 10,
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
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.room.get-all') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: "room_name",
                        name: "room_name"
                    },
                    {
                        data: 'college_name',
                        name: 'college_name'
                    },
                    {
                        data: 'capacity',
                        name: 'capacity'
                    },
                    {
                        data: 'exam_session',
                        name: 'exam_session'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return date.toLocaleDateString('en-US', options);
                        }
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                drawCallback: function() {
                    lucide.createIcons();
                }
            });
        }

        $('body').on('change', '.change-status', function() {
            alert('hello'); // To check if this part is triggered
            // Check the toggle button's status
            let isChecked = $(this).is(':checked');
            // Get the id
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.room.change-status') }}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    // Display the success message using Toastify
                    Toastify({
                        text: data.message || "Status has been updated",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        s
                        backgroundColor: "#4CAF50", // Green for success
                        className: "success",
                    }).showToast();
                },
                error: function(xhr, status, error) {
                    Toastify({
                        text: "An error occurred. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f56565", // Red for error
                        className: "error",
                    }).showToast();
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Ensure the CSRF token is set up for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load data table
            table();

            function table() {
                // Get the page number from sessionStorage if available
                let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                    'currentPage')) : 0;


                if ($.fn.DataTable.isDataTable('#dbData')) {
                    console.log("Destroying existing DataTable instance."); // Debugging line
                    $('#dbData').DataTable().destroy();
                }

                $('#dbData').DataTable({
                    responsive: true,
                    pageLength: 10,
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
                        "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                    },
                    processing: true,
                    serverSide: true,
                    deferRender: true, // Improves performance by delaying rendering
                    ajax: {
                        url: "{{ route('admin.room.get-all') }}",
                        type: "GET",
                        dataType: "JSON",
                        error: function(xhr, status, error) {
                            console.error("DataTable load error:", error); // Debugging line
                        }
                    },
                    columns: [{
                            data: "room_name",
                            name: "room_name"
                        },
                        {
                            data: 'college_name',
                            name: 'college_name'
                        },
                        {
                            data: 'capacity',
                            name: 'capacity'
                        },
                        {
                            data: 'exam_session',
                            name: 'exam_session'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data) {
                                const date = new Date(data);
                                const options = {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                };
                                return date.toLocaleDateString('en-US', options);
                            }
                        },
                        {
                            data: 'time',
                            name: 'time'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
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
                        currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage
                            .getItem(
                                'currentPage')) : 0;
                        table.page(currentPage).draw(false);
                    } else {
                        let pageInfo = table.page.info();
                        sessionStorage.setItem('currentPage', pageInfo.page);
                    }
                });

            }

            // Event delegation for dynamically loaded .change-status toggle buttons
            $('body').on('change', '.change-status', function() {

                // Check the toggle button's status
                let isChecked = $(this).is(':checked');
                // Get the id
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.room.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {

                        // Display the success message using Toastify
                        Toastify({
                            text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                                (data.message || "Status has been updated"),
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#4CAF50", // Green for success
                            className: "success",
                            escapeMarkup: false
                        }).showToast();
                    },
                    error: function(xhr, status, error) {

                        Toastify({
                            text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                                (data.message || "Status has been updated"),
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f56565", // Red for error
                            className: "error",
                            escapeMarkup: false
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endpush
