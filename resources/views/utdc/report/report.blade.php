@extends('utdc.layouts.master')
@section('title')
     USM-AES | UTDC - Room Assigments
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
                <a href="#!" class="text-slate-400 dark:text-zink-200">Room Assignment</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center gap-2 space-x-4">
                        <h6 class="text-15 grow">Records</h6>
                        <label for="cee-term-select" class="block text-sm font-medium text-slate-600 dark:text-white">
                            Filter by CEE Terms
                        </label>
                        <select id="cee-term-select" name="cee_session_id" data-choices
                            class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                            <option disabled>Select Term</option>
                            @foreach ($ceeSessions as $session)
                                <option value="{{ $session->id }}"
                                    {{ isset($activeSession) && $activeSession->id == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">Room ID</th>
                                <th>Room Name</th>
                                <th>College</th>
                                <th>Batch</th>
                                <th>Time</th>
                                <th>Reserved</th>
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
            let activeSessionId = $('#cee-term-select').val();

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
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('utdc.reservation.room.get-room-data') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.cee_session_id = $('#cee-term-select').val() ||
                            activeSessionId; // Load selected or default session
                    }
                },
                columns: [{
                        data: "id",
                        name: "id"
                    },
                    {
                        data: "room_name",
                        name: "room_name"
                    },
                    {
                        data: 'college_name',
                        name: 'college_name'
                    },
                    {
                        data: 'exam_session',
                        name: 'exam_session'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'reservation_count',
                        name: 'reservation_count'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [5, "desc"]
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
