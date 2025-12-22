@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - List of Preregistered Students
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Pre-registered Student</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Student Applicants</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

        <div
            class=" bg-green-100 dark:bg-green-500/20 card 2xl:col-span-3 md:col-span-12 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
            <div class="card-body">


                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                    <i data-lucide="check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value"
                        data-target="{{ $counts['With Requirements'] ?? 0 }}"></span> </h5>
                <p class="text-green-500 dark:text-green-200">With Requirements <b>[Pending for Enrollment]</b></p>
            </div>
        </div>

        <div
            class=" bg-red-100 dark:bg-red-500/20 card 2xl:col-span-3 md:col-span-12 group-data-[skin=bordered]:border-red-500/20 relative overflow-hidden">
            <div class="card-body">
                <div class="flex items-center justify-center bg-red-500 rounded-md size-12 text-15 text-red-50">
                    <i data-lucide="x"></i>
                </div>
                <h5 class="mt-4 mb-2"><a href="{{ route('admin.prereg.no-requirements-applicants') }}" class="counter-value"
                        data-target="{{ $counts['No Requirements'] ?? 0 }}"></a></h5>
                <p class="text-red-500 dark:text-red-200">Without Requirements <b>[Pending for Enrollment]</b></p>
            </div>
        </div>

        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="uppercase text-15 grow">Records</h6>
                        <div class="flex items-center gap-2 space-x-4">
                            <a type="button" href="{{ route('admin.add-applicant-profile.index') }}"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Add Profile</span>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <div class="overflow-auto">
                        <table id="dataTable" class="min-w-full display stripe group" style="width:100%">
                            <thead>
                                <tr>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Action</th>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Type</th>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Prereg Status</th>

                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Profile Status</th>

                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Full Name</th>

                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        NSTP</th>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Program & Campus</th>

                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Requirements</th>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Create At</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div><!--end card-->

        </div><!--end col-->

    </div>


    <!-- add Modal Structure -->
    <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16" id="studentFullNameDisplay"></h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addForm">
                    @csrf
                    <input type="hidden" name="student_id" id="studentIdInput">
                    <input type="hidden" name="student_type" id="studentTypeInput">

                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <div class="space-y-4">
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Good Moral</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="goodmoral" id="goodmoral"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="goodmoral"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Form 138</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="card" id="card"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="card"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">PSA</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="psa" id="psa"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="psa"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Honorable Dismissal</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="hdismissal" id="hdismissal"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="hdismissal"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Certificate of Transfer</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="certificatetransfer" id="certificatetransfer"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="certificatetransfer"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Transcript of Records</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="transcript" id="transcript"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="transcript"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Save</button>
                    </div>
            </div>

            </form>
        </div>
    </div>


    {{-- editNstp --}}
    <div id="nstpModal" class="fixed inset-0 z-50 flex items-center justify-center hidden ">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="relative flex items-center justify-center p-4 bg-green-500 border-b dark:border-zinc-500">
                <h5 class="w-full text-center text-white uppercase text-16">National Service Training Program
                    (NSTP)</h5>
                <!-- X Button -->
                <button id="closeModalButton"
                    class="absolute text-xl font-bold text-white top-3 right-3 hover:text-gray-200 focus:outline-none">
                    &times;
                </button>
            </div>
            <div class="p-4 text-center">
                <div class="xl:col-span-12">
                    <div
                        class="px-4 py-3 text-sm text-green-500 border border-transparent rounded-md bg-green-50 dark:bg-green-400/20">
                        <div class="items-center">
                            <ul class="ml-2 list-disc list-inside">
                                <p>
                                    As part of this update, we kindly ask all confirmed enrollees to select
                                    their NSTP preference below.
                                </p>
                                <br>

                                <div class="mb-2 xl:col-span-6">
                                    <input type="hidden" id="nstp_id" name="nstpid">
                                    <select name="nstp" id="nstpSelect"
                                        class="w-full p-2 transition duration-200 ease-in-out border rounded-md border-custom-300 focus:ring-custom-500 focus:border-custom-500">
                                        <option value="1">Civic Welfare Training Service (CWTS)</option>
                                        <option value="2">Reserve Officers' Training Corps (ROTC)
                                        </option>
                                    </select>
                                </div>

                                <button id="saveNstpPref"
                                    class="block w-full text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    Update
                                </button>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/dataTables.2.2.2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.tailwindcss.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        lucide.createIcons();

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addModal');
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

        function attachDropdownHandlers() {
            document.querySelectorAll('button[data-bs-toggle="dropdown"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;

                    // Hide other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdown) menu.classList.add('hidden');
                    });

                    // Toggle this dropdown
                    dropdown.classList.toggle('hidden');
                });
            });

            // Hide dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dataTable = initializeDataTable();

            /**
             * Initialize DataTable with server-side processing and custom loader
             */
            function initializeDataTable() {
                return $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    responsive: true,
                    ajax: {
                        url: '{{ route('admin.prereg.pending.data') }}',
                        type: 'GET',
                        error: function(xhr, error, thrown) {
                            console.error('DataTables AJAX error:', error);
                            console.warn(xhr.responseText);
                        }
                    },
                    columns: [{
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'student_type',
                            name: 'student_type'
                        },
                        {
                            data: 'prereg_status',
                            name: 'prereg_status'
                        },
                        {
                            data: 'applicant_profile_status',
                            name: 'applicant_profile_status'
                        },
                        {
                            data: 'fullname',
                            name: 'fullname'
                        },
                        {
                            data: 'nstp',
                            name: 'nstp'
                        },
                        {
                            data: 'program',
                            name: 'program'
                        },
                        {
                            data: 'requirements',
                            name: 'requirements'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }
                    ],
                    order: [
                        [8, 'asc']
                    ],
                    drawCallback: function() {
                        // Re-render Lucide icons
                        if (window.lucide?.createIcons) {
                            lucide.createIcons();
                        }

                        // Rebind any custom dropdown or UI handlers
                        attachDropdownHandlers();
                    }
                });
            }


            $(document).on('click', '.delete-button', function() {

                const id = $(this).data('id');
                Swal.fire({
                    title: 'Please provide a reason for cancellation',
                    html: '<p style="margin-bottom: 10px; color: #888; font-size: 0.9rem;">Reminder: Please be specific. This field is required.</p>',
                    input: 'textarea',
                    inputPlaceholder: 'Type your reason here...',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    customClass: {
                        confirmButton: 'text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10 ltr:mr-1 rtl:ml-1',
                        cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20',
                    },
                    buttonsStyling: false,
                    showCloseButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        const textarea = Swal.getInput();
                        if (textarea) {
                            textarea.style.resize = 'none';
                        }
                    },
                    preConfirm: function(reason) {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                if (!reason || reason.trim() === '') {
                                    Swal.hideLoading();
                                    Swal.showValidationMessage(
                                        'Cancellation reason is required.');
                                    return;
                                }
                                resolve(reason);
                            }, 500);
                        });
                    },
                }).then(function(result) {
                    if (result.isConfirmed) {
                        const reason = result.value;
                        cancelConfirmation(id, reason);
                    }
                });
            });

            /**
             * Cancel data via AJAX
             */
            function cancelConfirmation(id, reason) {
                fetch(`{{ route('admin.prereg.pending.cancel', ['id' => '__ID__']) }}`.replace('__ID__', id), {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            reason: reason
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            showAlert(data.message, 'success');
                            reloadDataTable();
                        } else {
                            showAlert('An error occurred while cancelling the confirmation.', 'error');
                        }
                    })
                    .catch(error => {
                        showAlert('An error occurred. Please try again.', 'error');
                    });
            }

            $('body').on('click', '#openModalButton', function(event) {
                event.preventDefault();

                const studentId = $(this).data('student-id');
                const studentType = $(this).data('student-type');
                const fullname = $(this).data('fullname');

                // Inject into hidden fields
                $('#studentIdInput').val(studentId);
                $('#studentTypeInput').val(studentType);
                $('#studentFullNameDisplay').text(fullname); // Optional: display student name in modal


                $('#addModal').removeClass('hidden');


                const url = `{{ route('admin.prereg.pending.getRequirements', ['id' => '__ID__']) }}`
                    .replace('__ID__', studentId);

                // Reset all checkboxes before the fetch
                const fields = ['goodmoral', 'card', 'psa', 'hdismissal', 'certificatetransfer',
                    'transcript'
                ];
                fields.forEach(id => {
                    document.getElementById(id).checked = false;
                });

                fetch(url)
                    .then(response => {
                        if (!response.ok) return null;
                        return response.json();
                    })
                    .then(data => {
                        if (data) {
                            document.getElementById('goodmoral').checked = data.goodmoral == 1;
                            document.getElementById('card').checked = data.card == 1;
                            document.getElementById('psa').checked = data.psa == 1;
                            document.getElementById('hdismissal').checked = data.hdismissal == 1;
                            document.getElementById('certificatetransfer').checked = data
                                .certificatetransfer == 1;
                            document.getElementById('transcript').checked = data.transcript == 1;
                        }
                    });
            });

            document.getElementById('addForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const url = `{{ route('admin.prereg.pending.requirements.save') }}`;

                const data = {
                    student_id: document.getElementById('studentIdInput').value,
                    student_type: document.getElementById('studentTypeInput').value,
                    goodmoral: document.getElementById('goodmoral').checked,
                    card: document.getElementById('card').checked,
                    psa: document.getElementById('psa').checked,
                    hdismissal: document.getElementById('hdismissal').checked,
                    certificatetransfer: document.getElementById('certificatetransfer').checked,
                    transcript: document.getElementById('transcript').checked,
                };

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        // Optionally close modal or refresh data
                        document.getElementById('addModal').classList.add('hidden');
                        showAlert(res.message, 'success');
                        reloadDataTable();

                    });
            });



            // JavaScript for closing the modal
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('addModal');
                const closeModalButtons = modal.querySelectorAll('#closeModalButton');

                // Close Modal when clicking close buttons
                closeModalButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        modal.classList.add('hidden');
                    });
                });

                // Close when clicking outside the modal content
                modal.addEventListener('click', (event) => {
                    if (event.target === modal || event.target.classList.contains(
                            'bg-opacity-50')) {
                        modal.classList.add('hidden');
                    }
                });
            });

            function attachDropdownHandlers() {
                document.querySelectorAll('button[data-bs-toggle="dropdown"]').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const dropdown = this.nextElementSibling;

                        // Hide other dropdowns
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            if (menu !== dropdown) menu.classList.add('hidden');
                        });

                        // Toggle this dropdown
                        dropdown.classList.toggle('hidden');
                    });
                });

                // Hide dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.classList.add('hidden');
                        });
                    }
                });
            }



            function showAlert(message, type = 'info') {
                let title = '';
                switch (type) {
                    case 'success':
                        title = 'Success!';
                        break;
                    case 'error':
                        title = 'Error!';
                        break;
                    case 'warning':
                        title = 'Warning!';
                        break;
                    default:
                        title = 'Notice';
                        break;
                }

                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    customClass: {
                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                    },
                    buttonsStyling: false
                });
            }

            $('body').on('click', '.addnstpPreference', function(event) {
                event.preventDefault();

                let id = $(this).data('id');
                let editUrl = '/admin/pre-registration/student-profile/' + id + '/edit';

                $.ajax({
                    url: editUrl,
                    method: 'GET',
                    success: function(response) {
                        let nstpPref = response.nstpPref;

                        // fill the values
                        $('#nstp_id').val(nstpPref.id);
                        $('#nstpSelect').val(nstpPref.nstp);

                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            'An error occurred while processing your request.';
                        swal('Unable to Delete!', errorMessage, 'error');
                    }
                })

                $('#nstpModal').removeClass('hidden'); // Open modal
            });



            $('#saveNstpPref').on('click', function(e) {
                e.preventDefault();

                let id = $('#nstp_id').val();
                let nstp = $('#nstpSelect').val();

                if (!id) {
                    Swal.fire('Error', 'No student ID found.', 'error');
                    return;
                }

                $.ajax({
                    url: `/admin/pre-registration/student-profile/update/${id}`,
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr(
                            'content'), // Ensure CSRF token is included
                        nstp: nstp
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#nstpModal').addClass(
                                    'hidden'); // Hide modal after OK is clicked
                                // location.reload(); // Optional
                                reloadDataTable();
                            });
                        } else {
                            Swal.fire('Failed', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = xhr.responseJSON?.message || 'Something went wrong.';
                        Swal.fire('Error', message, 'error');
                    }
                });
            });


            /**
             * Reload the DataTable
             */
            function reloadDataTable() {
                dataTable.ajax.reload(null, false);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('nstpModal');
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
@endpush
