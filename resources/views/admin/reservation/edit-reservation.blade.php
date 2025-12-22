@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Edit Reservation
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
                        <h6 class="mb-1">Kindly read this note before updating the Priority Programs</h6>
                        <p><b>Note:</b> Please ensure that you provide accurate and correct information.
                            Double-check all details before submitting.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.reservation.update-reservation.update', ['id' => $reservation->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <h6 class="mb-3 text-5">RESERVATION DETAILS OF {{ strtoupper($reservation->fullname) }}<br> <span
                                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                                {{ $reservation->app_no }}</span>
                            <span
                                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                                {{ $reservation->cee_term_name }}</span>
                            <span
                                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                                {{ \Carbon\Carbon::parse($reservation->schedule)->format('F j, Y') }}
                            </span>

                        </h6>
                        <hr class="mb-4" />

                        <div class="xl:col-span-6">
                            <input type="hidden" name="reservation_id" id="reservationid"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                value="{{ $reservation->id }}">

                        </div><!--end col-->

                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                            <div class="xl:col-span-12">
                                <h6 class="text-blue-500 uppercase text-5">Priority Programs</h6>
                            </div>

                            <div class="xl:col-span-4">
                                <label for="campus" class="inline-block mb-2 text-base font-medium">Select
                                    Campus<sup class="text-red-500">* required</sup></label>
                                <select id="campus-select" name="campus" data-choices
                                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                    <option selected disabled>Choose Campus</option>
                                    @foreach ($campusNames as $campus)
                                        <option value="{{ $campus->real_campus_id }}" data-termid="{{ $campus->termid }}"
                                            @selected($reservation->campus_id == $campus->real_campus_id)>
                                            {{ $campus->campus_name }}
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

                                    @foreach ($campusNames as $campus)
                                        <option value="{{ $campus->real_campus_id }}" data-termid="{{ $campus->termid }}"
                                            @selected($reservation->campus_id == $campus->real_campus_id)>
                                            {{ $campus->campus_name }}
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

                                    @foreach ($campusNames as $campus)
                                        <option value="{{ $campus->real_campus_id }}" data-termid="{{ $campus->termid }}"
                                            @selected($reservation->campus_id == $campus->real_campus_id)>
                                            {{ $campus->campus_name }}
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

                            <div class="flex justify-end gap-2 xl:col-span-12">
                                <button type="button"
                                    class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                        data-lucide="x" class="inline-block size-4"></i> <span
                                        class="align-middle">Cancel</span></button>
                                <button type="submit"
                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Save
                                    Changes</button>
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
            }, 3000);
        }

        // Add event listeners for each select element
        selects.forEach(select => {
            select.addEventListener('change', function() {
                showLoadingModal(select);
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

        // document.addEventListener('DOMContentLoaded', function() {
        //     const campusSelect1 = document.getElementById('campus-select');
        //     const programSelect1 = document.getElementById('program-select');
        //     const selectedProgramId = @json($reservation->firstpriorty ?? null);
        //     const firstPriorityDescInput = document.getElementById('firstprioprog_desc');
        //     const firstprogram_policy_id_Input = document.getElementById('firstprogram_policy_id');

        //     const campusSelect2 = document.getElementById('campus-select2');
        //     const programSelect2 = document.getElementById('program-select2');
        //     const secondPriorityDescInput = document.getElementById('secondprioprog_desc');
        //     const selectedProgramId2 = @json($reservation->secondpriorty ?? null);
        //     const secondprogram_policy_id_Input = document.getElementById('secondprogram_policy_id');

        //     const campusSelect3 = document.getElementById('campus-select3');
        //     const programSelect3 = document.getElementById('program-select3');
        //     const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');
        //     const selectedProgramId3 = @json($reservation->thirdpriorty ?? null);
        //     const thirdprogram_policy_id_Input = document.getElementById('thirdprogram_policy_id');


        //     // Function to update the hidden input when a program is selected
        //     function updateProgramDesc(programSelect, descInput) {
        //         const selectedOption = programSelect.options[programSelect.selectedIndex];
        //         if (selectedOption) {
        //             const programName = selectedOption.getAttribute('data-program-name');
        //             descInput.value = programName || ''; // Update the hidden input
        //         }
        //     }

        //     function loadPrograms(campusSelect, programSelect, selectedProgramId, descInput) {
        //         const realCampusId = campusSelect.value;
        //         const termId = campusSelect.selectedOptions[0].dataset.termid;

        //         if (!realCampusId || !termId) return; // Exit if missing values

        //         programSelect.innerHTML = '<option selected disabled>Please wait...</option>';

        //         fetch(`/admin/cee/get-programs-by-campus?termId=${termId}&realCampusId=${realCampusId}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 programSelect.innerHTML = '<option selected disabled>Choose Program</option>';
        //                 data.forEach(program => {
        //                     const option = document.createElement('option');
        //                     option.value = program.programId;
        //                     option.textContent = program.majorDiscDesc ?
        //                         `${program.programName} - ${program.majorDiscDesc}` : program
        //                         .programName;
        //                     option.setAttribute('data-program-name', program.programName);
        //                     option.setAttribute('data-program-policy_id', program.id);

        //                     // Pre-select the option if it matches the saved value
        //                     if (program.programId == selectedProgramId) {
        //                         option.selected = true;
        //                     }
        //                     programSelect.appendChild(option);
        //                 });
        //                 // Trigger hidden input update if pre-selected
        //                 updateProgramDesc(programSelect, descInput);
        //             })
        //             .catch(error => {
        //                 console.error('Error loading programs:', error);
        //                 programSelect.innerHTML = '<option selected disabled>Error loading programs</option>';
        //             });
        //     }

        //     campusSelect1.addEventListener('change', () => loadPrograms(campusSelect1, programSelect1,
        //         selectedProgramId, firstPriorityDescInput));

        //     // Trigger initial load if campus is pre-selected
        //     if (campusSelect1.value) {
        //         loadPrograms(campusSelect1, programSelect1, selectedProgramId, firstPriorityDescInput);
        //     }


        //     campusSelect2.addEventListener('change', () => loadPrograms(campusSelect2, programSelect2,
        //         selectedProgramId2, secondPriorityDescInput));

        //     // Trigger initial load if campus is pre-selected
        //     if (campusSelect2.value) {
        //         loadPrograms(campusSelect2, programSelect2, selectedProgramId2, secondPriorityDescInput);
        //     }

        //     campusSelect3.addEventListener('change', () => loadPrograms(campusSelect3, programSelect3,
        //         selectedProgramId3, thirdPriorityDescInput));

        //     // Trigger initial load if campus is pre-selected
        //     if (campusSelect3.value) {
        //         loadPrograms(campusSelect3, programSelect3, selectedProgramId3, thirdPriorityDescInput);
        //     }



        //     // Update priority description inputs when a program is selected
        //     programSelect1.addEventListener('change', () => {
        //         const selectedOption = programSelect1.options[programSelect1.selectedIndex];
        //         firstPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
        //         firstprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
        //     });

        //     programSelect2.addEventListener('change', () => {
        //         const selectedOption = programSelect2.options[programSelect2.selectedIndex];
        //         secondPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
        //         secondprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
        //     });

        //     programSelect3.addEventListener('change', () => {
        //         const selectedOption = programSelect3.options[programSelect3.selectedIndex];
        //         thirdPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
        //         thirdprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function() {

            const prioritySets = [{
                    campusSelect: document.getElementById('campus-select'),
                    programSelect: document.getElementById('program-select'),
                    hiddenDesc: document.getElementById('firstprioprog_desc'),
                    hiddenId: document.getElementById('firstprogram_policy_id'),
                    selectedProgramId: @json($reservation->firstpriorty ?? null)
                },
                {
                    campusSelect: document.getElementById('campus-select2'),
                    programSelect: document.getElementById('program-select2'),
                    hiddenDesc: document.getElementById('secondprioprog_desc'),
                    hiddenId: document.getElementById('secondprogram_policy_id'),
                    selectedProgramId: @json($reservation->secondpriorty ?? null)
                },
                {
                    campusSelect: document.getElementById('campus-select3'),
                    programSelect: document.getElementById('program-select3'),
                    hiddenDesc: document.getElementById('thirdprioprog_desc'),
                    hiddenId: document.getElementById('thirdprogram_policy_id'),
                    selectedProgramId: @json($reservation->thirdpriorty ?? null)
                }
            ];

            function loadPrograms(campusSelect, programSelect, selectedProgramId, descInput, hiddenInput) {
                const realCampusId = campusSelect.value;
                const termId = campusSelect.selectedOptions[0]?.dataset.termid;

                if (!realCampusId || !termId) return;

                programSelect.innerHTML = '<option selected disabled>Please wait...</option>';

                fetch(`/admin/cee/get-programs-by-campus?termId=${termId}&realCampusId=${realCampusId}`)
                    .then(res => res.json())
                    .then(data => {
                        programSelect.innerHTML = '<option selected disabled>Choose Program</option>';

                        data.forEach(program => {
                            const option = document.createElement('option');
                            option.value = program.id; // make sure this matches reservation IDs
                            option.textContent = program.majorDiscDesc ?
                                `${program.programName} - ${program.majorDiscDesc}` :
                                program.programName;
                            option.dataset.programName = program.programName;
                            option.dataset.programPolicyId = program.id;

                            // Pre-select if matches saved reservation
                            if (selectedProgramId && program.id == selectedProgramId) {
                                option.selected = true;
                            }

                            programSelect.appendChild(option);
                        });

                        // Update hidden inputs if pre-selected
                        const selectedOption = programSelect.selectedOptions[0];
                        if (selectedOption) {
                            descInput.value = selectedOption.dataset.programName;
                            hiddenInput.value = selectedOption.dataset.programPolicyId;
                        }
                    })
                    .catch(err => {
                        console.error('Error loading programs:', err);
                        programSelect.innerHTML = '<option selected disabled>Error loading programs</option>';
                    });
            }

            prioritySets.forEach(set => {
                // Load programs initially if campus already selected
                if (set.campusSelect.value) {
                    loadPrograms(set.campusSelect, set.programSelect, set.selectedProgramId, set.hiddenDesc,
                        set.hiddenId);
                }

                // Reload programs on campus change
                set.campusSelect.addEventListener('change', () => {
                    loadPrograms(set.campusSelect, set.programSelect, set.selectedProgramId, set
                        .hiddenDesc, set.hiddenId);
                });

                // Update hidden inputs when program is changed manually
                set.programSelect.addEventListener('change', () => {
                    const selectedOption = set.programSelect.selectedOptions[0];
                    if (selectedOption) {
                        set.hiddenDesc.value = selectedOption.dataset.programName;
                        set.hiddenId.value = selectedOption.dataset.programPolicyId;
                    }
                });
            });
        });
    </script>
@endpush
