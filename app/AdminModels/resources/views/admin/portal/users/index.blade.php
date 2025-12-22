@extends('admin.layouts.master')
@section('title')
    ONE USM | Portal User Management
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
            <h5 class="text-16">One USM - Portal User Management</h5>
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
                <a href="#!" class="text-slate-400 dark:text-zink-200">Users</a>
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
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Users List</h6>
                        <div class="shrink-0">
                            <button type="button" data-drawer-target="drawerterms"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add User</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">Student ID</th>
                                <th>Full Name</th>
                                <th>Campus</th>
                                <th>Birthdate</th>
                                <th>Role</th>
                                <th>Date Registered</th>
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
            <h5 class="text-16">Register New User</h5>
            <button data-drawer-close="drawerterms"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="addUserForm" method="POST">
                        @csrf

                        <div
                            class="flex gap-3 p-4 mb-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <div>
                                <h6 class="mb-1">Please read this note.</h6>
                                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i>The Default
                                    password is your Student ID.</p>
                                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i>The account
                                    details will be sent to the email registered by the user.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">

                            <div>
                                <div class="mb-4">
                                    <label for="campus_selector" class="block mb-2 text-base font-medium">Select
                                        Campus</label>
                                    <select id="campus_selector" name="campus_selector" class="w-full form-input">
                                        <option value="">-- Select Campus --</option>

                                        @php
                                            $campuses = [
                                                [
                                                    'description' => 'USM Kabacan Campus',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'USM Kidapawan Campus',
                                                    'real_campus_id' => 3,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Palma Campus',
                                                    'real_campus_id' => 5,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'USM Mlang Campus',
                                                    'real_campus_id' => 6,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Pigcawayan Campus',
                                                    'real_campus_id' => 7,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Pigcawayan Campus',
                                                    'real_campus_id' => 8,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'Graduate School',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                                [
                                                    'description' => 'College of Law',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                                [
                                                    'description' => 'College of Medicine',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus['real_campus_id'] }}|{{ $campus['tenant_id'] }}">
                                                {{ $campus['description'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- Student ID-->
                            <div>
                                <label for="addStudentId" class="block mb-2 text-base font-medium">Student ID</label>
                                <input type="text" id="addStudentId" name="student_id" placeholder="Enter Student ID"
                                    class="form-input" value="{{ old('student_id') }}">
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="addFirstname" class="block mb-2 text-base font-medium">First Name</label>
                                <input type="text" id="addFirstname" name="firstname" placeholder="Enter first name"
                                    class="form-input" value="{{ old('firstname') }}">
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="addLastname" class="block mb-2 text-base font-medium">Last Name</label>
                                <input type="text" id="addLastname" name="lastname" placeholder="Enter last name"
                                    class="form-input" value="{{ old('lastname') }}">
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="addMiddlename" class="block mb-2 text-base font-medium">Middle Name</label>
                                <input type="text" id="addMiddlename" name="middlename" placeholder="Enter middle name"
                                    class="form-input" value="{{ old('middlename') }}">
                            </div>

                            <!-- Suffix -->
                            <div>
                                <label for="addSuffix" class="block mb-2 text-base font-medium">Suffix (Extension)</label>
                                <select id="addSuffix" name="suffix" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                </select>
                            </div>


                            <!-- Birthdate -->
                            <div>
                                <label for="addBirthdate" class="block mb-2 text-base font-medium">Birthdate</label>
                                <input type="date" id="addBirthdate" name="birthdate" placeholder="Select date"
                                    data-provider="flatpickr" data-date-format="M d, Y" class="form-input"
                                    value="{{ old('birthdate') }}">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="addEmail" class="block mb-2 text-base font-medium">Email Address</label>
                                <input type="email" id="addEmail" name="email" placeholder="Enter email address"
                                    class="form-input" value="{{ old('email') }}">

                                {{-- Display validation error for email --}}
                                @error('email')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="addRole" class="block mb-2 text-base font-medium">Role</label>
                                <select id="addRole" name="role" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="student" selected>Student</option>
                                    <option value="utdc">UTDC</option>
                                    <option value="admin">Admin</option>
                                    <option value="osa">OSA</option>
                                    <option value="aro">Aro</option>
                                    <option value="dean">Dean</option>
                                    <option value="vpaa">VPAA</option>
                                    <option value="parent">Parent</option>
                                </select>
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="addStatus" class="block mb-2 text-base font-medium">Status</label>
                                <select id="addStatus" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-4">
                            <button type="submit" class="w-full text-white bg-custom-500 btn hover:bg-custom-600">Save
                                New User</button>
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

    {{-- edit user start drawer --}}
    <div id="draweredituser" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Edit User Details</h5>
            <button data-drawer-close="draweredituser"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <form id="editForm">
                        @csrf
                        @method('PUT')

                        <div
                            class="flex gap-3 p-4 mb-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <div>
                                <h6 class="mb-1">Please read this note.</h6>
                                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i>The Default
                                    password is your Student ID.</p>
                                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i>The account
                                    details will be sent to the email registered by the user.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">

                            <input type="hidden" name="userid" id="userid">

                            <div>
                                <div class="mb-4">
                                    <label for="campus1" class="block mb-2 text-base font-medium">Select
                                        Campus</label>
                                    <select id="campus1" name="campus_selector" class="w-full form-input">
                                        <option value="">-- Select Campus --</option>

                                        @php
                                            $campuses = [
                                                [
                                                    'description' => 'USM Kabacan Campus',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'USM Kidapawan Campus',
                                                    'real_campus_id' => 3,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Palma Campus',
                                                    'real_campus_id' => 5,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'USM Mlang Campus',
                                                    'real_campus_id' => 6,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Pigcawayan Campus',
                                                    'real_campus_id' => 7,
                                                    'tenant_id' => 3,
                                                ],
                                                [
                                                    'description' => 'USM Pigcawayan Campus',
                                                    'real_campus_id' => 8,
                                                    'tenant_id' => 1,
                                                ],
                                                [
                                                    'description' => 'Graduate School',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                                [
                                                    'description' => 'College of Law',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                                [
                                                    'description' => 'College of Medicine',
                                                    'real_campus_id' => 1,
                                                    'tenant_id' => 4,
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus['real_campus_id'] }}|{{ $campus['tenant_id'] }}">
                                                {{ $campus['description'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Student ID-->
                            <div>
                                <label for="EditStudentId" class="block mb-2 text-base font-medium">Student ID</label>
                                <input type="text" id="student_id1" name="student_id" placeholder="Enter Student ID"
                                    class="form-input" value="{{ old('student_id') }}">
                            </div>

                            <!-- First Name -->
                            <div>
                                <label for="EditFirstname" class="block mb-2 text-base font-medium">First Name</label>
                                <input type="text" id="firstname1" name="firstname" placeholder="Enter first name"
                                    class="form-input" value="{{ old('firstname') }}">
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="EditLastname" class="block mb-2 text-base font-medium">Last Name</label>
                                <input type="text" id="lastname1" name="lastname" placeholder="Enter last name"
                                    class="form-input" value="{{ old('lastname') }}">
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="EditMiddlename" class="block mb-2 text-base font-medium">Middle Name</label>
                                <input type="text" id="middlename1" name="middlename" placeholder="Enter middle name"
                                    class="form-input" value="{{ old('middlename') }}">
                            </div>

                            <!-- Suffix -->
                            <div>
                                <label for="EditSuffix" class="block mb-2 text-base font-medium">Suffix
                                    (Extension)</label>
                                <select id="suffix1" name="suffix" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                </select>
                            </div>


                            <!-- Birthdate -->
                            <div>
                                <label for="EditBirthdate" class="block mb-2 text-base font-medium">Birthdate</label>
                                <input type="date" id="birthdate1" name="birthdate" placeholder="Select date"
                                    data-provider="flatpickr" data-date-format="M d, Y" class="form-input"
                                    value="{{ old('birthdate') }}">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="EditEmail" class="block mb-2 text-base font-medium">Email Address</label>
                                <input type="email" id="email1" name="email" placeholder="Enter email address"
                                    class="form-input" value="{{ old('email') }}">

                                {{-- Display validation error for email --}}
                                @error('email')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="EditRole" class="block mb-2 text-base font-medium">Role</label>
                                <select id="role1" name="role" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="student" selected>Student</option>
                                    <option value="utdc">UTDC</option>
                                    <option value="admin">Admin</option>
                                    <option value="osa">OSA</option>
                                    <option value="aro">Aro</option>
                                    <option value="dean">Dean</option>
                                    <option value="vpaa">VPAA</option>
                                    <option value="parent">Parent</option>
                                </select>
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="EditStatus" class="block mb-2 text-base font-medium">Status</label>
                                <select id="status1" name="status" class="form-input">
                                    <option value="">--Select--</option>
                                    <option value="active" selected>Active</option>
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
            <h6 class="text-15">One USM Integrated Information System</h6>
        </div>
    </div>
    {{-- edit drawer --}}

    {{-- Change pass --}}
    <div id="changepassModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay (no pointer events) -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50 pointer-events-none"></div>

        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10 pointer-events-auto">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Change Passsword</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="changepassForm">
                    @csrf
                    @method('PUT')
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <input type="hidden" name="userChangepassId" id="userChangepassId">
                        <div class="xl:col-span-12">
                            <label for="password" class="inline-block mb-2 text-base font-medium">New Password</label>
                            <input type="pasword" id="password" name="password"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Password" value="{{ old('password') }}">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Change
                            Password</button>
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
                    url: "{{ route('admin.portal.users.get-all-users') }}",
                    type: "GET",
                    dataType: "JSON",
                    complete: function() {
                        // Hide the spinner overlay when processing is complete
                        $('#spinnerOverlay').addClass('hidden');
                    }
                },
                columns: [{
                        data: 'student_id',
                        name: 'student_id'
                    },
                    {

                        data: "fullname",
                        name: "fullname"
                    },
                    {

                        data: "campus",
                        name: "campus"
                    },

                    {
                        data: 'birthdate',
                        name: 'birthdate',
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
                        data: 'role',
                        name: 'role'
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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

    <script>
        //add new user
        $('#addUserForm').submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize(); // Instead of new FormData(this)

            $.ajax({
                url: "{{ route('admin.portal.users.store') }}",
                method: 'POST', // Use POST method
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //  $('#addUserModal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });
                    // Reset the form
                    $('#addUserForm')[0].reset();

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

                        // Display specific validation messages
                        let errorMessages = "";
                        if (errors.email) {
                            errorMessages += "Email: " + errors.email[0] + "\n";
                        }
                        if (errors.phone) {
                            errorMessages += "Phone: " + errors.phone[0] + "\n";
                        }

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

                    const editUrl = `/admin/portal/users/${id}/edit`;

                    // Fetch user data and populate the drawer
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.user) {
                                let user = response.user;
                                // fill the values
                                $('#userid').val(user.id);
                                $('#student_id1').val(user.student_id);
                                $('#firstname1').val(user.firstname);
                                $('#lastname1').val(user.lastname);
                                $('#middlename1').val(user.middlename);
                                $('#suffix1').val(user.suffix);
                                $('#birthdate1').val(user.birthdate);
                                $('#email1').val(user.email);
                                $('#role1').val(user.role);
                                $('#status1').val(user.status);

                                // Preselect the campus
                                if (user.campus_id && user.tenant_id) {
                                    $('#campus1').val(user.campus_id + '|' + user.tenant_id);
                                }

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

            // Get form data
            var formData = $(this).serialize();
            var userid = $('#userid').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/portal/users/' + userid, // Replace with your endpoint URL
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });

                    // Reset the form
                    $('#editForm')[0].reset();
                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON; // Parse the JSON error response

                    if (response && response.errors) {
                        // Loop through each validation error and display them as individual alerts
                        let errorMessages = '';
                        Object.values(response.errors).forEach(function(errorArray) {
                            errorMessages += errorArray.join('<br>') +
                                '<br>'; // Concatenate error messages
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessages, // Use `html` to display formatted error list
                            confirmButtonText: 'OK',
                        });
                    } else {
                        // General error (e.g., server error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again later.',
                            confirmButtonText: 'OK',
                        });
                    }
                }
            });
        });
    </script>

    {{-- change passwword script --}}
    <script>
        //change password
        $('body').on('click', '.change-pass', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/portal/users/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let user = response.user;

                    // fill the values
                    $('#userChangepassId').val(user.id);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    Swal.fire('Unable to Delete!', errorMessage, 'error');
                }
            })

            $('#changepassModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('changepassModal');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

        });

        //update date
        $('#changepassForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var userid = $('#userChangepassId').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/portal/users/update-password/' + userid, // Replace with your endpoint URL
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#changepassModal').addClass('hidden');

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
