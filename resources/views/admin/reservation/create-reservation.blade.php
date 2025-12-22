@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Create Reservation
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/choices/choices.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM - College Entrance Examination System 4.0</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Create Reservation
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card">
                <div class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                    <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                    <div>
                        <h6 class="mb-1">Kindly read this note before proceeding to CEE Slot Reservation</h6>
                        <p><b>Note:</b> Please ensure that you provide accurate and correct information.
                            Double-check
                            all details before submitting, as you will not be able to edit them once saved. </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.reserve.store') }}" method="POST">
                        @csrf
                        <h6 class="mb-1 text-5">RESERVATION DETAILS</h6>
                        <hr class="mb-4" />

                        <div class="xl:col-span-6">
                            <input type="hidden" name="ceesession"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                value="{{ $ceeSession->id }}" @readonly(true)>
                        </div><!--end col-->

                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                            <div class="xl:col-span-3">
                                <label for="searchuser" class="inline-block mb-2 text-base font-medium">Seach User<sup
                                        class="text-red-500">* required</sup></label>
                                <select id="user-select" name="user" data-choices
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose user</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" data-fullname="{{ $user->fullname }}"
                                            data-userlrn="{{ $user->lrn }}" data-firstname="{{ $user->firstname }}"
                                            data-lastname="{{ $user->lastname }}" data-birthdate="{{ $user->birthdate }}">
                                            {{ $user->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="xl:col-span-9"></div>

                            <div class="xl:col-span-4">
                                <label for="fullname" class="inline-block mb-2 text-base font-medium">Fullname <sup
                                        class="text-blue-500">* read only</sup></label>
                                <input type="text" id="fullname" name="fullname"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter fullname " value="{{ old('fullname') }}" readonly>
                            </div>

                            <div class="xl:col-span-4">
                                <label for="lrn" class="inline-block mb-2 text-base font-medium">LRN <sup
                                        class="text-blue-500">* read only</sup></label>
                                <input type="text" id="lrn" name="lrn"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter lrn " value="{{ old('lrn') }}" readonly>
                            </div>

                            <div class="mb-4 xl:col-span-4">
                                <label for="is_repeat_exam" class="inline-block mb-2 text-base font-medium">CEE
                                    Retaker?<sup class="text-blue-500">* read only</sup></label>
                                <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-12">
                                <h6 class="text-blue-500 text-5">Priority Programs</h6>
                            </div>

                            <div class="xl:col-span-4">
                                <label for="campus" class="inline-block mb-2 text-base font-medium">Select
                                    Campus<sup class="text-red-500">* required</sup></label>
                                <select id="campus-select" name="campus" data-choices
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Campus</option>
                                    @foreach ($campusNames as $campusName)
                                        <option value="{{ $campusName->real_campus_id }} "
                                            data-termid="{{ $campusName->termid }}">{{ $campusName->campus_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="xl:col-span-8">
                                <label for="firstprioprog" class="inline-block mb-2 text-base font-medium">First
                                    Priority
                                    Program <sup class="text-red-500">* required</sup></label>
                                <select id="program-select" name="firstprioprog"
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Program</option>
                                </select>
                                <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                <input type="hidden" name="firstprogram_policy_id" id="firstprogram_policy_id">
                            </div>


                            <div class="xl:col-span-4">
                                <label for="campus2" class="inline-block mb-2 text-base font-medium">Select
                                    Campus<sup class="text-red-500">* required</sup></label>
                                <select id="campus-select2" name="campus2" data-choices
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Campus</option>
                                    @foreach ($campusNames as $campusName)
                                        <option value="{{ $campusName->real_campus_id }}"
                                            data-termid="{{ $campusName->termid }}">{{ $campusName->campus_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="xl:col-span-8">
                                <label for="secondprioprog" class="inline-block mb-2 text-base font-medium">Second
                                    Priority
                                    Program <sup class="text-red-500">* required</sup></label>
                                <select id="program-select2" name="secondprioprog"
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Program</option>
                                </select>
                                <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                <input type="hidden" name="secondprogram_policy_id" id="secondprogram_policy_id">
                            </div>


                            <div class="xl:col-span-4">
                                <label for="campus3" class="inline-block mb-2 text-base font-medium">Select
                                    Campus<sup class="text-red-500">* required</sup></label>
                                <select id="campus-select3" name="campus3" data-choices
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Campus</option>
                                    @foreach ($campusNames as $campusName)
                                        <option value="{{ $campusName->real_campus_id }}"
                                            data-termid="{{ $campusName->termid }}">{{ $campusName->campus_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- Modal overlay for loading spinner -->
                            <div id="loading-modal"
                                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-lg">
                                    <svg class="w-10 h-10 mb-4 animate-spin text-custom-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0a12 12 0 100 24v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                    <p class="font-medium text-gray-700">Loading programs, please wait...</p>
                                </div>
                            </div>


                            <div class="xl:col-span-8">
                                <label for="thirdprioprog" class="inline-block mb-2 text-base font-medium">Third
                                    Priority
                                    Program <sup class="text-red-500">* required</sup></label>
                                <select id="program-select3" name="thirdprioprog"
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Program</option>
                                </select>
                                <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                <input type="hidden" name="thirdprogram_policy_id" id="thirdprogram_policy_id">
                            </div>


                            <div class="xl:col-span-12">
                                <h6 class="mt-2 text-blue-500 text-5">Examination Details</h6>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="ceesession" class="inline-block mb-2 text-base font-medium">USMCEE
                                    Batch
                                    <sup class="text-red-500">* required</sup></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="ceeexamsession" name="ceeexamsession" data-choices>
                                    <option value="">-Select Examination Session
                                    </option>
                                    <option value="Batch 1">Batch 1 (6:00 AM - 9:00 AM)
                                    </option>
                                    <option value="Batch 2">Batch 2 (10:00 AM - 1:00 PM)
                                    </option>
                                    <option value="Batch 3">Batch 3 (1:30 PM - 4:30 PM)
                                    </option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="room" class="inline-block mb-2 text-base font-medium">Room
                                    Assignment<sup class="text-red-500">* required</sup></label>
                                <select id="room-select" name="room"
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected="true" disabled>Choose Room</option>
                                </select>
                            </div>

                            <div class="flex justify-end gap-2 xl:col-span-12">
                                <button type="button"
                                    class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                        data-lucide="x" class="inline-block size-4"></i> <span
                                        class="align-middle">Cancel</span></button>
                                <button type="submit"
                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Submit</button>
                            </div><!--end col-->
                        </div>
                    </form>

                </div>
            </div>

        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <!-- Include SweetAlert library -->
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('backend/assets/choices/choices.min.js') }}"></script>

    @if (session('message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "{{ session('status') === 'error' ? 'error' : 'success' }}",
                    title: "{{ session('status') === 'error' ? 'Error' : 'Success' }}",
                    text: "{{ session('message') }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <script>
        // Get the select elements and the modal
        const selects = ['campus-select', 'campus-select2', 'campus-select3'].map(id => document.getElementById(id));
        const loadingModal = document.getElementById('loading-modal');

        // Function to show the loading modal
        function showLoadingModal(selectElement) {
            loadingModal.classList.remove('hidden'); // Show the modal
            selectElement.disabled = true; // Disable the specific select element

            // Hide the modal and enable the select element after 10 seconds
            setTimeout(() => {
                loadingModal.classList.add('hidden');
                selectElement.disabled = false;
            }, 1000);
        }

        // Add event listeners for each select element
        selects.forEach(select => {
            select.addEventListener('change', function() {
                showLoadingModal(select);
            });
        });

        //fill fullname and LRN it will also check if the name exist in past cee dta
        document.addEventListener('DOMContentLoaded', function() {
            const appNoSelect = document.getElementById('user-select');
            const fullnameInput = document.getElementById('fullname');
            const userIdInput = document.getElementById('lrn');
            const isRepeatExamInput = document.getElementById('is_repeat_exam');

            appNoSelect.addEventListener('change', function() {
                const selectedOption = appNoSelect.options[appNoSelect.selectedIndex];
                const fullname = selectedOption.getAttribute('data-fullname') || '';
                const userId = selectedOption.getAttribute('data-userlrn') || '';
                const firstname = selectedOption.getAttribute('data-firstname');
                const lastname = selectedOption.getAttribute('data-lastname');
                const birthdate = selectedOption.getAttribute('data-birthdate');

                if (firstname && lastname && birthdate) {
                    const params = new URLSearchParams({
                        firstname: firstname,
                        lastname: lastname,
                        birthdate: birthdate,
                    }).toString();

                    fetch(`/admin/reservation/create-reservation/validate-type?${params}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.isRetaker) {
                                isRepeatExamInput.value = "Yes";
                            } else {
                                isRepeatExamInput.value = "No";
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    isRepeatExamInput.value = '';
                }

                fullnameInput.value = fullname;
                userIdInput.value = userId;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "I confirm that all data are correct and reviewed.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        this.submit();
                    }
                });
            });
        });

        // Initialize Choices on the room select element
        const choicesInstance = new Choices(ceeexamsession, {
            searchEnabled: true,
            placeholderValue: 'Choose Room',
            noResultsText: 'No rooms available',
        });

        document.addEventListener('DOMContentLoaded', function() {
            const campusSelect1 = document.getElementById('campus-select');
            const programSelect1 = document.getElementById('program-select');
            const firstPriorityDescInput = document.getElementById('firstprioprog_desc');
            const firstprogram_policy_id_Input = document.getElementById('firstprogram_policy_id');

            const campusSelect2 = document.getElementById('campus-select2');
            const programSelect2 = document.getElementById('program-select2');
            const secondPriorityDescInput = document.getElementById('secondprioprog_desc');
            const secondprogram_policy_id_Input = document.getElementById('secondprogram_policy_id');

            const campusSelect3 = document.getElementById('campus-select3');
            const programSelect3 = document.getElementById('program-select3');
            const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');
            const thirdprogram_policy_id_Input = document.getElementById('thirdprogram_policy_id');


            function loadPrograms(campusSelect, programSelect) {
                const realCampusId = campusSelect.value;
                const termId = campusSelect.selectedOptions[0].dataset.termid;

                // console.log("Selected termId:", termId);

                // // Set termId based on the selected campus
                // let termId;
                // switch (realCampusId) {
                //     case "1":
                //         termId = 101;
                //         break; // USM Main
                //     case "3":
                //         termId = 70;
                //         break; // USM KCC
                //     case "5":
                //         termId = 101;
                //         break; // PALMA
                //     case "6":
                //         termId = 101;
                //         break; // Mlang
                //     case "7":
                //         termId = 101;
                //         break; // antipas
                //     case "8":
                //         termId = 101;
                //         break; // Pigcwayan
                //     default:
                //         termId = null;
                //         break;
                // }

                if (!realCampusId || !termId) return; // Exit if missing values

                programSelect.innerHTML = '<option selected disabled>Please wait...</option>';

                fetch(`/admin/cee/get-programs-by-campus?termId=${termId}&realCampusId=${realCampusId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '<option selected disabled>Choose Program</option>';
                        data.forEach(program => {
                            const option = document.createElement('option');
                            option.value = program.id;
                            option.textContent = program.majorDiscDesc ?
                                `${program.programName} - ${program.majorDiscDesc}` : program
                                .programName;
                            option.setAttribute('data-program-name', program.programName);
                            option.setAttribute('data-program-policy_id', program.id);
                            programSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading programs:', error);
                        programSelect.innerHTML = '<option selected disabled>Error loading programs</option>';
                    });
            }

            campusSelect1.addEventListener('change', () => loadPrograms(campusSelect1, programSelect1));
            campusSelect2.addEventListener('change', () => loadPrograms(campusSelect2, programSelect2));
            campusSelect3.addEventListener('change', () => loadPrograms(campusSelect3, programSelect3));

            // Update priority description inputs when a program is selected
            programSelect1.addEventListener('change', () => {
                const selectedOption = programSelect1.options[programSelect1.selectedIndex];
                firstPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                firstprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
            });

            programSelect2.addEventListener('change', () => {
                const selectedOption = programSelect2.options[programSelect2.selectedIndex];
                secondPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                secondprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
            });

            programSelect3.addEventListener('change', () => {
                const selectedOption = programSelect3.options[programSelect3.selectedIndex];
                thirdPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                thirdprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
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
                    fetch(`/admin/cee/rooms-by-session/res?ceesession=${ceesession}`, {
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
