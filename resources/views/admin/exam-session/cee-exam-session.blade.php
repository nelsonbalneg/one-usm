@extends('admin.layouts.master')
@section('title')
    USM-AES |CEE Exam Session
@endsection

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> --}}
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Configuration</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Exam Session</a>
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
                                <span class="align-middle">Add CEE Session</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>No. Examinee</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    <!-- add Modal Structure -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Edit CEE Exam Session Details</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <input type="hidden" name="ceesessionid" id="ceesessionid">
                        <div class="xl:col-span-12">
                            <label for="name" class="inline-block mb-2 text-base font-medium">Cee Session Name</label>
                            <input type="text" id="name" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="CEE Session Name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Save
                            Changes</button>
                    </div>
            </div>

            </form>
        </div>
    </div>

    <!-- add Modal Structure -->
    <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Add CEE Exam Session</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addForm">
                    @csrf
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <div class="xl:col-span-12">
                            <label for="name" class="inline-block mb-2 text-base font-medium">Cee Session Name</label>
                            <input type="text" id="name1" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="CEE Session Name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Save</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script> --}}


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
                    url: "{{ route('admin.cee.exam-session.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Ensures Laravel recognizes the request as AJAX
                    }
                },
                columns: [{
                        data: "id",
                        name: "id"
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'reservation_count',
                        name: 'reservation_count'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [0, "desc"]
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

        // Event delegation for dynamically loaded .change-status toggle buttons
        // $('body').on('change', '.change-status', function() {

        //     // Check the toggle button's status
        //     let isChecked = $(this).is(':checked');
        //     // Get the id
        //     let id = $(this).data('id');

        //     $.ajax({
        //         url: "{{ route('admin.exam-session.change-status') }}",
        //         method: 'PUT',
        //         data: {
        //             status: isChecked,
        //             id: id
        //         },
        //         success: function(data) {

        //             // Display the success message using Toastify
        //             Toastify({
        //                 text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
        //                     (data.message || "Status has been updated"),
        //                 duration: 3000,
        //                 gravity: "top",
        //                 position: "right",
        //                 backgroundColor: "#4CAF50", // Green for success
        //                 className: "success",
        //                 escapeMarkup: false
        //             }).showToast();

        //             // Reload or redraw the table (if using DataTables)
        //             if ($.fn.DataTable.isDataTable('#dbData')) {
        //                 $('#dbData').DataTable().ajax.reload(null,
        //                     false); // false = retain pagination
        //             } else {
        //                 location.reload(); // Fallback to full page reload if not using DataTables
        //             }
        //         },
        //         error: function(xhr, status, error) {

        //             Toastify({
        //                 text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
        //                     (data.message || "Status has been updated"),
        //                 duration: 3000,
        //                 gravity: "top",
        //                 position: "right",
        //                 backgroundColor: "#f56565", // Red for error
        //                 className: "error",
        //                 escapeMarkup: false
        //             }).showToast();
        //         }
        //     });
        // });

        // Event delegation for dynamically loaded .change-status toggle buttons
        $('body').on('change', '.change-status', function() {

            let toggle = $(this);
            let isChecked = toggle.is(':checked');
            let id = toggle.data('id');

            // Show SweetAlert password prompt
            Swal.fire({
                title: 'Confirm Action',
                text: 'Enter admin password to change status',
                input: 'password',
                inputPlaceholder: 'Enter password',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocorrect: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                preConfirm: (password) => {
                    if (password !== '#GreatUSM') {
                        Swal.showValidationMessage('❌ Incorrect password');
                        return false;
                    }
                    return true;
                }
            }).then((result) => {

                // If cancelled, revert toggle
                if (!result.isConfirmed) {
                    toggle.prop('checked', !isChecked);
                    return;
                }

                // Password correct → proceed with AJAX
                $.ajax({
                    url: "{{ route('admin.exam-session.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message || 'Status has been updated',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Reload DataTable if exists
                        if ($.fn.DataTable.isDataTable('#dbData')) {
                            $('#dbData').DataTable().ajax.reload(null, false);
                        } else {
                            location.reload();
                        }
                    },
                    error: function() {

                        // Revert toggle on error
                        toggle.prop('checked', !isChecked);

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update status'
                        });
                    }
                });
            });
        });


        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.edit-entry', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/exam-session/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let cee_session = response.ceeSession;

                    // fill the values
                    $('#ceesessionid').val(cee_session.id);
                    $('#name').val(cee_session.name);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            })

            $('#editModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('editModal');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Close when clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                    modal.classList.add('hidden');
                }
            });
        });

        //update date
        $('#editForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var cee_id = $('#ceesessionid').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/exam-session/' + cee_id, // Replace with your endpoint URL
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#editModal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });

                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error Response:", xhr.responseText); // Check the error response
                    Swal.fire("Error", data.message, 'error', {
                        button: true,
                        button: "OK"
                    });
                }
            });
        });

        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '#openModalButton', function(event) {
            event.preventDefault();
            $('#addModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addModal');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Close when clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                    modal.classList.add('hidden');
                }
            });
        });

        // Handle form submission with AJAX
        $('#addForm').submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize(); // Instead of new FormData(this)

            $.ajax({
                url: "{{ route('admin.exam-session.store') }}",
                method: 'POST', // Use POST method
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#addModal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });

                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error Response:", xhr.responseText); // Check the error response
                    Swal.fire("Error", data.message, 'error', {
                        button: true,
                        button: "OK"
                    });
                }
            });
        });

        // delete entry
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
@endpush
