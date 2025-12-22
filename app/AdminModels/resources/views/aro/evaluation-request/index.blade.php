@extends('aro.layouts.master')
@section('title')
    ONE USM | Evaluation Request
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />

    <style>
        #draweredituser {
            transform: translateX(100%);
            /* Hidden */
            transition: transform 0.3s ease-in-out;
        }

        #draweredituser.show {
            transform: translateX(0);
            /* Visible */
        }
    </style>
@endpush


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">One USM - Evaluation Requests</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Evaluation Requests</a>
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
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Evaluation Requests List</h6>
                        <div class="shrink-0">
                            {{-- <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Evaluation Request</span>
                            </button> --}}
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">No</th>
                                <th>Reference No</th>
                                <th>Student Info</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Evaluated By</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    {{-- edit user start drawer --}}
    <div id="draweredituser" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Evaluation Request Details</h5>
            <button data-drawer-close="draweredituser"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4">

                            <input type="hidden" name="evaluation_request_id" id="evaluationrequestid">

                            <!-- Student ID-->
                            <div>
                                <label for="request_id1" class="block mb-2 text-base font-medium">Reference No.</label>
                                <input type="text" id="request_id1" name="request_id" placeholder="Enter Reference No"
                                    class="form-input" value="{{ old('request_id') }}" disabled>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="studentInfo" class="block mb-2 text-base font-medium">First Name</label>
                                <input type="text" id="studentInfo1" class="form-input" value="{{ old('studentInfo1') }}"
                                    disabled>
                            </div>
                            <div>
                                <label for="remarks" class="block mb-2 text-base font-medium">Remarks</label>
                                <textarea id="remarks1" name="remarks" class="h-64 form-input">{{ old('remarks') }}</textarea>
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="EditStatus" class="block mb-2 text-base font-medium">Status</label>
                                <select id="status1" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="Evaluated" selected>Evaluated</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>

                                </select>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-4">
                            <button type="submit" class="w-full text-white bg-custom-500 btn hover:bg-custom-600">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
            <h6 class="text-15">One USM Integrated Information System</h6>
        </div>
    </div>
    {{-- edit drawer --}}
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>


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
                        targets: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                    // "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('aro.portal.evaluation-requests.get-all-data') }}",
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
                        data: 'request_id',
                        name: 'request_id'
                    },
                    {
                        data: "fullname",
                        name: "fullname"
                    },
                    {

                        data: "remarks",
                        name: "remarks",
                        render: function(data, type, row) {
                            if (type === 'display' && data) {
                                // Count words
                                let wordCount = data.trim().split(/\s+/).length;

                                // If 5 words or more, apply word wrapping
                                if (wordCount >= 5) {
                                    return '<div style="white-space: normal; word-wrap: break-word; max-width: 200px;">' +
                                        data + '</div>';
                                }
                            }
                            return data;
                        }
                    },
                    {

                        data: "status",
                        name: "status"
                    },
                    {

                        data: "evaluated_by_fullname",
                        name: "evaluated_by_fullname"
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
                    {

                        data: "action",
                        name: "action"
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

    {{-- delete entry --}}
    <script>
        $('body').on('click', '.delete-entry', function(event) {
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        success: function(data) {
                            if (data.status == 'success') {
                                // Get the current page number
                                var table = $('#dbData').DataTable();
                                var currentPage = table.page();

                                Swal.fire('Deleted!', data.message, 'success')
                                    .then(() => {
                                        // Remove the row from the DataTable and redraw without changing the pagination
                                        table.row($(event.target).closest('tr')).remove()
                                            .draw(false);

                                        // Maintain the current page
                                        table.page(currentPage).draw(false);
                                    });
                            } else if (data.status == 'error') {
                                Swal.fire('Unable to Delete!', data.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Unable to Delete!',
                                'An error occurred while processing your request.',
                                'error');
                        }
                    });
                }
            });
        });
    </script>

    {{-- edit nd update evaluation-requests --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const drawer = document.getElementById('draweredituser'); // Reference the drawer

            // Handle the "edit-entry" button click
            document.addEventListener('click', event => {
                const editButton = event.target.closest(
                    '.edit-entry'); // Check if clicked element is the edit button
                if (editButton) {
                    event.preventDefault();

                    const id = editButton.getAttribute('data-id'); // Fetch the `data-id` attribute
                    if (!id) {
                        console.error('User ID is missing!');
                        return;
                    }

                    const editUrl = `/aro/portal/evaluation-requests/${id}/edit`;

                    // Fetch user data and populate the drawer
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.evaluation_request) {
                                let evaluation_request = response.evaluation_request;
                                // fill the values
                                $('#evaluationrequestid').val(evaluation_request.id);
                                $('#request_id1').val(evaluation_request.request_id);
                                $('#studentInfo1').val(response.student_name);
                                $('#remarks1').val(evaluation_request.remarks);
                                $('#status1').val(evaluation_request.status);

                                // Show the drawer after data is populated
                                if (drawer) {
                                    drawer.classList.remove('hidden');
                                    drawer.classList.add('show');
                                }

                            } else {
                                console.error('User data is empty.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch user data:', xhr.responseText ||
                                error);
                            alert('An error occurred while fetching user details.');
                        }
                    });
                }
            });

            // Handle the "close" button click
            const closeButton = document.querySelector('[data-drawer-close="draweredituser"]');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    if (drawer) {
                        drawer.classList.remove('show');
                        drawer.classList.add('hidden');
                    }
                });
            }
        });


        //update date
        $('#editForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            let evaluation_request = $('#evaluationrequestid').val();

            $.ajax({
                url: '/aro/portal/evaluation-requests/' + evaluation_request,
                method: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });

                    $('#editForm')[0].reset();

                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null, false);
                    }
                },

                error: function(xhr) {
                    let response = xhr.responseJSON;

                    if (response && response.errors) {
                        let messages = Object.values(response.errors)
                            .map(err => err.join('<br>'))
                            .join('<br>');

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: messages
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'An unexpected error occurred. Please try again later.'
                        });
                    }
                }
            });
        });
    </script>
@endpush
