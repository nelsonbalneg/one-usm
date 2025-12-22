@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Program Look-Up
@endsection

@push('styles')
{{-- <link href="https://cdn.datatables.net/v/dt/dt-2.3.0/r-3.0.4/datatables.min.css" rel="stylesheet" integrity="sha384-xhVLA/Byj+SRV+AnTLWSPBdri0gf0BktegXOACapNySTB9zPBDn2mt1WtXFPJ6BX" crossorigin="anonymous"> --}}
{{-- <link href="https://cdn.datatables.net/v/dt/dt-2.3.0/b-3.2.3/r-3.0.4/datatables.min.css" rel="stylesheet" integrity="sha384-2ey59HcXGX5MZg21R/vUMeNhoZZKMnK1PWLzyhQD+wXYMNcxK3rmSBqCT8cNe53Q" crossorigin="anonymous"> --}}
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - PROGRAMS </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Programs
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
                    <div class="flex items-center">
                        <h6 class="text-15 grow">PROGRAMS OFFERED</h6>
                    </div>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th class="ltr:!text-left rtl:!text-right">Policy ID</th>
                                <th>Program Name</th>
                                <th>Limit</th>
                                <th>Cut Off</th>
                                <th>Reservation Status</th>
                                <th>Ranking Status</th>
                                <th>Term</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>


{{-- <script src="https://cdn.datatables.net/v/dt/dt-2.3.0/r-3.0.4/datatables.min.js" integrity="sha384-dINxpY4ZbPaSfE8y3bYiaGCyAmwd33raDoPqo/gS8ru2ljEDCQsRRjYuBQHyTLU/" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.datatables.net/v/dt/dt-2.3.0/b-3.2.3/r-3.0.4/datatables.min.js" integrity="sha384-G4G67UPlTr42APvWZDml3fUjKlzTkP/wnFLNIUIRarxsMW9uGZmwaebj9qBtBufC" crossorigin="anonymous"></script> --}}
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
                        targets: [0, 1, 2, 3, 4]
                    },
                ],
                language: {
                    "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.prereg.programs.get-programs') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [
                    {
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "programName",
                        name: "programName",
                    },
                    {
                        data: "limit",
                        name: "limit",
                    },
                    {
                        data: "usmceefp",
                        name: "usmceefp",
                    },
                    {
                        data: "reservation_status",
                        name: "reservation_status",
                    },
                    {
                        data: "ranking_status",
                        name: "ranking_status",
                    },
                    {
                        data: "term",
                        name: "term",
                    }
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
    </script>
@endpush
