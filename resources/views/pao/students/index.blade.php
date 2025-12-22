@extends('pao.layouts.master')
@section('title')
    USM-CEE | Students
@endsection

@push('styles')
@endpush

@section('contents')

    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Students </h5>
        </div>

        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Students</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pending</a>
            </li>
        </ul>
    </div>
    <!-- Error Message Section -->
    <div class="grid grid-cols-1 gap-4 mb-4 xl:grid-cols-12">
        <div class="xl:col-span-12">
            @if(session('error'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error') }}
                </div>
            @endif
            @if(session('error_enroll'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error_enroll') }}
                </div>
            @endif
        </div>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <!--start col-->
            <div class="xl:col-span-12">
                <!--start card-->
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h6 class="mb-4 text-15" style="text-transform: uppercase;">Records
                        </h6>
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        </div>
                    </div>
                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div class="overflow-x-auto">
                            <table id="dataTable"  class="w-full whitespace-nowrap" style="width:100%">
                                <thead class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                    <tr>
                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Action</th>

                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Status</th>


                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Type</th>
                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Full Name</th>
                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Gender</th>
                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Program</th>
                                        {{-- <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Csa</th> --}}

                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Requirements</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div><!--end card-->

            </div><!--end col-->
        </div><!--end grid-->
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

@endsection
@push('scripts')


    <script src="{{ asset('backend/assets/js/dataTables.2.2.2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.tailwindcss.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        lucide.createIcons();

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function () {
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
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const dataTable = initializeDataTable();

            /**
             * Initialize DataTable with server-side processing
             */

            function initializeDataTable() {
                return $('#dataTable').DataTable({
                    serverSide: true,
                    processing: true,
                    stateSave: true,
                    ajax: {
                        url: '{{ route('pao.student.confirmed.data') }}',
                        type: 'GET'
                    },
                    columns: [

                        { data: 'actions', name: 'actions', orderable: false, searchable: false },
                        { data: 'status_id', name: 'status_id', orderable: false, searchable: false },
                        { data: 'student_type', name: 'student_type' },
                        { data: 'fullname', name: 'fullname' },
                        { data: 'gender', name: 'gender' },
                        { data: 'program', name: 'program' },
                        // { data: 'csa', name: 'csa' },
                        { data: 'requirements', name: 'requirements' },

                    ],
                    drawCallback: function () {
                        // Fix Lucide icon rendering
                        if (window.lucide && typeof lucide.createIcons === 'function') {
                            lucide.createIcons();
                        }

                        // Attach manual dropdown toggle handler
                        attachDropdownHandlers();
                    }
                });
            }

            $(document).on('click', '.delete-button', function () {

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
                    preConfirm: function (reason) {
                        return new Promise(function (resolve) {
                            setTimeout(function () {
                                if (!reason || reason.trim() === '') {
                                    Swal.hideLoading();
                                    Swal.showValidationMessage('Cancellation reason is required.');
                                    return;
                                }
                                resolve(reason);
                            }, 500);
                        });
                    },
                }).then(function (result) {
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
                fetch(`{{ route('pao.student.cancel-confirmation.update', ['id' => '__ID__']) }}`.replace('__ID__', id), {
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
                            showAlert(data.message, 'warning');
                            reloadDataTable();
                        } else {
                            showAlert('An error occurred while cancelling the confirmation.', 'error');
                        }
                    })
                    .catch(error => {
                        showAlert('An error occurred. Please try again.', 'error');
                    });
            }

            $('body').on('click', '#openModalButton', function (event) {
                event.preventDefault();

                const studentId = $(this).data('student-id');
                const studentType = $(this).data('student-type');
                const fullname = $(this).data('fullname');

                // Inject into hidden fields
                $('#studentIdInput').val(studentId);
                $('#studentTypeInput').val(studentType);
                $('#studentFullNameDisplay').text(fullname); // Optional: display student name in modal


                $('#addModal').removeClass('hidden');


                const url = `{{ route('pao.students.requirements.getRequirements', ['id' => '__ID__']) }}`.replace('__ID__', studentId);

                // Reset all checkboxes before the fetch
                const fields = ['goodmoral', 'card', 'psa', 'hdismissal', 'certificatetransfer', 'transcript'];
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
                            document.getElementById('certificatetransfer').checked = data.certificatetransfer == 1;
                            document.getElementById('transcript').checked = data.transcript == 1;
                        }
                    });
            });

            document.getElementById('addForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const url = `{{ route('pao.students.requirements.save') }}`;

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
            document.addEventListener('DOMContentLoaded', function () {
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
                    button.addEventListener('click', function (e) {
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
                document.addEventListener('click', function (e) {
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


            /**
             * Reload the DataTable
             */
            function reloadDataTable() {
                dataTable.ajax.reload(null, false);
            }
        });
    </script>

@endpush
