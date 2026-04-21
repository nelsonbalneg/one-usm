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
  <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">

    @if (!empty($curriculumDetails['yearAndLevel']))

        @foreach ($curriculumDetails['yearAndLevel'] as $row)

            <div class="xl:col-span-12">
                <div
                    class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">

                    {{-- CARD HEADER = SEMESTER --}}
                    <div class="bg-green-600 px-6 py-3">
                        <h4 class="font-semibold uppercase text-black text-sm">
                            {{ $row['yearTermDesc'] ?? 'N/A' }}
                        </h4>
                    </div>

                    {{-- CARD BODY --}}
                    <div class="card-body p-6 overflow-x-auto">

                        <table class="w-full text-sm">
                            <thead class="bg-slate-100">
                                <tr>
                                    <th class="px-3 py-2 text-left border">SUBJECT</th>
                                    <th class="px-3 py-2 text-center border">GRADE</th>
                                    <th class="px-3 py-2 text-center border">RE-EXAM</th>
                                    <th class="px-3 py-2 text-center border">REMARK</th>
                                    <th class="px-3 py-2 text-center border">PREREQUISITE</th>
                                </tr>
                            </thead>

                            <tbody>
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

                                        $bgClass = $remarks === 'failed'
                                            ? 'bg-red-100'
                                            : (!$subject['prerequisitesCleared'] ? 'bg-orange-100' : '');
                                    @endphp

                                    <tr class="{{ $bgClass }}">
                                        <td class="px-3 py-2 border">
                                            <span
                                                class="inline-block px-2 py-1 text-xs rounded bg-sky-100 text-sky-700 border border-sky-200">
                                                {{ $subject['subjectCode'] ?? '-' }}
                                            </span>
                                            <div class="mt-1">
                                                {{ $subject['subjectDesc'] ?? '-' }}
                                            </div>
                                        </td>

                                        <td class="px-3 py-2 text-center border">
                                            {{ $subject['finalGrade'] ?? '-' }}
                                        </td>

                                        <td class="px-3 py-2 text-center border">
                                            {{ $subject['reExam'] ?? '-' }}
                                        </td>

                                        <td class="px-3 py-2 text-center border">
                                            @if ($remarks)
                                                <span class="px-2 py-1 text-xs rounded {{ $badgeClass }}">
                                                    {{ $subject['finalRemarks'] }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-3 py-2 text-center border">
                                            {{ !empty($subject['preReqs'])
                                                ? (is_array($subject['preReqs'])
                                                    ? implode(', ', $subject['preReqs'])
                                                    : $subject['preReqs'])
                                                : '-' }}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        @endforeach

    @else
        <div class="xl:col-span-12 text-center py-6">
            <h4><i>No data available</i></h4>
        </div>
    @endif

</div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
