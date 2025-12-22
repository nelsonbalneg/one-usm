@extends('admin.layouts.master')
@section('title')
    ONE USM | Clearance
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />

    <style>
        .wrap-text {
            white-space: normal !important;
            word-wrap: break-word;
            width: 150px !important;
            max-width: 150px !important;
        }

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
            <h5 class="text-16">One USM - Clearance</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Clearance</a>
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
                        <h6 class="text-15 grow">List of Students with Deliquencies</h6>
                        <div class="shrink-0">
                            <a href="{{ route('admin.portal.clearance.create') }}" type="button"
                                class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">
                                <i data-lucide="download" class="inline-block size-4"></i>
                                <span class="align-middle">Import</span>
                            </a>
                            <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Student</span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>AY/Semester</th>
                                <th>Office Name</th>
                                <th>Student Info</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Updated/Cleared By</th>
                                <th>Date</th>
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
            <h5 class="text-16">Add Deliquent Student</h5>
            <button data-drawer-close="drawerterms"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="addForm" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-4">

                            <!-- Semester ID-->
                            <div>
                                <input type="hidden" id="addSemesterName" name="semester">
                                <label for="addSemester" class="block mb-2 text-base font-medium">Semester</label>
                                <select id="addSemester" name="semester_id" class="form-input" onchange="setSemesterName()">
                                    <option value="">--Select--</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester['id'] }}" data-name="{{ $semester['term'] }}"
                                            style="{{ $semester['isActive'] ? 'color: green; font-weight: bold;' : '' }}">
                                            {{ $semester['term'] . ' - ' . $semester['campus_name'] }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div>
                                <label for="addOffice" class="block mb-2 text-base font-medium">Office</label>
                                <select id="addOffice" name="office_id" class="form-input">
                                    <option value="">--Select--</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach

                                </select>
                            </div>


                            <!-- Student ID-->
                            <div>
                                <label for="addStudentId" class="block mb-2 text-base font-medium">Student ID</label>
                                <input type="text" id="addStudentId" name="student_id" placeholder="Enter Student ID"
                                    class="form-input" value="{{ old('student_id') }}" onblur="fetchStudentInfo()">
                                <p id="studentIdError" class="mt-1 text-sm text-red-600"></p>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="addFirstname" class="block mb-2 text-base font-medium">First Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="addFirstname" name="firstname" placeholder="Enter first name"
                                    class="form-input" value="{{ old('firstname') }}" readonly>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="addLastname" class="block mb-2 text-base font-medium">Last Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="addLastname" name="lastname" placeholder="Enter last name"
                                    class="form-input" value="{{ old('lastname') }}" readonly>
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="addMiddlename" class="block mb-2 text-base font-medium">Middle Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="addMiddlename" name="middlename"
                                    placeholder="Enter middle name" class="form-input" value="{{ old('middlename') }}"
                                    readonly>
                            </div>

                            <!-- Suffix -->
                            <div>
                                <label for="addSuffix" class="block mb-2 text-base font-medium">Suffix (Extension)
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="addSuffix" name="suffix" placeholder="Enter Suffix"
                                    class="form-input" value="{{ old('suffix') }}" readonly>
                            </div>

                            <div>
                                <label for="addremarks" class="block mb-2 text-base font-medium">Remarks</label>
                                <textarea id="addremarks" name="remarks" class="h-64 form-input">{{ old('remarks') }}</textarea>
                            </div>
                            <!-- Role -->
                            <div>
                                <label for="addStatus" class="block mb-2 text-base font-medium">Status</label>
                                <select id="addStatus" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="delinquent" selected>Delinquent</option>
                                    <option value="cleared">Cleared</option>
                                </select>
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
            <h6 class="text-15">One USM Integrated Information System</h6>
        </div>
    </div>
    {{-- end drawer --}}

    {{-- edit student drawer --}}
    <div id="draweredituser" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Edit Deliquent Student</h5>
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

                            <input type="text" name="clearance_id" id="clearance_id">
                            <!-- Semester ID-->
                            <div>
                                <input type="text" id="editSemesterName" name="semester">
                                <label for="editSemester" class="block mb-2 text-base font-medium">Semester</label>
                                <select id="editSemester" name="semester_id" class="form-input"
                                    onchange="setSemesterNameonEdit()">
                                    <option value="">--Select--</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester['id'] }}" data-name="{{ $semester['term'] }}"
                                            style="{{ $semester['isActive'] ? 'color: green; font-weight: bold;' : '' }}">
                                            {{ $semester['term'] . ' - ' . $semester['campus_name'] }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div>
                                <label for="editOffice" class="block mb-2 text-base font-medium">Office</label>
                                <select id="editOffice" name="office_id" class="form-input">
                                    <option value="">--Select--</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach

                                </select>
                            </div>


                            <!-- Student ID-->
                            <div>
                                <label for="editStudentId" class="block mb-2 text-base font-medium">Student ID</label>
                                <input type="text" id="editStudentId" name="student_id"
                                    placeholder="Enter Student ID" class="form-input" value="{{ old('student_id') }}"
                                    onblur="fetchStudentInfoOnEdit()">
                                <p id="studentIdError" class="mt-1 text-sm text-red-600"></p>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="editFirstname" class="block mb-2 text-base font-medium">First Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="editFirstname" name="firstname" placeholder="Enter first name"
                                    class="form-input" value="{{ old('firstname') }}" readonly>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="editLastname" class="block mb-2 text-base font-medium">Last Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="editLastname" name="lastname" placeholder="Enter last name"
                                    class="form-input" value="{{ old('lastname') }}" readonly>
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="editMiddlename" class="block mb-2 text-base font-medium">Middle Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="editMiddlename" name="middlename"
                                    placeholder="Enter middle name" class="form-input" value="{{ old('middlename') }}"
                                    readonly>
                            </div>

                            <!-- Suffix -->
                            <div>
                                <label for="editSuffix" class="block mb-2 text-base font-medium">Suffix (Extension)
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="editSuffix" name="suffix" placeholder="Enter Suffix"
                                    class="form-input" value="{{ old('suffix') }}" readonly>
                            </div>

                            <div>
                                <label for="editremarks" class="block mb-2 text-base font-medium">Remarks</label>
                                <textarea id="editremarks" name="remarks" class="h-64 form-input">{{ old('remarks') }}</textarea>
                            </div>
                            <!-- Role -->
                            <div>
                                <label for="editStatus" class="block mb-2 text-base font-medium">Status</label>
                                <select id="editStatus" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="delinquent" selected>Delinquent</option>
                                    <option value="cleared">Cleared</option>
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
    {{-- end drawer --}}

    {{-- Update Clearance Status --}}
    <div id="updateClearanceStatusModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay (no pointer events) -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50 pointer-events-none"></div>

        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10 pointer-events-auto">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Update Clearance Status</h5>

                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="updateClearanceStatusForm">
                    @csrf
                    @method('PUT')
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <input type="hidden" name="clearanceStatusId" id="clearanceStatusId">
                        <div class="xl:col-span-12">

                            <!-- Student ID-->
                            <div class="mb-2">
                                <label for="student_id" class="block mb-2 text-base font-medium">Student ID<sup
                                        class="text-green-600">*readonly</sup></label>
                                <input type="text" id="student_id" name="student_id" placeholder="Enter Student ID"
                                    class="form-input" value="{{ old('student_id') }}" readonly>
                            </div>

                            <!-- First Name -->
                            <div class="mb-2">
                                <label for="fullname" class="block mb-2 text-base font-medium">First Name
                                    <sup class="text-green-600">*readonly</sup>
                                </label>
                                <input type="text" id="fullname" name="fullname" placeholder="Enter first name"
                                    class="form-input" value="{{ old('fullname') }}" readonly>
                            </div>

                            <div class="mb-2">
                                <label for="description" class="block mb-2 text-base font-medium">Description</label>
                                <textarea id="description" name="description" class="h-64 form-input">{{ old('description') }}</textarea>
                            </div>
                            <!-- Role -->
                            <div>
                                <label for="Status" class="block mb-2 text-base font-medium">Status</label>
                                <select id="Status" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="delinquent">Delinquent</option>
                                    <option value="cleared" selected>Cleared</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="closeModalButton"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                            Save Changes</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    {{-- Update Clearance Status --}}
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>

    {{-- data table --}}
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
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.portal.clearance.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    complete: function() {
                        // Hide the spinner overlay when processing is complete
                        $('#spinnerOverlay').addClass('hidden');
                    }
                },
                columns: [{
                        data: "school_year",
                        name: "school_year"
                    },
                    {
                        data: "office_name",
                        name: "office_name",
                    },
                    {
                        data: "fullname",
                        name: "fullname"
                    },
                    {

                        data: "remarks",
                        name: "remarks",
                        className: "wrap-text"
                    },
                    {

                        data: "status",
                        name: "status",
                          className: "wrap-text"
                    },
                    {

                        data: "causer",
                        name: "causer"
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
                    [6, "desc"]
                ],
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                drawCallback: function(settings) {
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

    {{-- fetch student data --}}
    <script>
        function fetchStudentInfo() {
            const studentId = document.getElementById('addStudentId').value;
            const errorBox = document.getElementById('studentIdError');

            // **Clear previous error**
            errorBox.textContent = "";

            // **If input is empty → clear all fields**
            if (!studentId.trim()) {
                clearStudentFields();
                return;
            }

            fetch(`/admin/portal/clearance/${studentId}/fetch-student`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('addFirstname').value = data.student.firstname ?? '';
                        document.getElementById('addLastname').value = data.student.lastname ?? '';
                        document.getElementById('addMiddlename').value = data.student.middlename ?? '';

                        if (document.getElementById('addSuffix')) {
                            document.getElementById('addSuffix').value = data.student.suffix ?? '';
                        }
                    } else {
                        // Student not found → show error + clear fields
                        errorBox.textContent = "No matching student found.";
                        clearStudentFields();
                    }
                })
                .catch(error => console.error('Error fetching student:', error));
        }

        function fetchStudentInfoOnEdit() {
            const studentId = document.getElementById('editStudentId').value;
            const errorBox = document.getElementById('studentIdError');

            // **Clear previous error**
            errorBox.textContent = "";

            // **If input is empty → clear all fields**
            if (!studentId.trim()) {
                clearStudentFields();
                return;
            }

            fetch(`/admin/portal/clearance/${studentId}/fetch-student`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('editFirstname').value = data.student.firstname ?? '';
                        document.getElementById('editLastname').value = data.student.lastname ?? '';
                        document.getElementById('editMiddlename').value = data.student.middlename ?? '';

                        if (document.getElementById('editSuffix')) {
                            document.getElementById('editSuffix').value = data.student.suffix ?? '';
                        }
                    } else {
                        // Student not found → show error + clear fields
                        errorBox.textContent = "No matching student found.";
                        clearStudentFields();
                    }
                })
                .catch(error => console.error('Error fetching student:', error));
        }

        // Helper function to clear name fields
        function clearStudentFields() {
            document.getElementById('addFirstname').value = "";
            document.getElementById('addLastname').value = "";
            document.getElementById('addMiddlename').value = "";

            if (document.getElementById('addSuffix')) {
                document.getElementById('addSuffix').value = "";
            }
            document.getElementById('editFirstname').value = "";
            document.getElementById('editLastname').value = "";
            document.getElementById('editMiddlename').value = "";

            if (document.getElementById('editSuffix')) {
                document.getElementById('editSuffix').value = "";
            }
        }
    </script>

    {{-- Save the clearance to the DB --}}
    <script>
        function setSemesterName() {
            const select = document.getElementById('addSemester');
            const selected = select.options[select.selectedIndex];

            const semName = selected.getAttribute('data-name') ?? '';

            document.getElementById('addSemesterName').value = semName;
        }

        //add new user
        $('#addForm').submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize(); // Instead of new FormData(this)

            $.ajax({
                url: "{{ route('admin.portal.clearance.store') }}",
                method: 'POST', // Use POST method
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#addUserModal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });
                    // Reset the form
                    $('#addForm')[0].reset();

                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
                },
                error: function(xhr, status, error) {
                    // Parse the JSON response
                    if (xhr.status === 422) { // Laravel validation error
                        let errors = xhr.responseJSON.errors;

                        Swal.fire("Error", errorMessages, 'error', {
                            button: true,
                            button: "OK"
                        });
                    } else {
                        // Handle other errors
                        Swal.fire("Error", "An unexpected error occurred. Please try again.", 'error', {
                            button: true,
                            button: "OK"
                        });
                    }

                }
            });
        });
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

    {{-- edit and Updated --}}
    <script>
        function setSemesterNameonEdit() {
            const select = document.getElementById('editSemester');
            const selected = select.options[select.selectedIndex];

            const semName = selected.getAttribute('data-name') ?? '';

            document.getElementById('editSemesterName').value = semName;
        }


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

                    const editUrl = `/admin/portal/clearance/${id}/edit`;

                    // Fetch user data and populate the drawer
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.clearance) {
                                let clearance = response.clearance;
                                // fill the values
                                $('#clearance_id').val(clearance.id);
                                $('#editStudentId').val(clearance.student_id);
                                $('#editFirstname').val(clearance.firstname);
                                $('#editLastname').val(clearance.lastname);
                                $('#editMiddlename').val(clearance.middlename);
                                $('#editSuffix').val(clearance.suffix);
                                $('#editStatus').val(clearance.status);
                                $('#editremarks').val(clearance.remarks);

                                $('#editSemesterName').val(clearance.school_year);
                                $('#editSemester').val(clearance.semester_id);
                                $('#editOffice').val(clearance.office_id);


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
            let clearance_id = $('#clearance_id').val();

            $.ajax({
                url: '/admin/portal/clearance/' + clearance_id,
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

    {{-- update-clearance-status --}}
    <script>
        $('body').on('click', '.update-clearance-status', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/portal/clearance/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let clearance = response.clearance;

                    // fill the values
                    $('#clearanceStatusId').val(clearance.id);
                    $('#student_id').val(clearance.student_id);
                    $('#fullname').val(clearance.lastname + ', ' + clearance.firstname);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    Swal.fire('Unable to Delete!', errorMessage, 'error');
                }
            })

            $('#updateClearanceStatusModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('updateClearanceStatusModal');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

        });

        //update clearance status
        $('#updateClearanceStatusForm').on('submit', function(e) {
            e.preventDefault();

            let clearanceId = $('#clearanceStatusId').val();
            let formData = $(this).serialize();

            $.ajax({
                url: '/admin/portal/clearance/update-clearance-status/' + clearanceId,
                type: 'PATCH',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#updateClearanceStatusModal').addClass('hidden');

                    Swal.fire(
                        'Success',
                        response.message,
                        'success'
                    );

                     $('#updateClearanceStatusForm')[0].reset();

                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    let msg = xhr.responseJSON?.message || 'Something went wrong';
                    Swal.fire('Error', msg, 'error');
                }
            });
        });
    </script>
@endpush
