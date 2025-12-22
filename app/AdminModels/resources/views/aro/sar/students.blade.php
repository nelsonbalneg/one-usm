@extends('aro.layouts.master')
@section('title')
    USM-CEE | Students
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">{{ $programName }} </h5>
        </div>

        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Students</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">SAR</a>
            </li>
        </ul>
    </div>
    <!-- Error Message Section -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-4 mb-4">
        <div class="xl:col-span-12">
            @if (session('error'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error') }}
                </div>
            @endif
            @if (session('error_enroll'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error_enroll') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Enrollment Closed Announcement --}}
    @if (!$enrollmentRegStatus)
        <div class="mt-4 p-4 text-red-700 bg-red-100 border border-red-300 rounded-md">
            <strong>Enrollment is closed.</strong> Please contact the administrator for more information.
        </div>
    @else

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <!--start col-->
            <div class="xl:col-span-12">
                <!--start card-->
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h6 class="text-15 mb-4" style="text-transform: uppercase;">Records
                        </h6>
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        </div>
                    </div>
                    <div class="card-body border-y border-dashed border-slate-200 dark:border-zink-500">
                        <div class="overflow-x-auto">
                            <table id="dataTable" class="w-full whitespace-nowrap" style="width:100%">
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
                                            Student No</th>
                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Full Name</th>

                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Curriculum</th>
                                        {{-- <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Csa</th> --}}

                                        <th
                                            class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                            Date Registered</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div><!--end card-->

            </div><!--end col-->
        </div><!--end grid-->
    </div>

     @endif
    <!-- add Modal Structure -->
    <div id="addModal" class="fixed inset-0 flex items-center justify-center hidden z-50">
        <div class="bg-gray-900 bg-opacity-50 absolute inset-0"></div> <!-- Overlay -->
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get the full current URL
            const url = window.location.href;
            // Split the URL into segments by "/"
            const segments = url.split('/');
            // Get the last segment (the ID)
            const policyId = segments.pop() || segments.pop(); // handles trailing slash

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
                        url: '{{ route('aro.sar.students.data') }}',
                        type: 'GET',
                        data: function(d) {
                            d.id = policyId; // Attach policyId to the Ajax request
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                const route = "{{ route('aro.sar.assessment.process', ['id' => '__ID__']) }}"
                                .replace('__ID__', data) +
                                '?campusId=' + encodeURIComponent(row.campusId) +
                                '&policyId=' + encodeURIComponent(policyId);
                                return `
                                    <div class="relative dropdown">
                                        <button id="orderAction5${data}" data-bs-toggle="dropdown"
                                            class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20">
                                            <i data-lucide="more-horizontal" class="size-3"></i>
                                        </button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="orderAction5${data}">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="${route}">
                                                    <i data-lucide="send" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Assessment</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>`;
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'transactionType',
                            name: 'transactionType',
                            render: function(data, type, row) {
                                let badge = '';

                                if (data === 'Regular') {
                                    badge = `
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status">
                                        Regular
                                    </span>
                                `;
                                } else if (data === 'Irregular') {
                                    badge = `
                                    <span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status">
                                       Irregular
                                    </span>
                                `;
                                }

                                return badge;
                            }
                        },
                        {
                            data: 'studentNo',
                            name: 'studentNo'
                        },
                        {
                            data: 'studentName',
                            name: 'studentName'
                        },
                        {
                            data: 'curriculum',
                            name: 'curriculum'
                        },
                        {
                            data: 'dateCreated',
                            name: 'dateCreated',
                            render: function(data, type, row) {
                                if (!data) return '';

                                const date = new Date(data);
                                const options = {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: '2-digit',
                                    hour12: true
                                };
                                return date.toLocaleString('en-US', options);
                            }
                        }
                    ],
                    drawCallback: function() {
                        // Fix Lucide icon rendering
                        if (window.lucide && typeof lucide.createIcons === 'function') {
                            lucide.createIcons();
                        }

                        // Attach manual dropdown toggle handler
                        attachDropdownHandlers();
                    }
                });
            }

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


            /**
             * Reload the DataTable
             */
            function reloadDataTable() {
                dataTable.ajax.reload(null, false);
            }
        });
    </script>
@endpush
