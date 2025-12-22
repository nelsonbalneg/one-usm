@extends('pao.layouts.master')
@section('title')
     USM-AES |  PAO Dashboard
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">
                @if ($selectedPrograms->isNotEmpty())
                    <h5 class="text-16">PROGRAM ADMISSION OFFICER</h5>
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
                <a href="#!" class="text-slate-400 dark:text-zink-200">SAR</a>
            </li>
             <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Program Policy</a>
            </li>
        </ul>
    </div>

  <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12 md:col-span-12">
        <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
            <div class="card-body">
                <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">
                    PROGRAMS TAGGED TO {{ $paoUsers[$selectedPrograms->first()['policyId']] ?? 'N/A' }} <br>
                    {{ $selectedPrograms->first()['collegeName'] }} - {{ $selectedPrograms->first()['realCampus'] }}
                </h6>

                {{-- Enrollment Closed Announcement --}}
                @if (!$enrollmentIrregStatus)
                    <div class="mt-4 p-4 text-red-700 bg-red-100 border border-red-300 rounded-md">
                        <strong>Enrollment is closed.</strong> Please contact the administrator for more information.
                    </div>
                @else
                    <table class="w-full table-auto mt-4">
                        <thead>
                            <tr class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                <th class="px-4 py-2 text-left">PID</th>
                                <th class="px-4 py-2 text-left">Campus</th>
                                <th class="px-4 py-2 text-left">Program</th>
                                <th class="px-4 py-2 text-left">PAO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedPrograms as $program)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                           href="{{ route('pao.sar.students.list', ['id' => $program['policyId']]) }}">
                                            {{ $program['policyId'] }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 border">{{ $program['realCampus'] }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $program['programName'] }}{{ !empty($program['majorDiscDesc']) ? ' - ' . $program['majorDiscDesc'] : '' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $paoUsers[$program['policyId']] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

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
