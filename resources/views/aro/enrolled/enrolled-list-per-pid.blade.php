@extends('aro.layouts.master')
@section('title')
    USM-AES | Pre-registration - Enrolled Applicants
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
    <style>
        #viewProfilePhotodrawer {
            transform: translateX(100%);
            /* Hidden */
            transition: transform 0.3s ease-in-out;
        }

        #viewProfilePhotodrawer.show {
            transform: translateX(0);
            /* Visible */
        }
    </style>
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">ENROLLED APPLICANTS <span class="text-custom-500">1ST SEMESTER SY 2025-2026</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Enrolled</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                List
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
                        <h6 class="uppercase text-15 grow">ENROLLED APPLICANTS FOR <span class="text-custom-500">
                                {{ $programName->programName }}{{ $programName->majorDiscDesc ? ' - ' . $programName->majorDiscDesc : '' }}</span>
                        </h6>
                    </div>
                    <input type="hidden" id="policy_id_input" value="{{ $policyId }}">
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">#</th>
                                <th class="ltr:!text-left rtl:!text-right">PID</th>
                                <th class="ltr:!text-left rtl:!text-right">ID No</th>
                                <th class="ltr:!text-left rtl:!text-right">Full Name</th>
                                <th class="ltr:!text-left rtl:!text-right">Phone No</th>
                                <th>Date Enrolled</th>
                                <th class="ltr:!text-left rtl:!text-right">School ID Created?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    {{-- add user start drawer --}}
    <div id="viewProfilePhotodrawer" drawer-end
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h5 class="uppercase text-16">STUDENT PROFILE INFORMATION</h5>

            <button data-drawer-close="viewProfilePhotodrawer"><i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>

        </div>
        <div class="h-full p-2 overflow-y-auto">
            <div class="card-body">
                <div class="p-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center gap-3 mb-5">
                        </div>

                        <div class="relative overflow-hidden rounded-md group/gallery">
                            <div class="overflow-hidden">
                                <img src="" id="profilepic" alt=""
                                    class="transition-all duration-300 ease-linear group-hover/gallery:scale-110">
                            </div>

                            <h6 class="mt-4 mb-4 uppercase text-15 text-custom-500">Personal Information</h6>
                            <div class="overflow-x-auto">
                                <table class="w-full ltr:text-left rtl:ext-right">
                                    <tbody>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">ID Number</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200"
                                                id="student_id_no"></td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Full name</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200" id="fullname">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Phone No</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200" id="phone_no">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Birth of Date</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200" id="birth_date">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Emergency Contact Person</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200"
                                                id="emergency_contact"></td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Address</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200" id="emergency_address"></td>
                                        </tr>
                                        <tr>
                                            <th class="pt-2 font-semibold ps-0" scope="row">Contact #</th>
                                            <td class="pt-2 text-right text-slate-500 dark:text-zink-200" id="emergency_mobileno"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="mt-4">
                    <button id="view-photo-btn" type="button"
                        class="w-full text-white bg-custom-500 btn hover:bg-custom-600">
                        View Photo
                    </button>
                </div>
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
    <script src="{{ asset('backend/assets/toastify/toastify-js.js') }}"></script>

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
                    url: "{{ route('aro.prereg.enrolled-applicants.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.policy_id = $('#policy_id_input')
                            .val(); // assuming there's an <input> or <select> with this ID
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        title: "#",
                        width: "30px"
                    },
                    {
                        data: "policyId",
                        name: "policyId",
                        width: "30px"
                    },
                    {
                        data: "student_no",
                        name: "student_no",
                    },
                    {
                        data: "fullname",
                        name: "fullname",
                        render: function(data, type, row) {
                            // Convert fullname to uppercase
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: "mobile_no",
                        name: "mobile_no"
                    },

                    {
                        data: "date_enrolled",
                        name: "date_enrolled",
                        render: function(data, type, row) {
                            // Skip formatting if data is null or undefined
                            if (!data) return data;

                            // Create a Date object from the date string
                            const date = new Date(data);

                            // Check if date is valid
                            if (isNaN(date.getTime())) return data;

                            // Format the date as "Month Day, Year Hour:Minute AM/PM"
                            return date.toLocaleString('en-US', {
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            });
                        }
                    },
                    {
                        data: "is_school_id_created",
                        name: "is_school_id_created"
                    },

                    {
                        data: "action",
                        name: "action"
                    },
                ],
                order: [
                    [2, "asc"]
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
    </script>

    {{-- edit user script --}}
    <script>
        let photoUrl = '';
        let fileName = '';
        let selectedStudentId = null; // 👈 store the selected student's ID

        document.addEventListener('DOMContentLoaded', () => {
            const drawer = document.getElementById('viewProfilePhotodrawer'); // Drawer element

            // Listen for clicks on elements with class .view-photo
            document.addEventListener('click', event => {
                const editButton = event.target.closest('.view-photo'); // Match button with .view-photo
                if (editButton) {
                    event.preventDefault();

                    const id = editButton.getAttribute('data-id');
                    if (!id) {
                        console.error('User ID is missing!');
                        return;
                    }

                    selectedStudentId = id; // ✅ Save selected ID globally

                    const editUrl = `/aro/pre-registration/enrolled-applicants/${id}/view-profile-photo`;

                    // Fetch student profile data
                    $.ajax({
                        url: editUrl,
                        method: 'GET',
                        success: function(response) {
                            if (response.data) {
                                let data = response.data;

                                let fullName =
                                    `${data.first_name} ${data.middle_initial ?? ''} ${data.last_name}`;
                                if (data.ext_name) {
                                    fullName += ` ${data.ext_name}`;
                                }

                                // Build photo URL and file name
                                const filename =
                                    `${data.student_no}_${data.last_name}_${data.first_name}.jpg`;
                                const profilePhotoFile = data.photo ? data.photo.split('/')
                                    .pop() : 'default.png';

                                photoUrl = `http://172.16.0.43/uploads/${profilePhotoFile}`;
                                fileName = filename;

                                $('#profilepic').attr('src', photoUrl);
                                $('#fullname').text(fullName);
                                $('#student_id_no').text(data.student_no);
                                $('#phone_no').text(data.mobile_no);
                                $('#birth_date').text(data.date_of_birth);
                                $('#emergency_contact').text(data.emergency_contact);
                                $('#emergency_address').text(data.emergency_address);
                                $('#emergency_mobileno').text(data.emergency_mobileno);

                                // Show the drawer
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

            // Download photo when button is clicked
            document.getElementById('view-photo-btn').addEventListener('click', function() {
                if (!photoUrl || photoUrl.trim() === '') {
                    alert('No photo available.');
                    return;
                }

                window.open(photoUrl, '_blank');
            });
            // Handle drawer close
            const closeButton = document.querySelector('[data-drawer-close="viewProfilePhotodrawer"]');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    if (drawer) {
                        drawer.classList.remove('show');
                        drawer.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    {{-- update if school id is created for incoming freshmen --}}
    <script>
        $('body').on('change', '.change-type', function() {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('aro.update.school-id.status') }}",
                method: 'POST', // ← make sure this is POST
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: isChecked ? 1 : 0,
                    id: id
                },
                success: function(data) {
                    Toastify({
                        text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                            (data.message || "Status has been updated"),
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                        className: "success",
                        escapeMarkup: false
                    }).showToast();
                },
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON?.message || "Something went wrong";
                    Toastify({
                        text: '<i class="fas fa-times-circle" style="margin-right: 8px;"></i>' +
                            errorMessage,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f56565",
                        className: "error",
                        escapeMarkup: false
                    }).showToast();
                }
            });
        });
    </script>
@endpush
