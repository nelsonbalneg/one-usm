@extends('pao.layouts.master')
@section('title')
    USM-AES | Pre-registration - Assessment
@endsection

@push('styles')
@endpush

@section('contents')

    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Assessment</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Assessment</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-12 gap-5">
        <div class="col-span-12 xl:col-span-6">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3">
                        <div class="rounded-full w-28 h-28 bg-slate-100 shrink-0 dark:bg-zink-600">
                            <img src="{{ asset('backend/assets/images/users/avatar-3.png') }}" alt=""
                                class="object-cover w-full h-full rounded-full">
                        </div>
                        <div class="grow">
                            <h3 class="text-[20px]">{{ $studentName }}
                                <i data-lucide="badge-check"
                                    class="inline-block text-3xl text-green-500 fill-green-100 dark:fill-green-500/20"></i>

                            </h3>
                            <p class="text-2xl text-slate-500 dark:text-zink-200">
                                {{ $programName }}
                            </p>
                            <div class="flex items-center gap-2">
                                <div class="grow">
                                    <span
                                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                        {{ $studentNo }}
                                    </span>
                                    <span
                                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">
                                        {{ $majorName }}
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-->

            <!--start card-->
            <div class="card">
                <div class="card-body">
                    <div>
                        <ul
                            class="flex flex-wrap w-full text-sm font-medium text-center border-b border-slate-200 dark:border-zink-500 nav-tabs">
                            <li class="group active">
                                <a href="javascript:void(0);" data-tab-toggle data-target="curriculum"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-white -mb-[1px]">Curriculum</a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="ReportOfGrades"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-white -mb-[1px]">Report
                                    of Grades</a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="blocksection"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-white -mb-[1px]">Block
                                    Section</a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="opensection"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-white -mb-[1px]">Open
                                    Section</a>
                            </li>
                        </ul>

                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="curriculum">
                                <p class="mb-0">
                                <div class="overflow-x-auto">
                                    @if (!empty($curriculums['yearAndLevel']))
                                        <table class="w-full">
                                            <thead class="ltr:text-left rtl:text-right">
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
                                            <tbody>
                                                @foreach ($curriculums['yearAndLevel'] ?? [] as $row)
                                                    <tr class="bg-slate-100">
                                                        <td colspan="6"
                                                            class="px-3.5 py-2.5 font-semibold text-sm uppercase border-y border-slate-300">
                                                            {{ $row['yearTermDesc'] ?? 'N/A' }}
                                                            ({{ $row['totalUnits'] ?? '0' }}
                                                            Units)
                                                        </td>
                                                    </tr>

                                                    @foreach ($row['subjects'] ?? [] as $subject)
                                                        @php
                                                            $remarks = strtolower($subject['finalRemarks'] ?? '');
                                                            $badgeClass = match ($remarks) {
                                                                'passed'
                                                                    => 'text-black-500 bg-green-100 border-green-200 dark:bg-green-500/20 dark:border-green-500/20',
                                                                'failed'
                                                                    => 'text-black-500 bg-red-100 border-red-200 dark:bg-red-500/20 dark:border-red-500/20',
                                                                default => $subject['prerequisitesCleared']
                                                                    ? 'text-black-500 bg-yellow-100 border-yellow-200 dark:bg-yellow-500/20 dark:border-yellow-500/20'
                                                                    : 'text-black-500 bg-sky-100 border-sky-200 dark:bg-sky-500/20 dark:border-sky-500/20',
                                                            };
                                                            $bgClass = !$subject['prerequisitesCleared']
                                                                ? 'bg-orange-100 dark:bg-orange-200'
                                                                : '';
                                                        @endphp

                                                        <tr class="{{ $bgClass }}">
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <div class="grow">
                                                                        <span
                                                                            class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                                                            {{ $subject['subjectCode'] ?? '-' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <h6> {{ $subject['subjectDesc'] ?? '-' }}</h6>
                                                            </td>
                                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                                {{ $subject['finalGrade'] ?? '-' }}
                                                            </td>
                                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                                {{ $subject['reExam'] ?? '-' }}
                                                            </td>
                                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                                @if ($remarks)
                                                                    <span
                                                                        class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border {{ $badgeClass }}">
                                                                        {{ $subject['finalRemarks'] }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                                {{ isset($subject['preReqs']) && !empty($subject['preReqs'])
                                                                    ? (is_array($subject['preReqs'])
                                                                        ? implode(', ', $subject['preReqs'])
                                                                        : $subject['preReqs'])
                                                                    : '' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @else
                                        <div style="text-align: center;">
                                            <h4><i>No data available</i></h4>
                                        </div>
                                    @endif
                                </div>
                                </p>
                            </div>
                            <div class="hidden tab-pane" id="ReportOfGrades">
                                <p class="mb-0">
                                <div class="overflow-x-auto">
                                    @if (!empty($reportofgrades))
                                        <table class="w-full">
                                            <thead class="ltr:text-left rtl:text-right">
                                                <tr>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        COURSE TITLE</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        CLASS SECTION</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        LEC UNIT</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        LAB UNIT</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        UNIT</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        FINAL</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        RE-EXAM</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        REMARKS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reportofgrades ?? [] as $row)
                                                    <tr class="bg-slate-100">
                                                        <td colspan="8"
                                                            class="px-3.5 py-2.5 font-semibold text-sm uppercase border-y border-slate-300 dark:border-zink-500">
                                                            {{ $row['academicYear'] ?? 'N/A' }}
                                                            {{ $row['termName'] ?? '' }}
                                                        </td>
                                                    </tr>

                                                    @php $count = 1; @endphp
                                                    @foreach ($row['grades'] ?? [] as $subject)
                                                        @php
                                                            $remarks = strtolower($subject['remarks'] ?? '');
                                                            $badgeClass = match ($remarks) {
                                                                'passed'
                                                                    => 'text-green-600 bg-green-100 border-green-200 dark:bg-green-500/20 dark:border-green-500/20',
                                                                'failed'
                                                                    => 'text-red-600 bg-red-100 border-red-200 dark:bg-red-500/20 dark:border-red-500/20',
                                                                default
                                                                    => 'text-yellow-600 bg-yellow-100 border-yellow-200 dark:bg-yellow-500/20 dark:border-yellow-500/20',
                                                            };
                                                        @endphp

                                                        <tr>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['courseCode'] ?? '-' }} -
                                                                {{ $subject['courseTitle'] ?? '-' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['classSection'] ?? '-' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['lectureUnit'] ?? '0' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['labUnit'] ?? '0' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['unit'] ?? '0' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['final'] ?? '-' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                {{ $subject['reeExam'] ?? '-' }}
                                                            </td>
                                                            <td
                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                @if ($remarks)
                                                                    <span
                                                                        class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border {{ $badgeClass }}">
                                                                        {{ $subject['remarks'] }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @else
                                        <div style="text-align: center;">
                                            <h4><i>No data available</i></h4>
                                        </div>
                                    @endif
                                </div>
                                </p>
                            </div>
                            <div class="hidden tab-pane" id="blocksection">
                                <p class="mb-0">
                                <div class="overflow-x-auto">
                                    @if (!empty($blockSections))
                                        <table class="w-full">
                                            <thead class="ltr:text-left rtl:text-right">
                                                <tr>
                                                    <th
                                                        class="w-auto px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        SUBJECT</th>
                                                    <th
                                                        class="w-[250px] px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($blockSections as $section)
                                                    <tr>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <div class="grow">
                                                                    <span
                                                                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                                                        {{ $section['subjectCode'] }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <h6> {{ $section['subjectTitle'] }}</h6>
                                                        </td>
                                                        <td
                                                            class="w-[250px] px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            <button type="button"
                                                                class="py-1 text-xs px-1.5 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-custom-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20"
                                                                onclick="addSubjects({{ $section['subjectId'] }}, '{{ addslashes($section['subjectTitle']) }}')"><i
                                                                    class="ri-check-double-line"></i> Register</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3"
                                                            class="text-center px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            <h4><i>NO DATA AVAILABLE</i></h4>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    @else
                                        <div style="text-align: center;">
                                            <h4><i>No data available</i></h4>
                                        </div>
                                    @endif
                                </div>
                                </p>
                            </div>
                            <div class="hidden tab-pane" id="opensection">
                                <p class="mb-0">
                                <div class="overflow-x-auto">
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="subjectPerSectionList" name="subjectPerSectionList" data-choices
                                        data-choices-sorting-false
                                        onchange="selectSection(this.value, {{ $termId }}, {{ $tenantId }})">
                                        <option value="">-- Select Section --</option>

                                        @foreach ($sectionList as $section)
                                            <option value="{{ $section['sectionId'] }}"
                                                {{ $section['sectionId'] == $selectedclassSectionIdSession ? 'selected' : '' }}>
                                                {{ $section['sectionName'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if (!empty($fetchSectionSchedules))
                                        <table class="w-full">
                                            <thead class="ltr:text-left rtl:text-right">
                                                <tr>
                                                    <th
                                                        class="w-auto px-3.5 py-2.5 font-semibold border-b border-slate-200">
                                                        SUBJECT</th>
                                                    <th
                                                        class="w-[250px] px-3.5 py-2.5 font-semibold border-b border-slate-200">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($fetchSectionSchedules as $fetchSectionSchedule)
                                                    <tr>
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <div class="grow">
                                                                    <span
                                                                        class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500">
                                                                        {{ $fetchSectionSchedule['subjectCode'] }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <h6>{{ $fetchSectionSchedule['subjectTitle'] }}</h6>
                                                        </td>
                                                        <td class="w-[250px] px-3.5 py-2.5 border-y border-slate-200">
                                                            <button type="button"
                                                                class="py-1 text-xs px-1.5 text-white btn bg-green-500 border-green-500"
                                                                onclick="addSubjects({{ $fetchSectionSchedule['subjectId'] }}, '{{ addslashes($fetchSectionSchedule['subjectTitle']) }}')">
                                                                <i class="ri-check-double-line"></i> Register
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2"
                                                            class="text-center px-3.5 py-2.5 border-y border-slate-200">
                                                            <h4><i>No data available</i></h4>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    @else
                                        <div style="text-align: center;">
                                            <h4><i>No data available</i></h4>
                                        </div>
                                    @endif
                                    <br><br><br><br><br><br>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-->
            <!--end col-->
        </div>
        <div class="col-span-12 xl:col-span-6">
            <div class="sticky print:hidden top-[calc(theme('spacing.header')_+_theme('spacing.5'))]">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-1 text-15">Settings</h6>
                        <p class="mb-4 text-slate-500 dark:text-zink-200">Update your assessment details.</p>

                        <input type="hidden" id="trialProgramId" name="trialProgramId" value="{{ $trialProgramId }}">
                        <input type="hidden" id="tenantId" name="tenantId" value="{{ $tenantId }}">
                        <input type="hidden" id="studentNo" name="studentNo" value="{{ $studentNo }}">
                        <input type="hidden" id="policyId" name="policyId" value="{{ $policyId }}">

                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                            <div class="xl:col-span-4">
                                <label for="inputValue" class="inline-block mb-2 text-base font-medium">Academic
                                    Status</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="transactionType" name="transactionType" data-choices data-choices-sorting-false
                                    onchange="setTransactionType(this)">
                                    <option value="">-- Select Academic Status --</option>
                                    <option value="Regular"
                                        {{ $selectedtransactionType === 'Regular' ? 'selected' : '' }}>
                                        Regular</option>
                                    <option value="Irregular"
                                        {{ $selectedtransactionType === 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="inputValue" class="inline-block mb-2 text-base font-medium">Section</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="classSectionId" name="classSectionId" data-choices data-choices-sorting-false
                                    onchange="setClassSection(this.value, this.options[this.selectedIndex].text)">
                                    <option value="">-- Select Class Section --</option>
                                    @foreach ($classsections as $section)
                                        <option value="{{ $section['sectionId'] }}"
                                            {{ $section['sectionId'] == $selectedclassSectionId ? 'selected' : '' }}>
                                            {{ $section['sectionName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="inputValue" class="inline-block mb-2 text-base font-medium">Year Level</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="yearLevelId" name="yearLevelId" data-choices data-choices-sorting-false
                                    onchange="setYearLevel(this.value, this.options[this.selectedIndex].text)">
                                    <option value="">-- Select Year Level --</option>
                                    @foreach ($yearlevels as $yearlevel)
                                        <option value="{{ $yearlevel['yearLevelId'] }}"
                                            {{ $yearlevel['yearLevelId'] == $selectedyearLevelId ? 'selected' : '' }}>
                                            {{ $yearlevel['yearLevel'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-12">
                                <label for="inputValue" class="inline-block mb-2 text-base font-medium">Curriculum</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="curriculum" name="curriculum" data-choices data-choices-sorting-false
                                    onchange="setCurriculum(this.value, this.options[this.selectedIndex].text)">
                                    <option value="">-- Select Curriculum --</option>
                                    @foreach ($curriculumsByPolicies as $curriculum)
                                        <option value="{{ $curriculum['indexId'] }}"
                                            {{ $curriculum['indexId'] == $selectedCurriculumId ? 'selected' : '' }}>
                                            {{ $curriculum['curriculumCode'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="inputValue" class="inline-block mb-2 text-base font-medium">Table of
                                    Fee</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="tableOfFeeId" name="tableOfFeeId" data-choices data-choices-sorting-false
                                    onchange="setTableFee(this.value, this.options[this.selectedIndex].text)">
                                    <option value="">-- Select Table of Fees --</option>
                                    @foreach ($tableFees as $tableFee)
                                        <option value="{{ $tableFee['templateId'] }}"
                                            {{ $tableFee['templateId'] == $selectedtableOfFeeId ? 'selected' : '' }}>
                                            {{ $tableFee['templateCode'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label class="inline-block mb-2 text-base font-medium">Scholarship Provider</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="scholarshipProvider" name="scholarshipProvider" data-choices
                                    data-choices-sorting-false
                                    onchange="setScholarship(this.value, this.options[this.selectedIndex].text)">
                                    <option value="0">-- Select Provider --</option>
                                    @foreach ($scholarships as $scholarship)
                                        <option value="{{ $scholarship['schoProviderId'] }}"
                                            {{ $scholarship['schoProviderId'] == $selectedschoProviderId ? 'selected' : '' }}>
                                            {{ $scholarship['provName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Grant Template -->
                            <div class="xl:col-span-4">
                                <label class="inline-block mb-2 text-base font-medium">Grant Template</label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="grantTemplate" name="grantTemplate" data-choices data-choices-sorting-false
                                    onchange="setgrantTemplate(this.value, this.options[this.selectedIndex].text)">
                                    <option value="0">-- Select Grant Template --</option>
                                    @foreach ($grantTemplates as $grantTemplate)
                                        <option value="{{ $grantTemplate['grantTemplateId'] }}"
                                            {{ $grantTemplate['grantTemplateId'] == $selectedGrantTemplateId ? 'selected' : '' }}>
                                            {{ $grantTemplate['shortName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!--end grid-->


                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-1 text-15">Pre-Registered Subjects</h6>
                        <p class="mb-4 text-slate-500 dark:text-zink-200">Here are the subjects you selected.</p>
                        @if (!empty($preregisteredsubjects['details']))
                            <table class="table w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-3.5 py-2.5">#</th>
                                        <th class="px-3.5 py-2.5">Subject</th>
                                        <th class="px-3.5 py-2.5">Schedule</th>
                                        <th class="px-3.5 py-2.5"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counts = 1; @endphp
                                    @foreach ($preregisteredsubjects['details'] as $item)
                                        <tr>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                <h6 class="mb-1">#{{ $counts++ }}</h6>
                                            </td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                <h6 class="mb-1">{{ $item['subjectName'] ?? '' }}</h6>
                                                @if (!empty($item['sectionName']) || !empty($item['currentClassSize']) || !empty($item['classLimit']))
                                                    <div class="flex items-center gap-2">
                                                        <div class="grow">
                                                            @if (!empty($item['sectionName']))
                                                                <span
                                                                    class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                                                    {{ $item['sectionName'] }}
                                                                </span>
                                                            @endif

                                                            @if (!empty($item['currentClassSize']) || !empty($item['classLimit']))
                                                                <span
                                                                    class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">
                                                                    {{ $item['currentClassSize'] ?? '' }} /
                                                                    {{ $item['classLimit'] ?? '' }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                            </td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="flex items-center">
                                                    <div class="grid grid-cols-12 gap-2 grow">
                                                        @if (!empty($item['sched1']) || !empty($item['room1']))
                                                            <span
                                                                class="col-span-12 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                                                {{ $item['sched1'] ?? '' }} {{ $item['room1'] ?? '' }}
                                                            </span>
                                                        @endif
                                                        @if (!empty($item['sched2']) || !empty($item['room2']))
                                                            <span
                                                                class="col-span-12 delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">
                                                                {{ $item['sched2'] ?? '' }} {{ $item['room2'] ?? '' }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">

                                                <button data-modal-target="bottomModal" type="button"
                                                    class="py-1 text-xs px-1.5 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-custom-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 dark:ring-sky-400/20"
                                                    id="btnSchedule"
                                                    onclick="getSchedule({{ $item['subjectId'] }}, {{ $item['id'] }}, {{ $termId }}, {{ $campusId }}, {{ $item['trialProgramId'] }})">
                                                    <i class="ri-calendar-2-fill"></i>
                                                </button>

                                                <button type="button"
                                                    class="py-1 text-xs px-1.5 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-custom-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20"
                                                    id="btnDelete"
                                                    onclick="removeSubjects({{ $item['id'] }}, '{{ addslashes($item['subjectName']) }}')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="text-align: center;">
                                <h4><i>No subjects have been selected</i></h4>
                            </div>
                        @endif
                        <div class="flex justify-center gap-2 mt-4">
                            @if ($countSubjects > 0)
                                <button type="button"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10"
                                    id="btnEnroll"
                                    onclick="processEnrollment({{ $trialProgramId }},{{ $tenantId }})">
                                    Process Enrollment
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end grid-->
    </div>

    <div id="bottomModal" modal-bottom
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Schedules</h5>
                <button data-modal-close="bottomModal"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto" id="scheduleContent">

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/dataTables.2.2.2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.tailwindcss.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        const baseScheduleRoute =
            `{{ route('pao.schedules.get', ['subjectId' => '__SUBJECT__', 'termId' => '__TERM__']) }}`;

        function getSchedule(subjectId, id, termId, campusId, trialProgramId) {
            const url = baseScheduleRoute
                .replace('__SUBJECT__', subjectId)
                .replace('__TERM__', termId) + `?campusId=${campusId}`;

            const container = document.getElementById('scheduleContent');
            const modal = document.getElementById('bottomModal');

            if (!modal || !container) {
                console.error("Modal or content container not found.");
                return;
            }

            container.innerHTML = '<p class="text-gray-500">Loading schedule...</p>';

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    container.innerHTML = '';

                    if (!Array.isArray(data) || data.length === 0) {
                        container.innerHTML = '<p class="text-gray-500">No schedules found.</p>';
                        return;
                    }


                    data.forEach(schedule => {
                        const div = document.createElement('div');
                        div.className = 'p-3 border rounded bg-gray-50 dark:bg-zink-500 mb-2';

                        div.innerHTML = `
                        <div class="flex items-center gap-2 mb-1">
                            <div class="grow">
                                <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                    ${schedule.sectionName}
                                </span>
                                <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">
                                    ${schedule.classSize ?? 'N/A'} / ${schedule.limit ?? 'N/A'}
                                </span>
                            </div>
                        </div>

                        <div class="mt-2 overflow-x-auto">
                            <table class="w-full text-sm border border-gray-200 table-auto dark:border-zinc-700">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-zinc-600">
                                        <th class="px-2 py-1 text-left border-b dark:border-zinc-700">Room</th>
                                        <th class="px-2 py-1 text-left border-b dark:border-zinc-700">Day/Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-2 py-1 border-b dark:border-zinc-700">${schedule.room1 ?? 'N/A'}</td>
                                        <td class="px-2 py-1 border-b dark:border-zinc-700">${schedule.sched1 ?? 'N/A'}</td>
                                    </tr>
                                    ${schedule.sched2 ? `
                                                                                    <tr>
                                                                                        <td class="px-2 py-1 border-b dark:border-zinc-700">${schedule.room2 ?? 'N/A'}</td>
                                                                                        <td class="px-2 py-1 border-b dark:border-zinc-700">${schedule.sched2}</td>
                                                                                    </tr>
                                                                                    ` : ''}
                                </tbody>
                            </table>
                        </div>

                        <button type="button"
                            onclick="selectSchedule(${id},${trialProgramId},${schedule.scheduleId}, ${campusId})"
                            class="py-1 text-xs px-1.5 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 mt-2">
                            Select
                        </button>
                    `;

                        container.appendChild(div);
                    });

                    modal.classList.remove('hidden');
                })
                .catch(err => {
                    console.error(err);
                    container.innerHTML = '<p class="text-red-500">Failed to load schedule data.</p>';
                    modal.classList.remove('hidden');
                });
        }



        // Handle modal close
        document.querySelectorAll('[data-modal-close]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('bottomModal')?.classList.add('hidden');
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll("[data-tab-toggle]");
            const tabPanes = document.querySelectorAll(".tab-pane");
            const tabGroups = document.querySelectorAll(".nav-tabs > li");

            // Restore tab from localStorage
            const activeTab = localStorage.getItem("activeTab") || "blocksection";
            activateTab(activeTab);

            tabLinks.forEach(link => {
                link.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    activateTab(target);
                    localStorage.setItem("activeTab", target);
                });
            });

            function activateTab(targetId) {
                // Hide all tabs
                tabPanes.forEach(tab => tab.classList.add("hidden"));
                // Remove active class from all li
                tabGroups.forEach(group => group.classList.remove("active"));
                // Show target tab
                document.getElementById(targetId).classList.remove("hidden");
                // Add active to the clicked li
                document.querySelector(`[data-target='${targetId}']`).closest("li").classList.add("active");
            }
        });

        function selectSection(sectionId) {
            const csrfToken = '{{ csrf_token() }}';
            const apiUrl = `{{ route('pao.section.select', ['sectionId' => '__SECTION__']) }}`
                .replace('__SECTION__', sectionId);

            fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({}) // optional; no data needed
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        location.reload();
                    }
                })
                .catch(error => {
                    location.reload();
                });
        }


        function setTransactionType(selectElement) {
            const selectedValue = selectElement.value;
            const trialProgramId = document.getElementById('trialProgramId').value;

            const csrfToken = '{{ csrf_token() }}';

            const apiUrl = `{{ route('pao.transaction.type.update', ['id' => '__ID__']) }}`.replace('__ID__',
                trialProgramId);

            fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        transactionType: selectedValue
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        showAlert('Failed to update transaction type.', 'error');
                        throw new Error('Failed to update transaction type');
                    }
                    return response.json();
                })
                .then(data => {
                    showAlert('Transaction type updated successfully.', 'success');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while updating the transaction type.', 'error');
                });
        }


        function setClassSection(classSectionId, classSectionName) {
            const tenantId = document.getElementById('tenantId').value;
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                classSectionId: classSectionId,
                classSectionName: classSectionName,
                tenantId: tenantId,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.class.section.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        location.reload();
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the class section.', 'error');
                });
        }

        function setYearLevel(yearLevelId, yearLevelName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                yearLevelId: yearLevelId,
                yearLevelName: yearLevelName,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.year.level.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the year level.', 'error');
                });
        }

        function setCurriculum(curriculumId, curriculumName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                curriculumId: curriculumId,
                curriculumName: curriculumName,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.curriculum.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        location.reload();
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the curriculum.', 'error');
                });
        }

        function setTableFee(tableFeeId, tableFeeName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                tableFeeId: parseInt(tableFeeId),
                tableFeeName: tableFeeName,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.table.fee.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the table fee.', 'error');
                });
        }

        function addSubjects(subjectId, subjectTitle) {
            Swal.fire({
                title: 'Add Subject?',
                text: `Are you sure you want to add "${subjectTitle}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, add it',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const trialProgramId = document.getElementById('trialProgramId').value;
                    const data = {
                        subjectId: subjectId,
                        subjectTitle: subjectTitle,
                        trialProgramId: trialProgramId,
                        _token: "{{ csrf_token() }}"
                    };

                    fetch("{{ route('pao.subjects.add') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire('Added!', `Subject "${subjectTitle}" was added successfully.`,
                                        'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Warning', data.message, 'warning');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'An error occurred while adding the subject.', 'error');
                        });
                }
            });
        }


        function setScholarship(scholarshipId, scholarshipName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                scholarshipId: scholarshipId,
                scholarshipName: scholarshipName,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.scholarship.provider.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        location.reload();
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the scholarship.', 'error');
                });
        }

        function setgrantTemplate(grantTemplateId, grantTemplateName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            const data = {
                grantTemplateId: grantTemplateId,
                grantTemplateName: grantTemplateName,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('pao.grant.template.update', ['id' => ':id']) }}".replace(':id', trialProgramId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        location.reload();
                    } else {
                        showAlert(data.message, 'warning');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred while updating the grant template.', 'error');
                });
        }


        function removeSubjects(subjectId, subjectName) {
            const trialProgramId = document.getElementById('trialProgramId').value;

            Swal.fire({
                title: 'Are you sure?',
                text: `You want to remove ${subjectName} from the list.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                customClass: {
                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ltr:mr-1 rtl:ml-1',
                    cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20',
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('pao.subjects.remove') }}", {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                subjectDetailId: subjectId,
                                trialProgramId: trialProgramId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                showAlert(`Subject ${subjectName} removed successfully.`, 'success');
                                location.reload();
                            } else {
                                showAlert(data.message || 'Failed to remove subject.', 'warning');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('An error occurred while removing the subject.', 'error');
                        });
                }
            });
        }

        function selectSchedule(subjectDetailId, trialProgramId, scheduleId, campusId) {
            const data = {
                subjectDetailId: subjectDetailId,
                trialProgramId: trialProgramId,
                scheduleId: scheduleId,
                campusId: campusId,
                _token: "{{ csrf_token() }}"
            };
            fetch("{{ route('pao.class.schedules.update', ['id' => ':id']) }}".replace(':id', subjectDetailId), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(`Schedule selected successfully.`, 'success');
                        location.reload();
                    } else {
                        showAlert(data.message || 'Failed to select schedule.', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while selecting the schedule.', 'error');
                });
        }


        function processEnrollment(trialProgramId, tenantId) {
            const studentNo = document.getElementById('studentNo').value;
            const policyId = document.getElementById('policyId').value;

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to proceed with the enrollment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = {
                        trialProgramId: trialProgramId,
                        studentNo: studentNo,
                        tenantId: tenantId,
                        policyId: policyId,
                        _token: "{{ csrf_token() }}"
                    };

                    fetch("{{ route('pao.enrollment.process', ['id' => '__ID__']) }}".replace('__ID__',
                            trialProgramId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                showAlert(`Enrollment processed successfully.`, 'success');
                                const route = "{{ route('pao.sar.students.list', ['id' => '__ID__']) }}"
                                    .replace('__ID__', data.policyId);
                                window.location.href = route;
                            } else {
                                showAlert(data.message || 'Failed to process enrollment.', 'warning');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('An error occurred while processing the enrollment.', 'error');
                        });
                }
            });
        }



        function showAlert(message, type = 'info') {
            let title = '';
            switch (type) {
                case 'success':
                    title = 'Success!';
                    break;
                case 'error':
                    title = 'Error!';
                    break;
                case 'warning':
                    title = 'Warning!';
                    break;
                default:
                    title = 'Notice';
                    break;
            }

            Swal.fire({
                title: title,
                text: message,
                icon: type,
                customClass: {
                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                },
                buttonsStyling: false
            });
        }
    </script>
@endpush
