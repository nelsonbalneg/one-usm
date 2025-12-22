@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Rooms
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Rooms</a>
            </li>
        </ul>
    </div>


    <form action="{{ route('admin.cee.rooms.view') }}" method="GET" class="mb-5">
        <div class="flex items-center gap-3">
            <!-- Search Input -->
            <div class="relative w-72">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    placeholder="Search for room" autocomplete="off">
                <button type="submit" class="absolute right-2.5 top-2.5 text-slate-500 dark:text-zink-200">
                    <i data-lucide="search"></i>
                </button>
            </div>

            <!-- Select Term Dropdown (Now inside the form) -->
            <div>
                <select id="cee-term-select" name="cee_session_id" data-choices
                    class="form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]"
                    onchange="this.form.submit()"> <!-- Auto-submit on change -->
                    <option disabled>Select Term</option>
                    @foreach ($ceeSessions as $session)
                        <option value="{{ $session->id }}"
                            {{ request('cee_session_id', optional($activeSession)->id) == $session->id ? 'selected' : '' }}>
                            {{ $session->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>



    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-4">

        @foreach ($rooms as $room)
            <div class="card">
                <div class="card-body">
                    <div
                        class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-slate-100 dark:bg-zink-600">
                        <img src="{{ asset('backend/assets/images/map/' . Str::lower($room->map_file) . '.png') }}"
                            alt="" class="rounded-full size-16">
                        @if ($room->status == 'active')
                            <span
                                class="absolute bg-green-400 border-2 border-white rounded-full size-3 dark:border-zink-700 bottom-1 ltr:right-1 rtl:left-1"></span>
                        @else
                            <span
                                class="absolute bg-red-400 border-2 border-white rounded-full size-3 dark:border-zink-700 bottom-1 ltr:right-1 rtl:left-1"></span>
                        @endif
                    </div>
                    <div class="mt-4 text-center">
                        <input type="text" id="room_id" value="{{ $room->id }}" hidden>
                        <h5 class="mb-1 text-16"><a href="#">{{ $room->cee_session_id }} {{ $room->room_name }} (
                                {{ $room->exam_session }} )</a></h5>
                        <p class="text-slate-500 dark:text-zink-200">{{ $room->college_name }}</p>
                        <p class="text-slate-500 dark:text-zink-200">
                            {{ \Carbon\Carbon::parse($room->schedule)->format('F j, Y') }} | {{ $room->time }}</p>

                    </div>
                    <div class="flex gap-2 mt-5">
                        <a
                            class="bg-white text-custom-500 btn border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:bg-zink-700 dark:hover:bg-custom-500 dark:ring-custom-400/20 dark:focus:bg-custom-500 grow"><i
                                data-lucide="hash" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i> <span
                                id="room-{{ $room->id }}-slots" class="align-middle">Available Slots:
                                {{ $room->capacity }} | Reserved:
                                {{ $room->total_reservations }} </span></a>

                        <div class="relative dropdown">
                            <button type="button" id="userGridDropdown12" data-bs-toggle="dropdown"
                                class="dropdown-toggle flex items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i
                                    data-lucide="more-horizontal" class="size-4"></i></button>
                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                aria-labelledby="userGridDropdown12">
                                <li>
                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="{{ route('admin.cee.room-adjustment.index', ['roomId' => $room->id]) }}"
                                        target="_blank"><i data-lucide="eye"
                                            class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                            class="align-middle">Details</span></a>
                                </li>
                                <li>
                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="{{ route('admin.reservation.room.view-applicacant-by-room', ['roomId' => $room->id]) }}"><i
                                            data-lucide="printer" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                            class="align-middle">Print</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!--end col & card-->
        @endforeach

    </div><!--end grid-->
    <!-- Pagination Links -->
    <div class="mt-4 mb-4">
        {{ $rooms->links() }}
    </div>
@endsection
@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script>
        function updateSlots() {
            $.ajax({
                url: "{{ route('admin.cee.rooms.slots') }}",
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log("API Response:", response); // ✅ Debugging output

                    response.forEach(room => {
                        let roomElement = $(`#room-${room.id}-slots`);
                        if (roomElement.length) {
                            // Convert to numbers before calculations
                            let capacity = parseInt(room.capacity, 10);
                            let totalReservations = parseInt(room.total_reservations, 10);

                            // Prevent NaN values
                            if (isNaN(capacity)) capacity = 0;
                            if (isNaN(totalReservations)) totalReservations = 0;

                            roomElement.html(
                                `Available Slots: ${capacity} | Reserved: ${totalReservations}`
                            );
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        }

        // ✅ Initial Fetch and Periodic Update
        updateSlots();
        setInterval(updateSlots, 5000);
    </script>
@endpush
