@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Result Management
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE Sessions </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">CEE Exam Session</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Result</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <!--start col-->
            <div class="xl:col-span-12">
                <!--start card-->
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h6 class="mb-4 text-15" style="text-transform: uppercase;">CEE Examinee for {{ $data->name }}
                        </h6>
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        </div>
                    </div>
                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <input type="hidden" name="ceesessionid" value="{{ $data->id }}">

                        <table id="dbData" class="display stripe group" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="ltr:!text-left rtl:!text-right">CEE Exam ID</th>
                                    <th>CEE App No</th>
                                    <th>Full Name</th>
                                    <th>Science</th>
                                    <th>Math</th>
                                    <th>Humanities</th>
                                    <th>Inductive Reasoning</th>
                                    <th>CSA</th>
                                    <th>Status</th>
                                    <th>RFC Status</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end grid-->
    @endsection
    @push('scripts')
        <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
        <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
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

                // Fetch the value of the ceesessionid input
                let ceeSessionId = $('input[name="ceesessionid"]').val();

                var table = $('#dbData').DataTable({
                    responsive: true,
                    columnDefs: [{
                            width: "10%",
                            targets: [0]
                        },
                        {
                            className: "text-start custom-middle-align",
                            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                    ],
                    language: {
                        processing: `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                    },
                    processing: true,
                    serverSide: true,
                    deferRender: true, // Improves performance by delaying rendering
                    ajax: {
                        url: "{{ route('admin.cee.exam-session.view-results') }}",
                        type: "GET",
                        dataType: "JSON",
                        // data: {
                        //     cee_session_id: ceeSessionId // Pass the session ID
                        // }
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
                            data: 'science',
                            name: 'science'
                        },
                        {
                            data: 'math',
                            name: 'math'
                        },
                        {
                            data: 'humanities',
                            name: 'humanities'
                        },
                        {
                            data: 'inductive',
                            name: 'inductive'
                        },
                        // {
                        //     data: 'abstract',
                        //     name: 'abstract'
                        // },
                        {
                            data: 'csa',
                            name: 'csa'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'ispending_edit',
                            name: 'ispending_edit'
                        },
                    ],
                    order: [
                        [0, "asc"]
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

            // Initialize modal open event using jQuery edit entry cee-result/{cee_result}/edit
            $('body').on('click', '.edit-entry', function(event) {
                event.preventDefault();

                let id = $(this).data('id');
                let editUrl = '/admin/cee-result/' + id + '/edit';

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
        </script>
    @endpush
