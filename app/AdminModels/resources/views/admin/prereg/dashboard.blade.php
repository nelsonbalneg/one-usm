@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Dashboard
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION DASHBOARD <span class="text-custom-500">1ST SEMESTER SY 2025-2026</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

        <div
            class=" bg-slate-100 dark:bg-slate-500/20 card 2xl:col-span-2 md:col-span-12 group-data-[skin=bordered]:border-slate-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center rounded-md bg-slate-500 size-12 text-15 text-slate-50">
                    <i data-lucide="file-digit"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $preregCountAll }}"></span></h5>
                <p class="text-slate-500 dark:text-slate-200">Overall Total</p>
            </div>
        </div>

        <div
            class=" bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-2 md:col-span-12 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center rounded-md bg-sky-500 size-12 text-15 text-sky-50">
                    <i data-lucide="check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $prereg_pending }}"></span></h5>
                <p class="text-slate-500 dark:text-slate-200">Pending for Enrollment</p>
            </div>
        </div>


        <!--end col-->



        <div
            class=" bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-2 md:col-span-12 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="circle"
                    class="absolute top-0 stroke-1 size-32 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-orange-500 rounded-md size-12 text-15 text-orange-50">
                    <i data-lucide="circle"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $prereg_for_ranking }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">For Ranking </p>
            </div>
        </div>
        <!--end col -->
        {{-- {{ $count_published }} --}}

        <div
            class=" bg-green-100 dark:bg-green-500/20 card 2xl:col-span-2 md:col-span-12 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                    <i data-lucide="users"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $total_pend_for_ranking }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">Pending + For Ranking</p>
            </div>
        </div>
        <!--end col-->

        <div
            class=" bg-purple-100 dark:bg-purple-500/20 card 2xl:col-span-4 md:col-span-12 group-data-[skin=bordered]:border-purple-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-purple-200/50 dark:text-purple-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-purple-500 rounded-md size-12 text-15 text-purple-50">
                    <i data-lucide="thumbs-up"></i>
                </div>
                <a href="{{ route('admin.prereg.enrolled-applicants-summary.index') }}" target="_blank">
                    <h5 class="mt-4 mb-2">
                        <span class="counter-value" data-target="{{ $prereg_step_6 }}"></span>
                    </h5>
                </a>

                <p class="text-slate-500 dark:text-zink-200">Total Enrolled Applicants </p>
            </div>
        </div>
        <!--end col-->

        <div class="xl:col-span-3 md:col-span-12">
            <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                <div class="card-body">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">PRE-REGISTRATION PER STEP COUNT</h6>

                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below show the number of applicants in each step of the pre-registration process.
                    </p>

                    <table class="w-full table-auto">
                        <thead>
                            <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                <th class="px-4 py-2 text-left">Current Step</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $step)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        @php
                                            $label = $step->label;

                                            if (Str::startsWith($label, 'Step')) {
                                                $stepNumber = (int) filter_var($label, FILTER_SANITIZE_NUMBER_INT);

                                                switch ($stepNumber) {
                                                    case 1:
                                                        $label = 'Profile Information';
                                                        break;
                                                    case 2:
                                                        $label = 'Parents and Guardian Info';
                                                        break;
                                                    case 3:
                                                        $label = 'Educational Background';
                                                        break;
                                                    case 4:
                                                        $label = 'Emergency Contact Details';
                                                        break;
                                                    case 5:
                                                        $label = 'Uploading of Requirements';
                                                        break;
                                                    case 6:
                                                        $label = 'Confirmation of Program';
                                                        break;
                                                    default:
                                                        $label = $step->label;
                                                }
                                            }
                                        @endphp

                                        {{ $label }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $step->step_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <h6 class="mt-4 mb-0 text-lg font-semibold text-blue-500 uppercase">CONFIRMATION COUNT PER BATCH</h6>

                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below show the number of applicants in Batch 1 and Batch 2 during the pre-registration
                        process.
                    </p>
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                <th class="px-4 py-2 text-left">Batch</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($count_per_batch as $row)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $row->status }}</td>
                                    <td class="px-4 py-2 border">{{ $row->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="text-16">PRE-REGISTRATION SCHEDULE <span class="text-custom-500">1ST SEMESTER SY
                                2025-2026</span>
                        </h5>
                        <table class="w-full mt-2 table-auto">
                            <thead>
                                <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                    <th class="px-4 py-2 text-left">Opening Date</th>
                                    <th class="px-4 py-2 text-left">Closing Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($site_settings->start_prereg_second_batch)->format('F j, Y
                                                                                                                                                                                                                                                                                                                            g:i A') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($site_settings->end_prereg_second_batch)->format('F j, Y
                                                                                                                                                                                                                                                                                                                            g:i A') }}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-5 md:col-span-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-blue-500 uppercase text-15">
                        <i data-lucide="hash" class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>
                        PRE-REGISTRATION DATA PER CAMPUS, COLLEGE and PROGRAM (FOR ENROLLMENT)
                    </h6>
                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below show the number of applicants pending for enrollment per program.
                    </p>


                    <!-- SEARCH BAR -->
                    <div class="mb-4">
                        <input type="text" id="searchInput" placeholder="Search program, pending, slots..."
                            class="w-full px-4 py-2 border rounded-md dark:bg-zink-700 dark:border-zink-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <table id="dataTable"
                        class="w-full bg-white border border-gray-200 table-auto dark:bg-zink-800 dark:border-zink-600">
                        <thead class="bg-slate-100 dark:bg-zink-700">
                            <tr>
                                <th class="px-4 py-2 border">PID</th>
                                <th class="px-4 py-2 border">Program</th>
                                <th class="px-4 py-2 border">Pending for Enrollment</th>
                                <th class="px-4 py-2 border">Enrolled</th>
                                <th class="px-4 py-2 border">Available Slots</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentCampus = null;
                                $currentCollege = null;
                                $programRows = [];
                                $collegeTotals = [];
                                $campusTotals = [];
                                $overallAvailableSlots = 0;

                                foreach ($count_per_college as $row) {
                                    if ($row->campusName === 'All Campuses') {
                                        $overallTotal = $row;
                                        continue;
                                    }

                                    if ($row->collegeName === 'Total') {
                                        $campusTotals[$row->campusName] = $row;
                                        continue;
                                    }

                                    if (is_null($row->policyId)) {
                                        $collegeTotals[$row->campusName][$row->collegeName] = $row;
                                        continue;
                                    }

                                    $programRows[$row->campusName][$row->collegeName][] = $row;
                                }
                            @endphp

                            @foreach ($campusTotals as $campusName => $campusTotal)
                                {{-- Campus Header --}}
                                <tr class="font-bold bg-custom-200 dark:bg-zink-700">
                                    <td colspan="6" class="px-4 py-2 text-lg">{{ $campusName }}</td>
                                </tr>

                                @if (isset($programRows[$campusName]))
                                    @foreach ($programRows[$campusName] as $collegeName => $programs)
                                        {{-- College Header --}}
                                        <tr
                                            class="p-2 font-semibold text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                            <td colspan="6" class="px-4 py-2">{{ $collegeName }}</td>
                                        </tr>

                                        @php
                                            $collegeAvailableSlots = 0;
                                        @endphp

                                        {{-- Program Rows --}}
                                        @foreach ($programs as $program)
                                            <tr class="program-row">
                                                {{-- <td class="px-4 py-2 border">{{ $program->policyId }}</td> --}}
                                                <td class="px-4 py-2 border">
                                                    <a href="{{ route('admin.prereg.show.confirmed-applicants', ['policyId' => $program->policyId]) }}"
                                                        class="text-blue-600 hover:underline" target="_blank">
                                                        {{ $program->policyId }}
                                                    </a>
                                                </td>
                                                {{-- <td class="px-4 py-2 border">{{ $program->programName }}</td> --}}
                                                <td class="px-4 py-2 border">
                                                    <a href="{{ route('admin.prereg.program-policy-details.index', ['policyId' => $program->policyId]) }}"
                                                        class="text-blue-600 transition-colors duration-200 hover:text-blue-800 hover:underline focus:outline-none">
                                                        {{ $program->programName }}
                                                    </a>
                                                </td>
                                                <td class="px-4 py-2 border">{{ $program->total_pending }}</td>
                                                <td class="px-4 py-2 border">{{ $program->total_enrolled }}</td>
                                                <td class="px-4 py-2 border">
                                                    @if (isset($program->availableSlots))
                                                        {{ $program->availableSlots }}
                                                        @php
                                                            $collegeAvailableSlots += $program->availableSlots;
                                                            $overallAvailableSlots += $program->availableSlots;
                                                        @endphp
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    <div
                                                        class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                                        <div class="toggle-container"
                                                            data-policy-id="{{ $program->policyId }}">
                                                            <input type="checkbox" name="isOpen"
                                                                id="greenIconSwitch-{{ $program->policyId }}"
                                                                class="absolute block size-5 transition duration-300 ease-linear border-2 border-slate-200 dark:border-zink-500 rounded-full appearance-none cursor-pointer bg-white/80 dark:bg-zink-600 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none after:absolute after:text-slate-500 dark:after:text-zink-200 after:content-['\eb99'] after:text-xs after:inset-0 after:flex after:items-center after:justify-center after:font-remix after:leading-none checked:after:text-green-500 dark:checked:after:text-green-500 checked:after:content-['\eb7b']"
                                                                {{ ($programData[$program->policyId]['reservationStatus'] ?? 'Closed') === 'Open' ? 'checked' : '' }}
                                                                onclick="togglePolicy('{{ $program->policyId }}', this)">
                                                            <label for="greenIconSwitch-{{ $program->policyId }}"
                                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                        {{-- College Total --}}
                                        @if (isset($collegeTotals[$campusName][$collegeName]))
                                            <tr
                                                class="p-2 font-semibold text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                <td colspan="2" class="px-4 py-2 border">Total for {{ $collegeName }}
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    {{ $collegeTotals[$campusName][$collegeName]->total_pending }}
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    {{ $collegeTotals[$campusName][$collegeName]->total_enrolled ?? 0 }}
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    {{ $collegeAvailableSlots }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Campus Total --}}
                                <tr class="font-bold bg-green-50 dark:bg-zink-700">
                                    <td colspan="2" class="px-4 py-2 border">Total for {{ $campusName }}</td>
                                    <td class="px-4 py-2 border">{{ $campusTotal->total_pending }}</td>
                                    <td class="px-4 py-2 border">{{ $campusTotal->total_enrolled ?? 0 }}</td>
                                    <td class="px-4 py-2 border"></td>
                                </tr>
                            @endforeach

                            {{-- Overall Total --}}
                            @if (isset($overallTotal))
                                <tr class="text-lg font-bold bg-green-300 dark:bg-zink-700">
                                    <td colspan="2" class="px-4 py-2 border">{{ $overallTotal->collegeName }}</td>
                                    <td class="px-4 py-2 border">{{ $overallTotal->total_pending }}</td>
                                    <td class="px-4 py-2 border">{{ $overallTotal->total_enrolled ?? 0 }}</td>
                                    <td class="px-4 py-2 border">{{ $overallAvailableSlots }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>


                </div>

            </div>
        </div>

        <div class="xl:col-span-4 md:col-span-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-blue-500 uppercase text-15"><i data-lucide="hash"
                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>pre-registration per program
                        (FOR RANKING)
                    </h6>
                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below show the number of applicants who applied for ranking per program.
                    </p>

                    <!-- SEARCH BAR -->
                    <div class="mb-4">
                        <input type="text" id="searchInputforRanking" placeholder="Search program"
                            class="w-full px-4 py-2 mb-2 border rounded-md dark:bg-zink-700 dark:border-zink-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400" />

                        <!-- Create room Button -->
                        <a type="button" id="rankBtn" data-url="{{ route('admin.applicant-profile.rank-all') }}"
                            class="flex items-center justify-center h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            <i data-lucide="arrow-up-from-line" class="inline-block size-4"></i>
                            <span class="align-middle">Rank All</span>
                        </a>
                    </div>

                    <table id="dataTableforRanking" class="w-full table-auto">
                        <thead>
                            <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                <th class="px-4 py-2 text-left">Program Name</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($count_applicant_program_for_ranking as $row)
                                <tr class="program-row-for-ranking">
                                    <td class="px-4 py-2 border">{{ $row->programName }}</td>
                                    <td class="px-4 py-2 border">{{ $row->total_pending }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('admin.applicants.rank.view', ['policyId' => $row->policyId]) }}"
                                            class="text-custom-500 hover:underline">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- JS for Search -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTable tbody .program-row');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
    </script>

    <script>
        document.getElementById('searchInputforRanking').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableforRanking tbody .program-row-for-ranking');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
    </script>

    <script>
        document.getElementById('rankBtn').addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will rank all applicants.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>

    @if (session('rank_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('rank_success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    <script>
        function togglePolicy(policyId, checkbox) {
            const isOpen = checkbox.checked;

            const data = {
                policyId: policyId,
                isOpen: isOpen,
                _token: "{{ csrf_token() }}"
            };

            const url = "{{ route('admin.pre-registration.toggle.policy', ':policyId') }}".replace(':policyId', policyId);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    return response.json().then(data => {
                        if (response.ok && data.success) {

                            Toastify({
                                text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                                    (data.message || "Status has been updated"),
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4CAF50", // Green for success
                                className: "success",
                                escapeMarkup: false
                            }).showToast();

                            return data;
                        } else {
                            throw new Error(data.message || 'Unknown error occurred');
                        }
                    });
                })
                .then(data => {
                    console.log('Success response:', data);

                    // Update status element
                    const statusElement = document.querySelector(`#status-${policyId}`);
                    if (statusElement) {
                        statusElement.textContent = data.status;
                    }

                    // show toastify here
                    // Display the success message using Toastify


                })
                .catch(error => {
                    console.error('Error:', error);
                    checkbox.checked = !checkbox.checked; // Revert toggle on error
                    showErrorMessage(error.message);
                });
        }
    </script>

@endpush
