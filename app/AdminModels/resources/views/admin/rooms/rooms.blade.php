@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Room Management
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> --}}
    {{-- <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-yH8gkCwNFfWfEsmCwN0i1VlzDq+W8sELpAo0P5NdVs4KJIp4jOSAmhpN6wX6Z1GDZCBoBPuiGNsq4CPVx1u9ZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <div class="flex">
                        <h6 class="text-15 grow">LIST OF ROOMS</h6>
                        <div class="flex items-center gap-2 space-x-4">


                            <!-- Create room Button -->
                            <a type="button" id="openModalButton"
                                class="flex items-center justify-center h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Room</span>
                            </a>

                            <!-- View room realtime slots -->
                            <a type="button" href="{{ route('admin.cee.rooms.view') }}"
                                class="flex items-center justify-center h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="eye" class="inline-block size-4"></i>
                                <span class="align-middle"> View Rooms</span>
                            </a>


                            <!-- Dropdown for Filter -->
                            <div class="relative dropdown">
                                <button type="button"
                                    class="flex items-center justify-center p-0 bg-white size-8 text-slate-500 btn hover:text-slate-600 hover:bg-slate-100 focus:text-slate-600 focus:bg-slate-100 active:text-slate-700 active:bg-slate-200 dark:bg-zinc-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle"
                                    id="dailyVisitInsightsDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-2 bg-white rounded-md shadow-md dropdown-menu min-w-[14rem] dark:bg-zinc-600"
                                    aria-labelledby="dailyVisitInsightsDropdown">
                                    <div class="px-3 py-2">
                                        <label for="cee-term-select"
                                            class="block text-sm font-medium text-slate-600 dark:text-white">
                                            Filter by CEE Terms
                                        </label>
                                        <select id="cee-term-select" name="cee_session_id" data-choices
                                            class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                                            <option disabled>Select Term</option>
                                            @foreach ($ceeSessions as $session)
                                                <option value="{{ $session->id }}"
                                                    {{ isset($activeSession) && $activeSession->id == $session->id ? 'selected' : '' }}>
                                                    {{ $session->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sequence</th>
                                <th>Room</th>
                                <th>College</th>
                                <th>Available Slots</th>
                                <th>Total Reservations</th>
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

    <!-- add Structure -->
    <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Add New Room</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="addForm" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">

                        <!-- college name -->
                        <div>
                            <label for="addcampus" class="block mb-2 text-base font-medium">Campus</label>
                            <select id="addcampus" name="campus" class="form-input">
                                <option value="">--Select--</option>
                                <option value="Main Campus">USM Main</option>
                                <option value="USM KCC">USM KCC</option>
                                <option value="USM Mlang">USM Mlang</option>s
                                <option value="USM Antipas">USM Antipas</option>
                                <option value="USM Pigcawayan">USM Pigcawayan</option>
                            </select>
                        </div>
                        <!-- college name -->
                        <div>
                            <label for="addcollege_name" class="block mb-2 text-base font-medium">College or
                                Building</label>
                            <select id="addcollege_name" name="college_name" class="form-input">
                                <option value="">--Select--</option>
                                <option value="College of Business, Development Economics and Management">College of
                                    Business, Development Economics and Management</option>
                                <option value="College of Agriculture">College of Agriculture</option>
                                <option value="College of Arts and Social Sciences">College of Arts and Social Sciences
                                </option>
                                <option value="College of Science and Mathematics">College of Science and Mathematics
                                </option>
                                <option value="College of Health Sciences">College of Health Sciences</option>
                                <option value="College of Human Ecology and Food Sciences">College of Human Ecology and Food
                                    Sciences</option>
                                <option value="College of Veterinary Medicine">College of Veterinary Medicine</option>
                                <option value="College of Education">College of Education</option>
                                <option value="College of Engineering and Information Technology">College of Engineering and
                                    Information Technology</option>
                                <option value="College of Trades and Industries">College of Trades and Industries</option>
                                <option value="University Laboratory School">University Laboratory School</option>
                                <option value="USM Kidapawan City Campus">USM Kidapawan City Campus</option>
                                <option value="USM Palma Campus">USM Palma Campus</option>
                                <option value="USM Antipas">USM Antipas</option>
                                <option value="USM Mlang">USM Mlang</option>
                                <option value="USM Pigcawayan">USM Pigcawayan</option>
                            </select>
                        </div>

                        <!-- Room Name -->
                        <div>
                            <label for="addroom_name" class="block mb-2 text-base font-medium">Room Name</label>
                            <input type="text" id="addroom_name" name="room_name" placeholder="Enter room name"
                                class="form-input" value="{{ old('room_name') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="addcapacity" class="block mb-2 text-base font-medium">Capacity</label>
                            <input type="number" id="addcapacity" name="capacity" placeholder="Enter Capacity"
                                class="form-input" value="{{ old('capacity') }}">
                        </div>

                        <!-- Batch -->
                        <div>
                            <label for="addbatch" class="block mb-2 text-base font-medium">Exam Batch</label>
                            <select id="addbatch" name="batch" class="form-input">
                                <option value="">--Select--</option>
                                <option value="Batch 1">Batch 1</option>
                                <option value="Batch 2">Batch 2</option>
                                <option value="Batch 3">Batch 3</option>
                            </select>
                        </div>

                        <!-- schedule -->
                        <div>
                            <label for="addschedule" class="block mb-2 text-base font-medium">Schedule</label>
                            <input type="date" id="addschedule" name="schedule" placeholder="Select date"
                                data-provider="flatpickr" data-date-format="M d, Y" class="form-input"
                                value="{{ old('schedule') }}">
                        </div>

                        <!-- Time -->
                        <div>
                            <label for="addtime" class="block mb-2 text-base font-medium">Time</label>
                            <input type="text" id="addtime" name="time" placeholder="Enter time"
                                class="form-input" value="{{ old('time') }}">
                        </div>

                        <!-- Sequence No -->
                        <div>
                            <label for="addsequence_no" class="block mb-2 text-base font-medium">Sequence No</label>
                            <input type="number" id="addsequence_no" name="sequence_no" placeholder="Enter sequence no"
                                class="form-input" value="{{ old('sequence_no', 0) }}" min="0">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="cancelAddModal"
                            class="text-red-500 bg-white btn hover:bg-red-100">Cancel</button>
                        <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Change pass --}}
    <div id="addSlot" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Add Slot</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addSlotForm">
                    @csrf
                    @method('PUT')
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">

                            <input type="hidden" name="room_id" id="room_id">
                            <div class="mb-4">
                                <label for="addslotroom_name" class="block mb-2 text-base font-medium">Room Name</label>
                                <input type="text" id="addslotroom_name" name="room_name"
                                    placeholder="Enter room name" class="form-input" value="{{ old('room_name') }}"
                                    readonly>
                            </div>

                            <!-- Capacity -->
                            <div>
                                <label for="addslotcapacity" class="block mb-2 text-base font-medium">Capacity</label>
                                <input type="number" id="addslotcapacity" name="capacity" placeholder="Enter Capacity"
                                    class="form-input" value="{{ old('capacity') }}">
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Add
                            Slot</button>
                    </div>
            </div>

            </form>
        </div>
    </div>

    <!-- edit Structure -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Edit Room Details</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">

                        <input type="hidden" id="editroom_id" name="room_id">

                        <!-- college name -->
                        <div>
                            <label for="editcampus" class="block mb-2 text-base font-medium">Campus</label>
                            <select id="editcampus" name="campus" class="form-input">
                                <option value="">--Select--</option>
                                <option value="Main Campus">USM Main</option>
                                <option value="USM KCC">USM KCC</option>
                                <option value="USM Mlang">USM Mlang</option>s
                                <option value="USM Antipas">USM Antipas</option>
                                <option value="USM Pigcawayan">USM Pigcawayan</option>
                            </select>
                        </div>
                        <!-- college name -->
                        <div>
                            <label for="editcollege_name" class="block mb-2 text-base font-medium">College or
                                Building</label>
                            <select id="editcollege_name" name="college_name" class="form-input">
                                <option value="">--Select--</option>
                                <option value="College of Business, Development Economics and Management">College of
                                    Business, Development Economics and Management</option>
                                <option value="College of Agriculture">College of Agriculture</option>
                                <option value="College of Arts and Social Sciences">College of Arts and Social Sciences
                                </option>
                                <option value="College of Science and Mathematics">College of Science and Mathematics
                                </option>
                                <option value="College of Health Sciences">College of Health Sciences</option>
                                <option value="College of Human Ecology and Food Sciences">College of Human Ecology and
                                    Food
                                    Sciences</option>
                                <option value="College of Veterinary Medicine">College of Veterinary Medicine</option>
                                <option value="College of Education">College of Education</option>
                                <option value="College of Engineering and Information Technology">College of Engineering
                                    and
                                    Information Technology</option>
                                <option value="College of Trades and Industries">College of Trades and Industries</option>
                                <option value="University Laboratory School">University Laboratory School</option>
                                <option value="USM Kidapawan City Campus">USM Kidapawan City Campus</option>
                                <option value="USM Palma Campus">USM Palma Campus</option>
                                <option value="USM Antipas">USM Antipas</option>
                                <option value="USM Mlang">USM Mlang</option>
                                <option value="USM Pigcawayan">USM Pigcawayan</option>
                            </select>
                        </div>

                        <!-- Room Name -->
                        <div>
                            <label for="editroom_name" class="block mb-2 text-base font-medium">Room Name</label>
                            <input type="text" id="editroom_name" name="room_name" placeholder="Enter room name"
                                class="form-input" value="{{ old('room_name') }}">
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="editcapacity" class="block mb-2 text-base font-medium">Capacity</label>
                            <input type="number" id="editcapacity" name="capacity" placeholder="Enter Capacity"
                                class="form-input" value="{{ old('capacity') }}">
                        </div>

                        <!-- Batch -->
                        <div>
                            <label for="editbatch" class="block mb-2 text-base font-medium">Exam Batch</label>
                            <select id="editbatch" name="batch" class="form-input">
                                <option value="">--Select--</option>
                                <option value="Batch 1">Batch 1</option>
                                <option value="Batch 2">Batch 2</option>
                                <option value="Batch 3">Batch 3</option>
                            </select>
                        </div>

                        <!-- schedule -->
                        <div>
                            <label for="editschedule" class="block mb-2 text-base font-medium">Schedule</label>
                            <input type="date" id="editschedule" name="schedule" placeholder="Select date"
                                data-provider="flatpickr" data-date-format="M d, Y" class="form-input"
                                value="{{ old('schedule') }}">
                        </div>

                        <!-- Time -->
                        <div>
                            <label for="edittime" class="block mb-2 text-base font-medium">Time</label>
                            <input type="text" id="edittime" name="time" placeholder="Enter time"
                                class="form-input" value="{{ old('time') }}">
                        </div>

                        <!-- Sequence No -->
                        <div>
                            <label for="editsequence_no" class="block mb-2 text-base font-medium">Sequence No</label>
                            <input type="number" id="editsequence_no" name="sequence_no"
                                placeholder="Enter sequence no" class="form-input" value="{{ old('sequence_no', 0) }}"
                                min="0">
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
    {{-- data table scripts --}}
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Ensure the CSRF token is set up for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table();
        });

        function table() {
            let activeSessionId = $('#cee-term-select').val();
            let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem('currentPage')) : 0;

            if ($.fn.DataTable.isDataTable('#dbData')) {
                console.log("Destroying existing DataTable instance."); // Debugging line
                $('#dbData').DataTable().destroy();
            }

            // Store DataTable instance in a variable
            let dataTable = $('#dbData').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: "{{ route('admin.room.get-all') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.cee_session_id = $('#cee-term-select').val() || activeSessionId;
                    }
                },
                columns: [{
                        data: 'sequence_no',
                        name: 'sequence_no'
                    },
                    {
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
                        data: 'total_reservations',
                        name: 'total_reservations'
                    },
                    {
                        data: 'exam_session',
                        name: 'exam_session'
                    },
                    {
                        data: 'schedule',
                        name: 'schedule',
                        render: function(data) {
                            const date = new Date(data);
                            return date.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
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
                    }
                ],
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                drawCallback: function() {
                    lucide.createIcons();
                },
                initComplete: function() {
                    if (currentPage) {
                        dataTable.page(currentPage).draw('page');
                    }
                }
            });

            // Attach event listeners to the DataTable instance
            dataTable.on('page.dt', function() {
                let pageInfo = dataTable.page.info();
                sessionStorage.setItem('currentPage', pageInfo.page);
            });

            $('#dbData_filter input').on('input', function() {
                let searchValue = $(this).val();
                if (searchValue === '') {
                    currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                        'currentPage')) : 0;
                    dataTable.page(currentPage).draw(false);
                } else {
                    let pageInfo = dataTable.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                }
            });

            $('#cee-term-select').change(function() {
                dataTable.ajax.reload();
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
            // modal.addEventListener('click', (event) => {
            //     if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
            //         modal.classList.add('hidden');
            //     }
            // });
        });

        //add new user
        $('#addForm').submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize(); // Instead of new FormData(this)

            $.ajax({
                url: "{{ route('admin.rooms.store') }}",
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

        //add slot
        $('body').on('click', '.add-slot', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/rooms/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let room = response.room;

                    // fill the values
                    $('#room_id').val(room.id);
                    $('#addslotroom_name').val(room.room_name);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    Swal.fire('Unable to add slot!', errorMessage, 'error');
                }
            })

            $('#addSlot').removeClass('hidden'); // Open modal
        });


        //update room slot
        $('#addSlotForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var roomid = $('#room_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/room/add-slot/' + roomid, // Replace with your endpoint URL
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // $('#addSlot').addClass('hidden');

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
                    console.log("Error Response:", xhr.responseText); // Check the error response
                    Swal.fire("Error", data.message, 'error', {
                        button: true,
                        button: "OK"
                    });
                }
            });
        });

        // JavaScript for closing the modal add slot
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addSlot');
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
    </script>

    <script>
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
            let editUrl = '/admin/rooms/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let room = response.room;

                    // fill the values
                    $('#editroom_id').val(room.id);
                    $('#editcampus').val(room.campus);
                    $('#editcollege_name').val(room.college_name);
                    $('#editroom_name').val(room.room_name);
                    $('#editcapacity').val(room.capacity);
                    $('#editbatch').val(room.exam_session);
                    $('#editschedule').val(room.schedule);
                    $('#edittime').val(room.time);
                    $('#editsequence_no').val(room.sequence_no);
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
            var roomid = $('#editroom_id').val(); // Get the category ID from the hidden input

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/rooms/' + roomid, // Replace with your endpoint URL
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
