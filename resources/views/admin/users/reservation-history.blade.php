@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Reservation History
@endsection

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
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Users</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Reservation History
            </li>
        </ul>
    </div>

    <!--start grid id="openModalButton"-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">RESERVATION HISTORY</h6>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Examinee Details</th>
                                <th>Schedule</th>
                                <th>SecondTaker?</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Booklet No</th>
                                <th>Action</th>
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

            // Get default selected session
            let user_id = $('#user_id').val();

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
                        targets: [0, 1, 2, 3, 4, 5]
                    },
                ],
                language: {
                  processing: `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.user.reservation-history.data') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.user_id = $('#user_id').val()
                    }
                },
                columns: [{
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'college_name',
                        name: 'college_name'
                    },
                    {
                        data: 'is_repeat_exam',
                        name: 'is_repeat_exam'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            // Check if data is valid to avoid errors
                            if (!data) return '';

                            // Parse the date and set the timezone to Asia/Manila
                            const date = new Date(data);
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                timeZone: 'Asia/Manila'
                            };

                            // Format date according to Asia/Manila timezone
                            return new Intl.DateTimeFormat('en-US', options).format(date);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'bookletNo',
                        name: 'bookletNo'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [4, "desc"]
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
                    currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                        'currentPage')) : 0;
                    table.page(currentPage).draw(false);
                } else {
                    let pageInfo = table.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                }
            });

            // Reload table when session is changed
            $('#cee-term-select').change(function() {
                table.ajax.reload(); // Refresh table based on new session ID
            });
        }
    </script>
@endpush
