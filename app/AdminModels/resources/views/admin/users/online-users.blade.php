@extends('admin.layouts.master')
@section('title')
   USM-AES | CEE - Online Users
@endsection
@push('styles')
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
                Online Users
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
                        <h6 class="text-15 grow">Users List</h6>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">Name</th>
                                <th>LRN</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Role</th>
                                <th>Last Seen</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection

@push('scripts')
 {{-- data table scripts --}}
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
            table();

            function table() {
                // Get the page number from sessionStorage if available
                let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                    'currentPage')) : 0;


                if ($.fn.DataTable.isDataTable('#dbData')) {
                    $('#dbData').DataTable().destroy();
                }

                $('#dbData').DataTable({
                    responsive: true,
                    pageLength: 10,
                    columnDefs: [{
                            width: "10%",
                            targets: [0]
                        },
                        {
                            className: "text-start custom-middle-align",
                            targets: [0, 1, 2, 3,4,5]
                        },
                    ],
                    language: {
                        processing: `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                    },
                    processing: true,
                    serverSide: true,
                    deferRender: true, // Improves performance by delaying rendering
                    ajax: {
                        url: "{{ route('admin.cee.online-users.data') }}",
                        type: "GET",
                        dataType: "JSON",
                        data: function(d) {
                            d.roomid = $('#roomid').val(); // Pass the roomid
                        },
                        error: function(xhr, status, error) {
                            console.error("DataTable load error:", error); // Debugging line
                        }
                    },
                    columns: [{
                            data: "fullname",
                            name: "fullname"
                        },
                        {
                            data: 'lrn',
                            name: 'lrn'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'last_seen',
                            name: 'last_seen'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ],
                    order: [
                        [5, 'asc']
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
                        currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage
                            .getItem(
                                'currentPage')) : 0;
                        table.page(currentPage).draw(false);
                    } else {
                        let pageInfo = table.page.info();
                        sessionStorage.setItem('currentPage', pageInfo.page);
                    }
                });

            }
        });
</script>
@endpush
