@extends('aro.layouts.master')
@section('title')
    USM-AES | Pre-registration - Enrolled Applicants Summary
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">ENROLLED APPLICANTS SUMMARY <span class="text-custom-500">1ST SEMESTER SY 2025-2026</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Enrolled Dashboard
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12 md:col-span-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-blue-500 uppercase text-15">
                        <i data-lucide="hash" class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>
                        PRE-REGISTRATION DATA PER CAMPUS, COLLEGE and PROGRAM (FOR ENROLLMENT)
                    </h6>
                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below show the number of officially enrolled applicants per program
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
                                <th class="px-4 py-2 text-left border">Policy ID</th>
                                <th class="px-4 py-2 text-left border">Program Name</th>
                                <th class="px-4 py-2 text-left border">Enrolled</th>
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
                                    <td colspan="5" class="px-4 py-2 text-lg">{{ $campusName }}</td>
                                </tr>

                                @if (isset($programRows[$campusName]))
                                    @foreach ($programRows[$campusName] as $collegeName => $programs)
                                        {{-- College Header --}}
                                        <tr
                                            class="p-2 font-semibold text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                            <td colspan="5" class="px-4 py-2">{{ $collegeName }}</td>
                                        </tr>

                                        {{-- Program Rows --}}
                                        @foreach ($programs as $program)
                                            <tr class="program-row">
                                                <td class="px-4 py-2 border">{{ $program->policyId }}</td>
                                                <td class="px-4 py-2 border">{{ $program->programName }}</td>
                                                <td class="px-4 py-2 border">
                                                    <a href="{{ route('aro.prereg.enrolled-applicants.index', ['policyId' => $program->policyId]) }}"
                                                        class="text-blue-600 hover:underline" target="_blank">
                                                        {{ $program->total_pending }}
                                                    </a>
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
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Campus Total --}}
                                <tr class="font-bold bg-green-50 dark:bg-zink-700">
                                    <td colspan="2" class="px-4 py-2 border">Total for {{ $campusName }}</td>
                                    <td class="px-4 py-2 border">{{ $campusTotal->total_pending }}</td>
                                </tr>
                            @endforeach

                            {{-- Overall Total --}}
                            @if (isset($overallTotal))
                                <tr class="text-lg font-bold bg-green-300 dark:bg-zink-700">
                                    <td colspan="2" class="px-4 py-2 border">{{ $overallTotal->collegeName }}</td>
                                    <td class="px-4 py-2 border">{{ $overallTotal->total_pending }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>
@endsection
