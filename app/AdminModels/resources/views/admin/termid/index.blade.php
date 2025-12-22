@extends('admin.layouts.master')
@section('title')
    USM-CEE | Program Tagging
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />

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
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">Term IDs of USM campuses</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">USMCEE</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Settings</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Term IDs</a>
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
                    <div class="flex">
                        <h6 class="uppercase text-15 grow">LIST OF Campuses and Term IDs</h6>
                        <div class="flex items-center gap-2 space-x-4">


                            <!-- Create room Button -->
                            <a type="button" id="openModalButton"
                                class="flex items-center justify-center h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Campus</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Campus</th>
                                <th>Real Campus ID</th>
                                <th>Term ID</th>
                                <th>Description</th>
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
    <div id="editdrawer" drawer-end
        class="fixed inset-y-0 flex flex-col hidden w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Edit Campus Details</h5>
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

                            <input type="hidden" id="termid_id" name="termid_id">

                            <div>
                                <label for="editcampus_name" class="block mb-2 text-base font-medium"></label>
                                <input type="text" id="editcampus_name" name="campus_name" class="form-input"
                                    value="{{ old('campus_name') }}">
                            </div>

                            <div>
                                <label for="editdescription" class="block mb-2 text-base font-medium"></label>
                                <input type="text" id="editdescription" name="description" class="form-input"
                                    value="{{ old('description') }}">
                            </div>


                            <div>
                                <label for="editcampus_id" class="block mb-2 text-base font-medium">Campus ID</label>
                                <input type="text" id="editcampus_id" name="campus_id" class="form-input"
                                    value="{{ old('campus_id') }}">
                            </div>

                            <div>
                                <label for="editreal_campus_id" class="block mb-2 text-base font-medium">Real Campus
                                    ID</label>
                                <input type="text" id="editreal_campus_id" name="real_campus_id" class="form-input"
                                    value="{{ old('real_campus_id') }}">
                            </div>

                            <div>
                                <label for="editterm_id" class="block mb-2 text-base font-medium">Term ID</label>
                                <input type="text" id="editterm_id" name="term_id" class="form-input"
                                    value="{{ old('term_id') }}">
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
                deferRender: true,
                ajax: {
                    url: "{{ route('admin.termid.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Ensures Laravel recognizes the request as AJAX
                    }
                },
                columns: [{
                        data: "campus_name",
                        name: "campus_name"
                    },
                    {
                        data: 'real_campus_id',
                        name: 'real_campus_id'
                    },
                    {
                        data: 'termid',
                        name: 'termid'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
        $('body').on('change', '.change-status', function() {

            // Check the toggle button's status
            let isChecked = $(this).is(':checked');
            // Get the id
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.termid.change-status') }}",
                method: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}", // <-- REQUIRED
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

                    const editUrl = `/admin/cee/booklet/${id}/edit`;

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
    </script>
@endpush
