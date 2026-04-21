@extends('student.layouts.master')
@section('title')
    One USM - Report of Grades
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')

    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">Report of Grades</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zinc-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Report of Grades
            </li>
        </ul>
    </div>

    @if (empty($gradesData))
        <p class="text-red-500">No grade data available.</p>
    @else
        @foreach ($gradesData as $term)
            <div class="card mb-4">
                <div class="card-body">

                    <h3 class="text-lg font-bold text-slate-700 mb-4">
                        {{ $term['termName'] }} ({{ $term['academicYear'] }})
                    </h3>

                    @if (!$term['evaluated'])
                        <div class="p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                            <strong>You need to evaluate your faculty before you can view your grades.</strong>
                        </div>
                    @else
                        {{-- SHOW GRADES ONLY IF EVALUATION IS COMPLETE --}}
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-green-600 text-black text-sm">
                                    <tr>
                                        <th class="px-3 py-2 font-semibold text-left">Course Code</th>
                                        <th class="px-3 py-2 font-semibold text-left">Course Title</th>
                                        <th class="px-3 py-2 font-semibold text-center">Units</th>
                                        <th class="px-3 py-2 font-semibold text-center">Midterm</th>
                                        <th class="px-3 py-2 font-semibold text-center">Final</th>
                                        <th class="px-3 py-2 font-semibold text-center">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach ($term['grades'] as $grade)
                                        <tr
                                            class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600 border-b border-slate-200 dark:border-zink-500">
                                            <td class="px-3 py-2">{{ $grade['courseCode'] }}</td>
                                            <td class="px-3 py-2">{{ $grade['courseTitle'] }}</td>
                                            <td class="px-3 py-2 text-center">{{ $grade['unit'] }}</td>
                                            <td class="px-3 py-2 text-center">{{ $grade['midTerm'] ?: '-' }}</td>
                                            <td class="px-3 py-2 text-center">{{ $grade['final'] ?: '-' }}</td>
                                            <td class="px-3 py-2 text-center">{{ strtoupper($grade['remarks']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    @endif

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
