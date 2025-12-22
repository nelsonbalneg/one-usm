@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - School Names
@endsection

@push('styles')
      <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
        <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">School Information From DepEd</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Details</a>
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
                                <span class="align-middle">Add School</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">School ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    <!-- add Structure -->
    <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Add New School</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="addForm" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">
                        <!-- School ID -->
                        <div>
                            <label for="addschoolid" class="block mb-2 text-base font-medium">Room Name</label>
                            <input type="text" id="addschoolid" name="schoolid" placeholder="Enter school id"
                                class="form-input" value="{{ old('schoolid') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="addschoolname" class="block mb-2 text-base font-medium">School Name</label>
                            <input type="text" id="addschoolname" name="school_name" placeholder="Enter School Name"
                                class="form-input" value="{{ old('school_name') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="addschooladdress" class="block mb-2 text-base font-medium">School Name</label>
                            <input type="text" id="addschooladdress" name="school_address"
                                placeholder="Enter School Address" class="form-input" value="{{ old('school_address') }}">
                        </div>


                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="cancelAddModal"
                            class="text-red-500 bg-white btn hover:bg-red-100">Cancel</button>
                        <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save School</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- add Structure -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Edit School Information</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="editForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">
                        <!-- School ID -->
                        <input type="hidden" id="school_id" name="school_id">
                        <div>
                            <label for="editschoolid" class="block mb-2 text-base font-medium">Room Name</label>
                            <input type="text" id="editschoolid" name="schoolid" placeholder="Enter school id"
                                class="form-input" value="{{ old('schoolid') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="editschoolname" class="block mb-2 text-base font-medium">School Name</label>
                            <input type="text" id="editschoolname" name="school_name" placeholder="Enter School Name"
                                class="form-input" value="{{ old('school_name') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="editschooladdress" class="block mb-2 text-base font-medium">School Name</label>
                            <input type="text" id="editschooladdress" name="school_address"
                                placeholder="Enter School Address" class="form-input"
                                value="{{ old('school_address') }}">
                        </div>


                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="cancelAddModal"
                            class="text-red-500 bg-white btn hover:bg-red-100">Cancel</button>
                        <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            loaddata();
        });

        function loaddata() {

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
                        targets: [0, 1, 2, 3]
                    },
                ],
                language: {
                   "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.cee.school-names.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Ensures Laravel recognizes the request as AJAX
                    }
                },
                columns: [{
                        data: "schoolid",
                        name: "schoolid"
                    },
                    {
                        data: 'school_name',
                        name: 'school_name'
                    },
                    {
                        data: 'school_address',
                        name: 'school_address'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [1, "asc"]
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

        // Initialize modal add user entry
        $('body').on('click', '#openModalButton', function(event) {
            event.preventDefault();
            $('#addModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addModal');
            const closeModalButtons = modal.querySelectorAll('#cancelAddModal');

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

            //add new user
            $('#addForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize(); // Instead of new FormData(this)

                $.ajax({
                    url: "{{ route('admin.cee.school.store') }}",
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
                            location
                                .reload(); // Fallback to full page reload if not using DataTables
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error Response:", xhr
                            .responseText); // Check the error response
                        Swal.fire("Error", data.message, 'error', {
                            button: true,
                            button: "OK"
                        });
                    }
                });
            });
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('editModal');
            const closeModalButtons = modal.querySelectorAll('#cancelAddModal');

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

        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.edit-entry', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/cee/school-name/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let schoolname = response.schoolname;

                    // fill the values
                    $('#school_id').val(schoolname.id);
                    $('#editschoolid').val(schoolname.schoolid);
                    $('#editschoolname').val(schoolname.school_name);
                    $('#editschooladdress').val(schoolname.school_address);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            });
            $('#editModal').removeClass('hidden'); // Open modal
        });

          //update date
          $('#editForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var schoolid = $('#school_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/cee/school/update/' + schoolid, // Replace with your endpoint URL
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
