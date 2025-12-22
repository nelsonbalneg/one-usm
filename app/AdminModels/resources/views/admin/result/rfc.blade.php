@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Request for Change Management
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE Request for Change - CEE Score </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Result</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">RFC</a>
            </li>
        </ul>
    </div>


    <div class="xl:col-span-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <h6 class="text-15">Records</h6>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">CEE Exam ID</th>
                                <th>CEE App No</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>RFC Status</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

    <!-- edit Modal Structure -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Request for Change Details</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="editForm">
                    @csrf
                    @method('PUT')

                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <input type="hidden" name="resultId" id="resultId">

                        <div class="xl:col-span-12">
                            <label for="app_no" class="inline-block mb-2 text-base font-medium">App Number</label>
                            <input type="text" id="app_no"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score " value="{{ old('app_no') }}" disabled>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="fullname" class="inline-block mb-2 text-base font-medium">Fullname</label>
                            <input type="text" id="fullname"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score " value="{{ old('fullname') }}" disabled>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="science" class="inline-block mb-2 text-base font-medium">Science</label>
                            <input type="text" id="science" name="science"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score " value="{{ old('science') }}" onblur="validateScores()" readonly>
                        </div>

                        <div class="xl:col-span-12">
                            <label for="math" class="inline-block mb-2 text-base font-medium">Math</label>
                            <input type="text" id="math" name="math"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score" value="{{ old('math') }}" readonly>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="humanities" class="inline-block mb-2 text-base font-medium">Humanities</label>
                            <input type="text" id="humanities" name="humanities"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score" value="{{ old('humanities') }}" readonly>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="inductive" class="inline-block mb-2 text-base font-medium">Inductive
                                Reasoning</label>
                            <input type="text" id="inductive" name="inductive"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score" value="{{ old('inductive') }}" readonly>
                        </div>

                        {{-- <div class="xl:col-span-12">
                            <label for="abstract" class="inline-block mb-2 text-base font-medium">Abstract
                                Reasoning</label>
                            <input type="text" name="abstract" id="abstract"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score" required readonly>
                        </div> --}}

                        <div class="xl:col-span-12">
                            <label for="csa" class="inline-block mb-2 text-base font-medium">Composite Scholastic
                                Ability</label>
                            <input type="text" name="csa" id="csa"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Score" required readonly>
                        </div>

                        <div class="xl:col-span-12">
                            <label for="remarks" class="inline-block mb-2 text-base font-medium">Remarks or
                                Comments</label>
                            <textarea
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                id="remarks" name="remarks" placeholder="Enter Remarks" rows="5" readonly></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                            Close</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    <!-- end edit Modal Structure -->
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

      <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>

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
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    },
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.cee.rfc.fetch-data') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: "cee_session_id",
                        name: "cee_session_id"
                    },
                    {
                        data: "app_no",
                        name: "app_no"
                    },
                    {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'ispending_edit',
                        name: 'ispending_edit'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data); // Parse the date
                            const options = {
                                timeZone: 'Asia/Manila',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            };
                            return date.toLocaleString('en-US', options);
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [5, "desc"]
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

        //view-details
        // Initialize modal open event using jQuery edit entry cee-result/{cee_result}/edit
        $('body').on('click', '.view-details', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/cee/result/rfc/' + id + '/view';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let result = response.ceeresult;

                    // fill the values
                    $('#resultId').val(result.id);
                    $('#science').val(result.science);
                    $('#math').val(result.math);
                    $('#humanities').val(result.humanities);
                    $('#inductive').val(result.inductive);
                    // $('#abstract').val(result.abstract);
                    $('#csa').val(result.csa);
                    $('#app_no').val(result.app_no);
                    $('#fullname').val(result.fullname);
                    $('#remarks').val(result.remarks);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            })



            $('#editModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('editModal');
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

        $('body').on('click', '.approve-rfc', function(event) {
            event.preventDefault();

            let unposturl = $(this).attr('href');
            let resultId = unposturl.split('/').pop();

            Swal.fire({
                title: 'Enter your password to unpost the result',
                input: 'password',
                inputPlaceholder: 'Type your password',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                preConfirm: (password) => {
                    console.log("Password entered:", password);
                    if (!password) {
                        Swal.showValidationMessage('Password is required');
                    }
                    return password;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const password = result.value;

                    // AJAX call to verify password and update status
                    $.ajax({
                        url: unposturl, // Backend route to verify and update
                        type: 'POST',
                        data: {
                            password: password,
                            result_id: resultId,
                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // Include CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Success', response.message, 'success');
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }

                            // Reload or redraw the table (if using DataTables)
                            if ($.fn.DataTable.isDataTable('#dbData')) {
                                $('#dbData').DataTable().ajax.reload(null,
                                    false); // false = retain pagination
                            } else {
                                location
                                    .reload(); // Fallback to full page reload if not using DataTables
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Something went wrong', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
