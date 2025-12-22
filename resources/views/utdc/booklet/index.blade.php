@extends('utdc.layouts.master')
@section('title')
     USM-AES | UTDC - Booklet Number
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <style>
        <style>#editdrawer {
            transform: translateX(100%);
            /* Hidden */
            transition: transform 0.3s ease-in-out;
        }

        #editdrawer.show {
            transform: translateX(0);
            /* Visible */
        }
    </style>
    </style>
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Reservation</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Booklet #</a>
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
                        <h6 class="text-15 grow">Records for {{ $ceeActiveSession->name }}</h6>
                        <div class="shrink-0">
                            <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Assign Booklet Number</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">App No</th>
                                <th>CEE Term</th>
                                <th>Full Name</th>
                                <th>Booklet Number</th>
                                <th>Date Created</th>
                                <th>Added By</th>
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
            <h5 class="text-16">Assign Booklet Number to CEE Applicant</h5>
            <button data-drawer-close="drawerterms"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="addBookletForm" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">

                            <div class="xl:col-span-12">
                                <label for="app_no" class="inline-block mb-2 text-base font-medium">
                                    App Number
                                </label>
                                <select id="app_no" name="app_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    <option value="" disabled selected>Select App Number</option>
                                </select>
                            </div>

                            <div class="xl:col-span-12">
                                <label for="fullname" class="inline-block mb-2 text-base font-medium">Full Name</label>
                                <input type="text" id="fullname" name="fullname"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter fullname " value="{{ old('fullname') }}" readonly>
                            </div>
                            <input type="hidden" id="userId" name="userId">
                            <input type="hidden" name="ceeTermId" value="{{ $ceeActiveSession->id }}">

                            <div class="xl:col-span-12">
                                <label for="bookletNo" class="inline-block mb-2 text-base font-medium">Booklet
                                    Number</label>
                                <input type="text" id="bookletNo" name="bookletNo"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Booket Number " value="{{ old('bookletNo') }}" required>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="envelopeNo" class="inline-block mb-2 text-base font-medium">Envelope
                                    Number</label>
                                <input type="text" id="envelopeNo" name="envelopeNo"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Envelop Number " value="{{ old('envelopeNo') }}" required>
                            </div>

                            <div class="xl:col-span-12">
                                <label for="revision_no" class="inline-block mb-2 text-base font-medium">Booklet Revision
                                    Number</label>
                                <input type="text" id="revision_no" name="revision_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Booklet Revision Number " value="{{ old('revision_no') }}">
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-4">
                            <button type="submit"
                                class="w-full text-white bg-custom-500 btn hover:bg-custom-600">Save</button>
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
            <h5 class="text-16">Edit Booklet Details</h5>
            <button data-drawer-close="editdrawer"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Full Name -->
                            <input type="hidden" id="booklet_id" name="booklet_id">
                            <div>
                                <label for="editfullname" class="block mb-2 text-base font-medium">Full Name</label>
                                <input type="text" id="editfullname" name="fullname" class="form-input"
                                    value="{{ old('fullname') }}" readonly>
                            </div>

                            <!-- App No -->
                            <div>
                                <label for="editAppNo" class="block mb-2 text-base font-medium">App No</label>
                                <input type="text" id="editAppNo" name="app_no" class="form-input"
                                    value="{{ old('app_no') }}" readonly>
                            </div>

                            <!-- bookletNo -->
                            <div>
                                <label for="editbookletNo" class="block mb-2 text-base font-medium">Booklet No</label>
                                <input type="text" id="editbookletNo" name="bookletNo" class="form-input"
                                    value="{{ old('bookletNo') }}">
                            </div>
                            <!-- bookletNo -->
                            <div>
                                <label for="editenvelopeNo" class="block mb-2 text-base font-medium">Envelope No</label>
                                <input type="text" id="editenvelopeNo" name="envelopeNo" class="form-input"
                                    value="{{ old('envelopeNo') }}">
                            </div>
                            <!-- bookletNo -->
                            <div>
                                <label for="editrevision_no" class="block mb-2 text-base font-medium">Revision No</label>
                                <input type="text" id="editrevision_no" name="revision_no" class="form-input"
                                    value="{{ old('revision_no') }}">
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
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appNoSelect = document.getElementById('app_no');
            const fullnameInput = document.getElementById('fullname');
            const userIdInput = document.getElementById('userId');
            let choicesInstance;

            // Initialize Choices.js on the select element
            choicesInstance = new Choices(appNoSelect, {
                searchEnabled: true,
                placeholderValue: 'Select App Number',
                noResultsText: 'No app numbers available',
            });

            // Fetch the app numbers from the backend
            fetch('/utdc/fetch-app-numbers', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const appNoOptions = data.data.map(appNumber => ({
                        value: appNumber.app_no,
                        label: `${appNumber.fullname} - ${appNumber.app_no}`,
                        customProperties: {
                            userId: appNumber.user_id,
                            fullname: appNumber.fullname
                        }
                    }));

                    // Populate the dropdown with fetched data
                    choicesInstance.setChoices(appNoOptions, 'value', 'label', true);
                })
                .catch(error => console.error('Error fetching app numbers:', error));

            // Handle change event on the dropdown
            appNoSelect.addEventListener('change', function() {
                const selectedOptionValue = appNoSelect.value; // Get the selected app_no value
                const selectedOption = appNoSelect.querySelector(
                    `option[value="${selectedOptionValue}"]`
                ); // Find the selected option in the DOM

                // Extract custom properties from the selected option's data attribute
                if (selectedOption && selectedOption.dataset.customProperties) {
                    const customProperties = JSON.parse(selectedOption.dataset.customProperties);

                    if (customProperties) {
                        fullnameInput.value = customProperties.fullname;
                        userIdInput.value = customProperties.userId;
                    } else {
                        fullnameInput.value = '';
                        userIdInput.value = '';
                    }
                } else {
                    fullnameInput.value = '';
                    userIdInput.value = '';
                }
            });
        });

        // Form submission with AJAX
        const addBookletForm = document.getElementById('addBookletForm');
        addBookletForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(addBookletForm);

            try {
                const response = await fetch("{{ route('utdc.cee.booklet.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                });

                const data = await response.json();

                Swal.fire("Success", data.message, 'success');

                // Reset form and dropdown
                addBookletForm.reset();
                // resetChoices(); // Reset Choices instance

                // Reload DataTable if available
                if ($.fn.DataTable.isDataTable('#dbData')) {
                    $('#dbData').DataTable().ajax.reload(null, false);
                }
            } catch (error) {
                console.error('Error submitting the form:', error);
                Swal.fire("Error", "An unexpected error occurred.", 'error');
            }
        });
    </script>

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
                    "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('utdc.cee.booklet.fetch-data') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: "app_no",
                        name: "app_no"
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'bookletNo',
                        name: 'bookletNo'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'added_by',
                        name: 'added_by',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [4, "desc"]
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

        //edit drawer
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

                    const editUrl = `/utdc/cee/booklet/${id}/edit`;

                    // Fetch template data and open the drawer
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.booklet) {
                                let booklet = response.booklet;
                                let fullname = response.fullname;

                                // Populate fields in the drawer
                                $('#booklet_id').val(booklet.id);
                                $('#editfullname').val(fullname);
                                $('#editbookletNo').val(booklet.bookletNo);
                                $('#editenvelopeNo').val(booklet.envelopeNo);
                                $('#editrevision_no').val(booklet.revision_no);
                                $('#editAppNo').val(booklet.app_no);

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
            var bookletid = $('#booklet_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/utdc/cee/booklet/' + bookletid, // Replace with your endpoint URL
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
