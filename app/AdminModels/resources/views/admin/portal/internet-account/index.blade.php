@extends('admin.layouts.master')
@section('title')
    ONE USM | Internet Account Requests
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">One USM - Internet Account Requests</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Portal Settings</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Internet Account Requests</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Index
            </li>
        </ul>
    </div>


    <!--start grid id="openModalButton"-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="internetAccountRequestsTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Internet Account Requests List</h6>
                        <div class="shrink-0">
                            <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Internet Account</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">No</th>
                                <th>Student Info</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Semester</th>
                                <th>Date Created</th>
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
        })

        function loadData() {
            // Get the page number from sessionStorage if available
            let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem('currentPage')) : 0;

            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dbData')) {
                $('#dbData').DataTable().destroy();
            }

            // Show spinner overlay when processing starts
            $('#spinnerOverlay').removeClass('hidden');

            var table = $('#dbData').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1, 2, 3, 4, 5]
                    },
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.portal.internet-account-requests.get-all-data') }}",
                    type: "GET",
                    dataType: "JSON",
                    complete: function() {
                        // Hide the spinner overlay when processing is complete
                        $('#spinnerOverlay').addClass('hidden');
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false, // <-- important
                        orderable: false
                    },
                    {
                        data: "fullname",
                        name: "fullname"
                    },
                    {
                        data: 'student_no',
                        name: 'student_no'
                    },
                    {

                        data: "password",
                        name: "password"
                    },
                    {

                        data: "semester",
                        name: "semester"
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            };
                            return date.toLocaleDateString('en-US', options);
                        }
                    },
                ],
                order: [
                    [5, "desc"]
                ],
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                drawCallback: function(settings) {
                    lucide.createIcons();

                    var api = this.api();
                    var fullnames = {};
                    var rows = api.rows().nodes();

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(value, index) {
                        if (fullnames[value]) {

                            $(rows[index]).css({
                                'background-color': '#ff7675',
                                'color': 'white'
                            });
                            $(rows[fullnames[value]]).css({
                                'background-color': '#ff7675',
                                'color': 'white'
                            });
                        } else {
                            fullnames[value] = index;
                        }
                    });

                    // Handle dropdown toggle for dynamically generated content
                    $('#dbData').off('click', '.dropdown-toggle').on('click', '.dropdown-toggle', function(e) {
                        e.stopPropagation(); // Prevent event from propagating to other elements

                        // Hide other dropdown menus
                        $('.dropdown-menu').not($(this).next('.dropdown-menu')).addClass('hidden');

                        // Toggle the visibility of the current dropdown menu
                        $(this).next('.dropdown-menu').toggleClass('hidden');
                    });

                    // Close dropdowns if clicking outside
                    $(document).off('click').on('click', function(e) {
                        if (!$(e.target).closest('.dropdown').length) {
                            $('.dropdown-menu').addClass('hidden');
                        }
                    });
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
