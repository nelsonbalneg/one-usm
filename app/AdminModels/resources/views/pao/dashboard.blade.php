@extends('pao.layouts.master')
@section('title')
    USM-AES | PAO Dashboard
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">
                @if ($selectedPrograms->isNotEmpty())
                    <h5 class="text-16">PROGRAM ADMISSION OFFICER DASHBOARD</h5>
                    <span
                        class='uppercase inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>
                        {{ $selectedPrograms->first()['term'] }}
                    </span>
                @endif
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

        {{-- <div
            class=" bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-3 md:col-span-12 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center rounded-md bg-sky-500 size-12 text-15 text-sky-50">
                    <i data-lucide="check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="9"></span></h5>
                <p class="text-slate-500 dark:text-slate-200">Pending for Enrollment</p>
            </div>
        </div> --}}

        <div class="xl:col-span-12 md:col-span-12">
            <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                <div class="card-body">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">PROGRAMS TAGGED TO
                    @php
                        $program = $selectedPrograms->first() ?? null;
                    @endphp

                    @if ($program)
                        {{ $paoUsers[$program['policyId']] ?? 'N/A' }} <br>
                        {{ $program['collegeName'] }} - {{ $program['realCampus'] ?? '' }}
                    @else
                        NONE
                    @endif

                    </h6>

                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below represent the number of applicants at each stage of the enrollment process:
                        pending for enrollment, under assessment, and fully enrolled.
                    </p>


                    <table class="w-full table-auto">
                        <thead>
                            <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                <th class="px-4 py-2 text-left">PID</th>
                                <th class="px-4 py-2 text-left">Campus</th>
                                <th class="px-4 py-2 text-left">Program</th>
                                <th class="px-4 py-2 text-left">PAO</th>
                                <th class="px-4 py-2 text-left">Pending</th>
                                <th class="px-4 py-2 text-left">For Assessment</th>
                                <th class="px-4 py-2 text-left">Enrolled</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedPrograms as $program)
                                @php
                                    $programPolicyId = $program['policyId'];
                                    $programCounts = $counts[$programPolicyId] ?? [
                                        'pending_for_enrollment' => 0,
                                        'for_assessment' => 0,
                                        'enrolled' => 0,
                                    ];
                                @endphp

                                <tr>
                                    <td class="px-4 py-2 border"><a
                                            class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="{{ route('pao.no.admission.requirements', ['id' => $program['policyId']]) }}">{{ $program['policyId'] }}</a>
                                    </td>
                                    <td class="px-4 py-2 border">{{ $program['realCampus'] }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $program['programName'] }}{{ !empty($program['majorDiscDesc']) ? ' - ' . $program['majorDiscDesc'] : '' }}
                                    </td>
                                    {{-- <td class="px-4 py-2 border"> {{ $paoUsers[$program['policyId']] ?? 'N/A' }}</td> --}}
                                    <td class="px-4 py-2 border">
                                        @php
                                            $raw = $paoUsers[$program['policyId']] ?? '';
                                            $parts = array_map('trim', explode(',', $raw));
                                            $names = [];

                                            for ($i = 0; $i < count($parts) - 1; $i += 2) {
                                                $names[] = $parts[$i] . ', ' . $parts[$i + 1];
                                            }
                                        @endphp

                                        @forelse ($names as $name)
                                            <span
                                                class="inline-block bg-custom-100 text-custom-500 text-xs font-medium mr-2 mb-1 px-2.5 py-0.5 rounded">
                                                {{ $name }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-slate-500">No PAO assigned to this program.</span>
                                        @endforelse
                                    </td>
                                    <td class="px-4 py-2 border">{{ $programCounts['pending_for_enrollment'] }}</td>
                                    <td class="px-4 py-2 border">{{ $programCounts['for_assessment'] }}</td>
                                    <td class="px-4 py-2 border">{{ $programCounts['enrolled'] }}</td>
                                </tr>
                            @endforeach

                            {{-- Overall Totals Row --}}
                            <tr class="font-semibold bg-slate-200 text-slate-700">
                                <td class="px-4 py-2 text-center border" colspan="4">Overall Total</td>
                                <td class="px-4 py-2 border">{{ $totalCounts['pending_for_enrollment'] }}</td>
                                <td class="px-4 py-2 border">{{ $totalCounts['for_assessment'] }}</td>
                                <td class="px-4 py-2 border">{{ $totalCounts['enrolled'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
@endpush
