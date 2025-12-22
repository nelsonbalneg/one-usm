@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Educational Background
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - STUDENT PROFILE FORM </h5>
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
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Applicant Profile</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Personal Information</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Parent and Guardian Information</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Educational Background
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
            <div class="xl:col-span-12">
                <form id="studentProfileForm" action="{{ route('admin.applicant-profile.step3.save') }}" method="POST">
                    @csrf
                    {{-- Success & Error Alert Notifications --}}
                    @php
                        $alertTypes = [
                            'success' => ['color' => 'green', 'message' => session('success')],
                            'error' => [
                                'color' => 'red',
                                'message' => $errors->any()
                                    ? 'You should check in on some of those fields below.'
                                    : null,
                            ],
                        ];
                    @endphp

                    @foreach ($alertTypes as $type => $alert)
                        @if ($alert['message'])
                            <div
                                class="flex gap-1 px-4 py-3 mb-2 text-sm text-{{ $alert['color'] }}-500 border border-{{ $alert['color'] }}-200 rounded-md md:items-center bg-{{ $alert['color'] }}-50 dark:bg-{{ $alert['color'] }}-400/20 dark:border-{{ $alert['color'] }}-500/50">
                                <i data-lucide="alert-circle" class="h-4"></i>
                                <div>
                                    <span class="font-bold">{{ ucfirst($type) }}!</span> {{ $alert['message'] }}
                                    @if ($type === 'error')
                                        <ul class="mt-1 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="card">
                        <div class="card-body">

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                                <div class="mt-2 xl:col-span-12">
                                    <h6 class="mb-1 text-blue-500 uppercase text-15"><i data-lucide="school"
                                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> EDUCATIONAL
                                        BACKGROUND
                                    </h6>
                                </div>


                                <div class="xl:col-span-12">
                                    <h6 class="text-green-500 uppercase text-15 ">Elementary Education</h6>
                                    <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.</p>
                                </div>


                                {{-- Elementary --}}
                                <input type="hidden" name="user_id" value="{{ $applicant->id }}">
                                <input type="hidden" name="applicant_prof_id" value="{{ $applicant->id }}">

                                <div class="xl:col-span-4">
                                    <label for="elem_school" class="inline-block mb-2 text-base font-medium">Elementary
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_school', $applicant->elem_school ?? '') }}"
                                        placeholder="Enter name of elementary school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="elem_address" class="inline-block mb-2 text-base font-medium">Elementary
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_address', $applicant->elem_address ?? '') }}"
                                        placeholder="Enter name of elementary address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="elem_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_incldates', $applicant->elem_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="elem_award_honor" class="inline-block mb-2 text-base font-medium">Elementary
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="elem_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_award_honor', $applicant->elem_award_honor ?? '') }}"
                                        placeholder="Enter name of elementary awards and/or honor">
                                </div><!--end col-->
                                {{-- end Elementary --}}

                                {{-- High school --}}

                                <div class="xl:col-span-12">
                                    <h6 class="mt-4 text-green-500 uppercase text-15">Secondary Education</h6>
                                    <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.</p>
                                </div>
                                <div class="xl:col-span-4">
                                    <label for="hs_school" class="inline-block mb-2 text-base font-medium">High School
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_school', $applicant->hs_school ?? '') }}"
                                        placeholder="Enter name of high school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="hs_address" class="inline-block mb-2 text-base font-medium">High School
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_address', $applicant->hs_address ?? '') }}"
                                        placeholder="Enter name of high school address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="hs_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_incldates', $applicant->hs_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="hs_award_honor" class="inline-block mb-2 text-base font-medium">High
                                        School
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="hs_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_award_honor', $applicant->hs_award_honor ?? '') }}"
                                        placeholder="Enter name of high school awards and/or honor">
                                </div><!--end col-->
                                {{-- End JHS --}}

                                {{-- Senior High school --}}
                                <div class="xl:col-span-4">
                                    <label for="shs_school" class="inline-block mb-2 text-base font-medium">Senior High
                                        School
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_school', $applicant->shs_school ?? '') }}"
                                        placeholder="Enter name of senior high school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_address" class="inline-block mb-2 text-base font-medium">Senior High
                                        School
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_address', $applicant->shs_address ?? '') }}"
                                        placeholder="Enter name of senior high school address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_incldates', $applicant->shs_incldates ?? '') }}"
                                        placeholder="Enter inclusive date (e.g. June 11, 2023 - April 12, 2025)">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="shs_award_honor" class="inline-block mb-2 text-base font-medium">Senior
                                        High
                                        School
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="shs_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_award_honor', $applicant->shs_award_honor ?? '') }}"
                                        placeholder="Enter name of senior high school awards and/or honor">
                                </div><!--end col-->
                                {{-- end Senior High school --}}

                                {{-- Vocational school --}}
                                <div class="xl:col-span-12">
                                    <h6 class="mt-4 text-green-500 uppercase text-15">Vocational/Trade Course</h6>
                                        <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.
                                        </p>
                                </div>

                                </h6>
                                <div class="xl:col-span-4">
                                    <label for="vocational" class="inline-block mb-2 text-base font-medium">Vocational
                                        School
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational', $applicant->vocational ?? '') }}"
                                        placeholder="Enter name of vocational school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="vocational_address"
                                        class="inline-block mb-2 text-base font-medium">Vocational
                                        School
                                        Address <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_address', $applicant->vocational_address ?? '') }}"
                                        placeholder="Enter name of vocational school address">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="vocational_degree"
                                        class="inline-block mb-2 text-base font-medium">Vocational
                                        Degree
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_degree"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_degree', $applicant->vocational_degree ?? '') }}"
                                        placeholder="Enter name of vocational degree">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="vocational_incldates"
                                        class="inline-block mb-2 text-base font-medium">Inclusive Dates
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_incldates', $applicant->vocational_incldates ?? '') }}"
                                        placeholder="Enter inclusive date (e.g. June 11, 2023 - April 12, 2025)">
                                </div><!--end col-->

                                {{-- ends Vocational school --}}

                                {{-- College school --}}
                                <div class="xl:col-span-12">
                                    <h6 class="mt-4 text-green-500 uppercase text-15">College</h6>
                                    <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.</p>
                                </div>
                                <div class="xl:col-span-4">
                                    <label for="college_school"
                                        class="inline-block mb-2 text-base font-medium">College/University
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="college_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_school', $applicant->college_school ?? '') }}"
                                        placeholder="Enter name of college last attended" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="college_address"
                                        class="inline-block mb-2 text-base font-medium">College/University
                                        Address <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="college_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_address', $applicant->college_address ?? '') }}"
                                        placeholder="Enter name of college/university school address">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="college_degree" class="inline-block mb-2 text-base font-medium">College
                                        Degree
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="college_degree"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_degree', $applicant->college_degree ?? '') }}"
                                        placeholder="Enter name of college degree">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="college_incldates"
                                        class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="college_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_incldates', $applicant->college_incldates ?? '') }}"
                                        placeholder="Enter inclusive date (e.g. June 11, 2023 - April 12, 2025)">
                                </div><!--end col-->

                                {{-- end College school --}}

                            </div>

                            <div class="flex justify-between mt-4">
                                @if (
                                    $applicant->applicant_profile_status == 0 ||
                                        empty($applicant->applicant_profile_status) ||
                                        is_null(value: $applicant->applicant_profile_status))
                                    <button type="submit"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        Next Step <i data-lucide="arrow-right"
                                            class="inline-block size-4 dark:text-zink-200"></i>
                                    </button>
                                @else
                                    <a href="{{ route('admin.applicant-profile.step4.show', ['id' => $applicant->id]) }}"
                                        class="flex items-center gap-1 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        Next<i data-lucide="arrow-right"
                                            class="inline-block size-4 dark:text-zink-200"></i>
                                    </a>
                                @endif

                                <a href="{{ route('admin.applicant-profile.step2.show',['id' => $applicant->id]) }}"
                                    class="flex items-center gap-1 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-green-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                    <i data-lucide="arrow-left" class="inline-block size-4 dark:text-zink-200"></i>
                                    Previous
                                </a>
                            </div>

                        </div>
                        {{-- end card-body --}}
                    </div>

                </form>
            </div>
    </div>

    @endsection
