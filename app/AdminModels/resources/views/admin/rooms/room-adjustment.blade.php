@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Room Adjustment
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />

    <style>
        #drawerterms {
            transform: translateX(100%);
            /* Hidden */
            transition: transform 0.3s ease-in-out;
        }

        #drawerterms.show {
            transform: translateX(0);
            /* Visible */
        }
    </style>
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Room Adjustment</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Rooms</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Adjustment</a>
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
                    <div class="flex items-center mb-2">
                        <h6 class="text-15 grow">Reservations</h6>
                    </div>
                    <input type="hidden" name="roomid" id="roomid" value="{{ $room->id }}">
                    <span
                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">{{ $room->campus }}
                        [{{ $room->college_name }} - {{ $room->room_name }}]</span>
                    <span
                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                        {{ $room->exam_session }} [{{ $room->schedule }} - {{ $room->time }}]</span>

                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                 <th>CEE Term</th>
                                <th class="ltr:!text-left rtl:!text-right">App No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    <!-- add Structure -->
    <div id="adjustRoomModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Adjust Room Assignment</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="adjustForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">

                        <input type="hidden" id="adjust_res_id" name="reservation_id">

                        <!-- Last Name -->
                        <div>
                            <span
                                class="mb-2 px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">{{ $room->campus }}
                                [{{ $room->college_name }} - {{ $room->room_name }}]</span>
                            <span
                                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                {{ $room->exam_session }} [{{ $room->schedule }} - {{ $room->time }}]</span>
                        </div>

                        <!-- college name -->
                        <div>
                            <label for="ceeexamsession" class="block mb-2 text-base font-medium">Exam Batch</label>
                            <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                id="ceeexamsession" name="ceeexamsession">
                                <option value="">--Select--</option>
                                <option value="Batch 1">Batch 1 (08:00 AM - 10:00 AM)
                                </option>
                                <option value="Batch 2">Batch 2 (11:00 AM - 01:00 PM)
                                </option>
                                <option value="Batch 3">Batch 3 (02:00 PM - 04:00 PM)
                                </option>
                            </select>
                        </div>
                        <!-- college name -->
                        <div>
                            <label for="room" class="inline-block mb-2 text-base font-medium">New Room Assignment<sup
                                    class="text-red-500">* required</sup></label>
                            <select id="room-select" name="room"
                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                <option selected="true" disabled>Choose Room</option>
                            </select>
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


    {{-- start drawer --}}
    <div id="drawerterms" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-80 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h6 class="text-15">Terms & Conditions</h6>
            <button data-drawer-close="drawerterms"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <p class='text-justify'>
                    Welcome to the University of Southern Mindanao (USM) College Entrance Examination
                    Registration Website. By accessing and using this website, you agree to comply with and
                    be bound by these Terms and Conditions, which govern your use of this application. If
                    you do not agree, please refrain from using this site.
                </p>
                <br>
                <div
                    class="flex gap-1 px-3 py-3 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50 dark:bg-yellow-400/20 dark:border-yellow-500/50">
                    <h6 class="mb-1 font-bold">Eligibility and Accurate Information</h6>
                </div>

                <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
                    <li>Only eligible applicants, specifically senior high school students, may use this
                        website to register for the USM College Entrance Examination.
                    </li>
                    <li>All information provided must be complete, accurate, and truthful. By submitting
                        your application, you confirm that you meet the eligibility requirements.</li>
                    <li>Providing false information or misrepresenting your qualifications may lead to
                        disqualification from the application process and will be handled in accordance with
                        Republic Act No. 10175 (Cybercrime Prevention Act of 2012) and Article 172
                        (Falsification by Private Individual) and Article 315 (Swindling/Estafa) of the
                        Revised Penal Code of the Philippines.</li>

                </ul>


            </div>
        </div>
        <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
            <h6 class="text-15">University of Southern Mindanao</h6>
        </div>
    </div>
    {{-- end drawer --}}
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            table();

            function table() {
                // Get the page number from sessionStorage if available
                let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                    'currentPage')) : 0;


                if ($.fn.DataTable.isDataTable('#dbData')) {
                    $('#dbData').DataTable().destroy();
                }

                $('#dbData').DataTable({
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
                        url: "{{ route('admin.cee.room-adjustment.get-data') }}",
                        type: "GET",
                        dataType: "JSON",
                        data: function(d) {
                            d.roomid = $('#roomid').val(); // Pass the roomid
                        },
                        error: function(xhr, status, error) {
                            console.error("DataTable load error:", error); // Debugging line
                        }
                    },
                    columns: [ {
                            data: 'sessionId',
                            name: 'sessionId'
                        },{
                            data: "app_no",
                            name: "app_no"
                        },
                        {
                            data: 'fullname',
                            name: 'fullname'
                        },

                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                    order: [
                        [1, 'asc']
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
                        currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage
                            .getItem(
                                'currentPage')) : 0;
                        table.page(currentPage).draw(false);
                    } else {
                        let pageInfo = table.page.info();
                        sessionStorage.setItem('currentPage', pageInfo.page);
                    }
                });

            }
        });

        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.adjust-room', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/cee/room-adjust/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let reservationDetails = response.reservationDetails;

                    // fill the values
                    $('#adjust_res_id').val(reservationDetails.id);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            });
            $('#adjustRoomModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('adjustRoomModal');
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

        //update form
        $('#adjustForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();
            var reservationId = $('#adjust_res_id').val();

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/cee/room-adjust/' + reservationId,
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#adjustRoomModal').addClass('hidden');

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roomSelect = document.getElementById('room-select');
            const ceeSessionSelect = document.getElementById('ceeexamsession');
            let choicesInstance;

            // Define the loadRooms function to reset and fetch rooms
            function loadRooms() {
                const ceesession = ceeSessionSelect.value;

                // Clear any previous selection in room-select and reset it
                if (choicesInstance) {
                    console.log('Destroying existing Choices instance');
                    choicesInstance.destroy();
                    choicesInstance = null; // Clear reference to allow reinitialization
                }

                // Clear roomSelect options directly
                roomSelect.innerHTML = '<option value="" disabled selected>Choose Room</option>';
                roomSelect.value = ''; // Clear any selected value in the DOM

                // Reinitialize Choices.js with custom templates for styling
                choicesInstance = new Choices(roomSelect, {
                    searchEnabled: true,
                    // placeholderValue: 'Choose Room',
                    noResultsText: 'No rooms available',
                    callbackOnCreateTemplates: function(template) {
                        return {
                            item: (classNames, data) => {
                                // Customize the selected item rendering
                                return template(`
                            <div class="${classNames.item} ${
                            data.highlighted
                                ? classNames.highlightedState
                                : classNames.itemSelectable
                        }" data-item data-id="${data.id}" data-value="${data.value}" ${
                            data.active ? 'aria-selected="true"' : ''
                        }>
                                ${data.label}
                            </div>
                        `);
                            },
                            choice: (classNames, data) => {
                                // Customize the dropdown options rendering
                                return template(`
                            <div class="${classNames.item} ${
                            classNames.itemChoice
                        } ${data.disabled ? classNames.itemDisabled : ''}" data-select-text="${
                            this.config.itemSelectText
                        }" data-choice ${
                            data.disabled
                                ? 'data-choice-disabled aria-disabled="true"'
                                : 'data-choice-selectable'
                        } data-id="${data.id}" data-value="${data.value}" ${
                            data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                        }>
                                <span style="color: ${
                                  data.customProperties?.color || 'black'
                                };">${data.label}</span>
                            </div>
                        `);
                            },
                        };
                    },
                });

                // If a batch session is selected, fetch room data
                if (ceesession) {
                    fetch(`/admin/cee/rooms-by-session?ceesession=${ceesession}`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'
                                ),
                            },
                        })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            const roomOptions = data.map((room) => ({
                                value: room.id,
                                label: `${room.room_name} - ${room.college_name} - (Slots: ${room.capacity})`,
                                customProperties: {
                                    color: room.status === 'active' ? 'green' : 'red',
                                },
                            }));
                            // Populate the dropdown with fetched room data
                            choicesInstance.setChoices(roomOptions, 'value', 'label', true);
                        })
                        .catch((error) => console.error('Error fetching rooms:', error));
                }
            }

            // Attach the loadRooms function to the onchange event of ceeexamsession select
            ceeSessionSelect.addEventListener('change', loadRooms);
        });
    </script>
@endpush
