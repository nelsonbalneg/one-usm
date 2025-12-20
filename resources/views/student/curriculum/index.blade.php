@extends('student.layouts.master')
@section('title', 'One USM - Student Curriculum')

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">Curriculum</h5>
            @if ($curriculumCode)
                <p class="text-slate-700 mt-1 font-bold">{{ $curriculumCode }}</p>
            @else
                <p class="text-red-500 mt-1">No curriculum found for your program.</p>
            @endif
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zinc-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Curriculum
            </li>
        </ul>
    </div>

    <!-- Curriculum Card -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            <div
                class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="card-body p-6">
                    <div class="overflow-x-auto mt-4">

                        {{-- FIXED: Change $curriculums to $curriculumDetails --}}
                        @if (!empty($curriculumDetails['yearAndLevel']))
                            <table class="w-full">
                                <thead class="bg-green-600 text-black text-sm">
                                    <tr>
                                        <th
                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                            SUBJECT</th>
                                        <th
                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                            GRADE</th>
                                        <th
                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                            RE-EXAM</th>
                                        <th
                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                            REMARK</th>
                                        <th
                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                            PREREQUISITE</th>
                                    </tr>
                                </thead>

                                <tbody class="text-sm">
                                    @foreach ($curriculumDetails['yearAndLevel'] as $row)
                                        {{-- YEAR / TERM --}}
                                        <tr class="bg-slate-100">
                                            <td colspan="5"
                                                class="px-3 py-2 font-semibold uppercase border-y border-slate-300">
                                                {{ $row['yearTermDesc'] ?? 'N/A' }}
                                            </td>
                                        </tr>

                                        {{-- SUBJECTS --}}
                                        @foreach ($row['subjects'] as $subject)
                                            @php
                                                $remarks = strtolower($subject['finalRemarks'] ?? '');
                                                $badgeClass = match ($remarks) {
                                                    'passed' => 'text-green-600 bg-green-100 border border-green-200',
                                                    'failed' => 'text-red-600 bg-red-100 border border-red-200',
                                                    default => $subject['prerequisitesCleared']
                                                        ? 'text-yellow-600 bg-yellow-100 border border-yellow-200'
                                                        : 'text-sky-600 bg-sky-100 border border-sky-200',
                                                };

                                                // Updated: red row for failed subjects
                                                $bgClass =
                                                    $remarks === 'failed'
                                                        ? 'bg-red-100 border border-red-500'
                                                        : (!$subject['prerequisitesCleared']
                                                            ? 'bg-orange-100'
                                                            : '');
                                            @endphp

                                            <tr class="{{ $bgClass }}">
                                                <td class="px-3 py-2 border-y border-slate-200">
                                                    <span
                                                        class="px-2 py-1 text-xs rounded bg-sky-100 text-sky-700 border border-sky-200">
                                                        {{ $subject['subjectCode'] ?? '-' }}
                                                    </span>
                                                    <div class="mt-1">
                                                        {{ $subject['subjectDesc'] ?? '-' }}
                                                    </div>
                                                </td>

                                                <td class="px-3 py-2 text-center border-y border-slate-200">
                                                    {{ $subject['finalGrade'] ?? '-' }}
                                                </td>

                                                <td class="px-3 py-2 text-center border-y border-slate-200">
                                                    {{ $subject['reExam'] ?? '-' }}
                                                </td>

                                                <td class="px-3 py-2 text-center border-y border-slate-200">
                                                    @if ($remarks)
                                                        <span class="px-2 py-1 text-xs rounded {{ $badgeClass }}">
                                                            {{ $subject['finalRemarks'] }}
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="px-3 py-2 border-y border-slate-200 text-center">
                                                    {{ !empty($subject['preReqs'])
                                                        ? (is_array($subject['preReqs'])
                                                            ? implode(', ', $subject['preReqs'])
                                                            : $subject['preReqs'])
                                                        : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                            </table>
                        @else
                            <div class="text-center py-6">
                                <h4><i>No data available</i></h4>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
