@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Reservation History
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">History</a>
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
                        <h6 class="text-15 grow">Reservation History of {{ $user->lastname }}</h6>
                        <input type="hidden" name="userid" id="userid" value="{{ $user->id }}">
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">#</th>
                                <th>App No.</th>
                                <th>Schedule</th>
                                <th>CEE Term</th>
                                <th>Priority Programs</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>CSA</th>
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
                        targets: [0, 1, 2, 3, 4, 5, 6,7,8]
                    },
                ],
                language: {
                     "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.reservation.history-details') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.userid = parseInt($('#userid').val(), 10);
                        console.log(d.userid); // Log the value to ensure it's correct
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    },
                    {
                        data: 'app_no',
                        name: 'app_no'
                    },
                    {
                        data: 'college_name',
                        name: 'college_name'
                    },
                    {
                        data: 'ceesesionname',
                        name: 'ceesesionname'
                    },
                    {
                        data: 'priority_programs',
                        name: 'priority_programs'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'date_created',
                        name: 'date_created',
                    },

                    {
                        data: 'csa',
                        name: 'csa'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [5, "desc"]
                ],
                drawCallback: function(settings) {
                    lucide.createIcons();
                },
                pageLength: 25, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
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
@endpush
