@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Result Templates
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
    <style>
        #editdrawer {
            transform: translateX(100%);
            /* Hidden */
            transition: transform 0.3s ease-in-out;
        }

        #editdrawer.show {
            transform: translateX(0);
            /* Visible */
        }
    </style>
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Result Template </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Result</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Template</a>
            </li>
        </ul>
    </div>

    <!--start grid id="openModalButton"-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Template List</h6>
                        <div class="shrink-0">
                            <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Template</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Filename</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Attachment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    {{-- add user start drawer --}}
    <div id="drawerterms" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer show dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Add New Template</h5>
            <button data-drawer-close="drawerterms"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="addForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">

                            <!-- Upload Template -->
                            <div>
                                <label for="attachment_name" class="block mb-2 text-base font-medium">Upload
                                    Template</label>
                                <input type="file" name="attachment_name"
                                    class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    placeholder="Select a File">
                            </div>

                            <!-- File Name -->
                            <div>
                                <label for="filename" class="block mb-2 text-base font-medium">First Name</label>
                                <input type="text" name="filename" placeholder="File Name" class="form-input"
                                    value="{{ old('filename') }}">
                            </div>

                            <!-- Description  -->
                            <div>
                                <label for="description" class="block mb-2 text-base font-medium">Description</label>
                                <textarea
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="description" rows="3"></textarea>
                            </div>

                            <!-- status -->
                            <div>
                                <label for="status" class="block mb-2 text-base font-medium">Status</label>
                                <select name="status" class="form-input" data-choices>
                                    <option value="">--Select--</option>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">In Active</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-4">
                            <button type="submit" class="w-full text-white bg-custom-500 btn hover:bg-custom-600">Save
                                New Template</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
            <h6 class="text-15">USMCEE Reservation System 4.0</h6>
        </div>
    </div>
    {{-- end drawer --}}

    {{-- add user start drawer --}}
    <div id="editdrawer" drawer-end
        class="fixed inset-y-0 flex flex-col hidden w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Edit Template Details</h5>
            <button data-drawer-close="editdrawer"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4">
                            <!-- File Name -->
                            <input type="hidden" id="res_temp_id" name="res_tem_id">
                            <div>
                                <label for="editfilename" class="block mb-2 text-base font-medium">File Name</label>
                                <input type="text" id="editfilename" name="filename" placeholder="File Name"
                                    class="form-input" value="{{ old('filename') }}">
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="editdescription" class="block mb-2 text-base font-medium">Description</label>
                                <textarea
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    id="editdescription" name="description" rows="3"></textarea>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block mb-2 text-base font-medium">Status</label>
                                <select id="editstatus" name="status" class="form-input" data-choices>
                                    <option value="">--Select--</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
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
            <h6 class="text-15">USMCEE Reservation System 4.0</h6>
        </div>
    </div>
    {{-- end drawer --}}


    {{-- start attach_template_modal --}}
    <div id="attachment_modal" class="fixed inset-0 z-50 flex items-start justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-50 mt-20">
            <!-- Added mt-16 -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Update Attachment</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="attachmentForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <input type="hidden" name="file_attachment_id" id="attach_re_temp_id">
                        <div class="xl:col-span-12">
                            <label for="add_attachment_name" class="block mb-2 text-base font-medium">Upload
                                Template</label>
                            <input type="file" name="attachment_name"
                                class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                placeholder="Select a File">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Upload
                            File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- end attach_template_modal --}}
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>



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
                    "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.cee.result-template.get-data') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false, // Disable sorting
                        searchable: false, // Disable searchings
                    },
                    {
                        data: "filename",
                        name: "filename"
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'attachment',
                        name: 'attachment'
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
                    currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                        'currentPage')) : 0;
                    table.page(currentPage).draw(false);
                } else {
                    let pageInfo = table.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                }
            });
        }

        // Handle form submission with AJAX
        $('#addForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this); // Serialize the form data

            $.ajax({
                url: "{{ route('admin.cee.result.template.store') }}",
                method: 'POST', // Use POST method
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false for file uploads
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // Reset the form
                    $('#addForm')[0].reset();

                    // SweetAlert with manual closing
                    Swal.fire({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK", // Customize the Confirm button text
                        allowOutsideClick: false, // Disable closing by clicking outside
                        allowEscapeKey: false, // Disable closing with the Escape key
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Handle confirm button click
                            if ($.fn.DataTable.isDataTable('#dbData')) {
                                $('#dbData').DataTable().ajax.reload(null,
                                    false); // Reload table
                            } else {
                                location.reload(); // Fallback to full page reload
                            }
                        }
                    });
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

        // Event delegation for dynamically loaded .change-status toggle buttons
        $('body').on('change', '.change-status', function() {

            // Check the toggle button's status
            let isChecked = $(this).is(':checked');
            // Get the id
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.cee.result-template.change-status') }}",
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

                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
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

    {{-- edit user script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const drawer = document.getElementById('editdrawer');

            // Ensure the drawer is correctly selected
            if (!drawer) {
                return;
            }

            document.addEventListener('click', event => {
                const editButton = event.target.closest('.edit-entry');
                if (editButton) {
                    event.preventDefault();

                    const id = editButton.getAttribute('data-id');
                    if (!id) {
                        return;
                    }

                    const editUrl = `/admin/cee/result-template/${id}/edit`;

                    // Fetch template data and open the drawer
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.result_template) {
                                let result = response.result_template;

                                // Populate fields in the drawer
                                $('#res_temp_id').val(result.id);
                                $('#editfilename').val(result.filename);
                                $('#editdescription').val(result.description);
                                $('#editstatus').val(result.status);

                                // Open the drawer
                                drawer.classList.remove('hidden');
                                drawer.classList.add('show');
                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching template:', xhr.responseText ||
                                error);
                        }
                    });
                }
            });

            // Close the drawer
            const closeButton = document.querySelector('[data-drawer-close="editdrawer"]');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    drawer.classList.remove('show');
                    drawer.classList.add('hidden');
                });
            }
        });

        //update date
        $('#editForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var res_temp_id = $('#res_temp_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/cee/result-template/' + res_temp_id, // Replace with your endpoint URL
                method: 'POST', // POST with _method=PUT
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#editForm')[0].reset();
                    Swal.fire({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK", // Customize the Confirm button text
                        allowOutsideClick: false, // Disable closing by clicking outside
                        allowEscapeKey: false, // Disable closing with the Escape key
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Handle confirm button click
                            if ($.fn.DataTable.isDataTable('#dbData')) {
                                $('#dbData').DataTable().ajax.reload(null,
                                    false); // Reload table
                            } else {
                                location.reload(); // Fallback to full page reload
                            }
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire("Error", xhr.responseJSON?.message || "An error occurred", 'error', {
                        button: "OK"
                    });
                }
            });

        });
    </script>

    {{-- update attachment script --}}
    <script>
        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('attachment_modal');
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
        //update attachment
        $('body').on('click', '.attach-file', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            const editUrl = `/admin/cee/result-template/${id}/edit`;

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let result_template = response.result_template;

                    // fill the values
                    $('#attach_re_temp_id').val(result_template.id);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    Swal.fire('Unable to Delete!', errorMessage, 'error');
                }
            })

            $('#attachment_modal').removeClass('hidden');
        });


        //update date
        $('#attachmentForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            let formData = new FormData(this); // Serialize the form data
            var res_temp_id = $('#attach_re_temp_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/cee/result-template/' + res_temp_id +
                    '/update-attachment', // Replace with your endpoint URL
                method: 'POST', // Use POST method
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false for file uploads
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#attachment_modal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });
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
    </script>
@endpush
