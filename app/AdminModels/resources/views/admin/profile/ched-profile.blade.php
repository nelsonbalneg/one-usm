@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - CHED Detailed Profile
@endsection


@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USMCEE CHED Detailed Profile </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">User</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                CHED Profile
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        {{-- @if (!empty($app_no)) --}}
            <div class="xl:col-span-12">
                <form action="{{ route('admin.cee.ched-profile.store') }}" id="applicant-form" method="POST">
                    @csrf

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

                    {{-- Start Personal Information --}}
                    <div class="card">

                        <div class="card-body">

                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="user"
                                    class="inline-block text-blue-500 uppercase size-4 dark:text-zink-200"></i>
                                PERSONAL INFORMATION OF {{ $cee_profile->lastname }}, {{ $cee_profile->firstname }}
                                {{ $cee_profile->middlename }} {{ $cee_profile->suffix }}
                            </h6>

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                <input type="hidden" name="app_no" value="{{ $app_no?->app_no }}">
                                <input type="hidden" name="user_id" value="{{ $cee_profile->id }}">
                                <input type="hidden" name="lrn" value="{{ $cee_profile->lrn }}">
                                <input type="hidden" name="first_name" value="{{ $cee_profile->firstname }}">
                                <input type="hidden" name="middle_name" value="{{ $cee_profile->middlename }}">
                                <input type="hidden" name="last_name" value="{{ $cee_profile->lastname }}">
                                <input type="hidden" name="suffix" value="{{ $cee_profile->suffix }}">
                                <input type="hidden" name="email" value="{{ $cee_profile->email }}">
                                <input type="hidden" name="phone" value="{{ $cee_profile->phone }}">
                                <input type="hidden" name="photo" value="{{ $cee_profile->photo }}">
                                <input type="hidden" name="sex" value="{{ $cee_profile->sex }}">
                                <input type="hidden" name="birthdate" value="{{ $cee_profile->birthdate }}">

                                <div class="xl:col-span-6">
                                    <label for="student_category" class="inline-block mb-2 text-base font-medium">Student
                                        Category
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="student_category" id="student_category" data-choices
                                        data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="0" {{ $applicant->student_category == '0' ? 'selected' : '' }}>New Student</option>
                                        <option value="1" {{ $applicant->student_category == '1' ? 'selected' : '' }}>Old Student</option>
                                    </select>
                                </div><!--end col-->

                                <div class="hidden xl:col-span-6" id="student_category_new_type">
                                    <label for="student_category_new_type"
                                        class="inline-block mb-2 text-base font-medium">Student Type
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="student_category_new_type" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="Senior HS Graduate"
                                            {{ $applicant->student_category_new_type == 'Senior HS Graduate' ? 'selected' : '' }}>
                                            Senior HS Graduate</option>
                                        <option value="High School Graduate (Old Curriculum)"
                                            {{ $applicant->student_category_new_type == 'High School Graduate (Old Curriculum)' ? 'selected' : '' }}>
                                            High School Graduate (Old
                                            Curriculum)</option>
                                        <option
                                            value="Alternative Delivery Mode (Home School, IMPACT, MISOSA, Night High School, Open High School)"
                                            {{ $applicant->student_category_new_type == 'Alternative Delivery Mode (Home School, IMPACT, MISOSA, Night High School, Open High School)' ? 'selected' : '' }}>
                                            Alternative Delivery Mode (Home School, IMPACT, MISOSA, Night High School, Open
                                            High School)</option>
                                        <option value="Alternative Learning System (ALS) Passer"
                                            {{ $applicant->student_category_new_type == 'Alternative Learning System (ALS) Passer' ? 'selected' : '' }}>
                                            Alternative Learning System
                                            (ALS) Passer</option>
                                        <option value="Transferee"
                                            {{ $applicant->student_category_new_type == 'Transferee' ? 'selected' : '' }}>
                                            Transferee</option>
                                        <option value="Second Courser (Completed Degree in other school)"
                                            {{ $applicant->student_category_new_type == 'Second Courser (Completed Degree in other school)' ? 'selected' : '' }}>
                                            Second Courser
                                            (Completed Degree in other school)</option>
                                    </select>
                                </div><!--end col-->

                                <div class="hidden xl:col-span-6" id="student_category_old_type">
                                    <label for="student_category_old_type"
                                        class="inline-block mb-2 text-base font-medium">Student Type
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="student_category_old_type" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="Shifter"
                                            {{ $applicant->student_category_old_type == 'Shifter' ? 'selected' : '' }}>
                                            Shifter</option>
                                        <option value="Returnee"
                                            {{ $applicant->student_category_old_type == 'Returnee' ? 'selected' : '' }}>
                                            Returnee</option>
                                        <option value="Second Courser (Completed Degree in the same school)"
                                            {{ $applicant->student_category_old_type == 'Second Courser (Completed Degree in the same school)' ? 'selected' : '' }}>
                                            Second Courser
                                            (Completed Degree in the same school)</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="house_hould_no" class="inline-block mb-2 text-base font-medium">Household
                                        Number<sup class="text-red-500">* Required</sup></label>
                                    <input type="text" name="house_hould_no"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('house_hould_no', $applicant->house_hould_no ?? '') }}"
                                        placeholder="Enter Household Number" required>
                                </div><!--end col-->

                                {{-- readonly --}}
                                <div class="xl:col-span-3">
                                    <label for="region" class="inline-block mb-2 text-base font-medium">Household
                                        Number<sup class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="region"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('region', $cee_profile->region ?? '') }}" readonly>
                                </div><!--end col-->


                                <div class="xl:col-span-3">
                                    <label for="province" class="inline-block mb-2 text-base font-medium">Province<sup
                                            class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="province"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('province', $cee_profile->province ?? '') }}" readonly>
                                </div><!--end col-->


                                <div class="xl:col-span-3">
                                    <label for="city"
                                        class="inline-block mb-2 text-base font-medium">Municapality/Town<sup
                                            class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="city"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('city', $cee_profile->city ?? '') }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="brgy" class="inline-block mb-2 text-base font-medium">Barangay<sup
                                            class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="brgy"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('brgy', $cee_profile->brgy ?? '') }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="street" class="inline-block mb-2 text-base font-medium">Street<sup
                                            class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="street"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('street', $cee_profile->street ?? '') }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="zipcode" class="inline-block mb-2 text-base font-medium">Zip Code<sup
                                            class="text-blue-500">* Readonly</sup></label>
                                    <input type="text" name="zipcode"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('zipcode', $cee_profile->zipcode ?? '') }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="birthplace" class="inline-block mb-2 text-base font-medium">Birth
                                        Place<sup class="text-red-500">* Required</sup></label>
                                    <input type="text" name="birthplace"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('birthplace', $applicant->birthplace ?? '') }}" required
                                        placeholder="Enter Birth Place">
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="religion" class="inline-block mb-2 text-base font-medium">Religion <sup
                                            class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="religion" data-choices data-choices-search-false>
                                        <option value="">Select Religion</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion['religionId'] }}"
                                                {{ isset($applicant) && $applicant->religion == $religion['religionId'] ? 'selected' : '' }}>
                                                {{ $religion['religion'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="citizenship"
                                        class="inline-block mb-2 text-base font-medium">Citizenship<sup
                                            class="text-red-500">*
                                            required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="citizenship" data-choices data-choices-search-false>
                                        <option value="">Select Citizenship</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality['nationality'] }}"
                                                {{ isset($applicant) && $applicant->citizenship == $nationality['nationality'] ? 'selected' : '' }}>
                                                {{ $nationality['nationality'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="civil_status" class="inline-block mb-2 text-base font-medium">
                                        Civil Status
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="civil_status" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->civil_status == '1' ? 'selected' : '' }}>
                                            Single</option>
                                        <option value="2" {{ $applicant->civil_status == '2' ? 'selected' : '' }}>
                                            Married</option>
                                        <option value="3" {{ $applicant->civil_status == '3' ? 'selected' : '' }}>
                                            Live-in Relationship</option>
                                        <option value="4" {{ $applicant->civil_status == '4' ? 'selected' : '' }}>
                                            Widowed</option>
                                        <option value="5" {{ $applicant->civil_status == '5' ? 'selected' : '' }}>
                                            Separated</option>
                                        <option value="0" {{ $applicant->civil_status == '0' ? 'selected' : '' }}>
                                            Others..</option>
                                    </select>
                                </div><!--end col-->

                                {{-- <div class="hidden xl:col-span-3" id="civil_status_others_id">
                                <label for="others_civil_status" class="inline-block mb-2 text-base font-medium">
                                    Please specify your civil Status<sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="others_civil_status"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('others_civil_status', $applicant->civil_status_others ?? '') }}"
                                    placeholder="Please specify your Civil Status">
                            </div><!--end col--> --}}

                                <div class="xl:col-span-6">
                                    <label for="first_generation_student"
                                        class="inline-block mb-2 text-base font-medium">Are
                                        you
                                        the first in your immediate family to attend college?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="first_generation_student" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ $applicant->first_generation_student == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ $applicant->first_generation_student == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div><!--end col-->

                                {{-- other information --}}
                                <div class="mt-5 xl:col-span-12">
                                    <h6 class="mb-2 text-blue-500 uppercase text-15"><i data-lucide="notebook-tabs"
                                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> OTHER
                                        INFORMATION
                                    </h6>
                                </div>
                                {{-- end of other information --}}

                                {{-- 4ps --}}
                                <div class="xl:col-span-3" id="is_4ps_beneficiary">
                                    <label for="is_4ps_beneficiary" class="inline-block mb-2 text-base font-medium">
                                        Are you a 4Ps Beneficiary?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_4ps_beneficiary" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ $applicant->is_4ps_beneficiary == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ $applicant->is_4ps_beneficiary == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="is_4ps_beneficiary_id" class="inline-block mb-2 text-base font-medium">
                                        4Ps Id Number</label>
                                    <input type="text" name="is_4ps_beneficiary_id" id="is_4ps_beneficiary_id"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('is_4ps_beneficiary_id', $applicant->is_4ps_beneficiary_id ?? '') }}"
                                        placeholder="Enter 4Ps Id Number" disabled>
                                </div><!--end col-->
                                {{-- end of 4ps --}}

                                {{-- Solo Parent --}}
                                <div class="xl:col-span-3" id="is_solo_parent">
                                    <label for="is_solo_parent" class="inline-block mb-2 text-base font-medium">
                                        Are you a solo parent?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_solo_parent" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_solo_parent == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0" {{ $applicant->is_solo_parent == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="is_solo_parent_id" class="inline-block mb-2 text-base font-medium">
                                        Solo Parent Id Number</label>
                                    <input type="text" name="is_solo_parent_id" id="is_solo_parent_id"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('is_solo_parent_id', $applicant->is_solo_parent_id ?? '') }}"
                                        placeholder="Enter Solo Parent Id Number" disabled>
                                </div><!--end col-->
                                {{-- End of Solo Parent --}}


                                {{-- Raised by Solo Parent --}}
                                <div class="xl:col-span-3">
                                    <label for="is_raised_by_solo_parent" class="inline-block mb-2 text-base font-medium">
                                        Are you raised by a solo parent?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_raised_by_solo_parent" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ $applicant->is_raised_by_solo_parent == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ $applicant->is_raised_by_solo_parent == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div><!--end col-->
                                {{-- End of Solo Parent --}}

                                {{-- Start PWD --}}
                                <div class="xl:col-span-3" id="is_pwd">
                                    <label for="is_pwd" class="inline-block mb-2 text-base font-medium">
                                        Are you a PWD?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_pwd" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_pwd == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $applicant->is_pwd == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="is_pwd_desc" class="inline-block mb-2 text-base font-medium">
                                        Please specify your disability</label>
                                    <input type="text" name="is_pwd_desc" id="is_pwd_desc"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('is_pwd_desc', $applicant->is_pwd_desc ?? '') }}"
                                        placeholder="Please specify your disability" disabled>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="is_pwd_id" class="inline-block mb-2 text-base font-medium">
                                        PWD Id Number</label>
                                    <input type="text" name="is_pwd_id" id="is_pwd_id"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('is_pwd_id', $applicant->is_pwd_id ?? '') }}"
                                        placeholder="Enter PWD Id Number" disabled>


                                </div>
                                {{-- End PWD --}}

                                {{-- Living in a Geographically Isolated and Disadvantaged Area (GIDA --}}
                                <div class="xl:col-span-3" id="is_gida">
                                    <label for="is_gida" class="inline-block mb-2 text-base font-medium">
                                        Are you Living in a Geographically Isolated and Disadvantaged Area (GIDA)?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_gida" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_gida == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $applicant->is_gida == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="desc_is_gida" class="inline-block mb-2 text-base font-medium">
                                        Please specify</label>
                                    <input type="text" name="desc_is_gida" id="is_gida_desc"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('desc_is_gida', $applicant->is_gida_desc ?? '') }}"
                                        placeholder="Please specify" disabled>
                                </div><!--end col-->
                                {{-- End of Living in a Geographically Isolated and Disadvantaged Area (GIDA --}}


                                {{-- Member of the indigenous people (IP)  --}}
                                <div class="xl:col-span-3" id="is_ip">
                                    <label for="is_ip" class="inline-block mb-2 text-base font-medium">
                                        Are you a Member of the indigenous people (IP)
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_ip" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_ip == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $applicant->is_ip == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="is_ip_type" class="inline-block mb-2 text-base font-medium">
                                        Please specify your IP community</label>
                                    <input type="text" name="is_ip_type" id="is_ip_type"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('is_ip_type', $applicant->is_ip_type ?? '') }}"
                                        placeholder="Please specify your IP community" disabled>
                                </div><!--end col-->
                                {{-- End ofMember of the indigenous people (IP)  --}}

                                {{-- Are you Belong to a family of subsistence farmers or fisherfolks  --}}
                                <div class="xl:col-span-3">
                                    <label for="is_belong_to_farmer" class="inline-block mb-2 text-base font-medium">
                                        Do you belong to a family of subsistence farmers or fisherfolks?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_belong_to_farmer" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ $applicant->is_belong_to_farmer == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ $applicant->is_belong_to_farmer == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->
                                {{-- End ofMember of the indigenous people (IP)  --}}

                                {{-- Belong to a family of rebel returnees  --}}
                                <div class="xl:col-span-3">
                                    <label for="is_rebel_returnee" class="inline-block mb-2 text-base font-medium">
                                        Are you Belong to a family of rebel returnees?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_rebel_returnee" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ $applicant->is_rebel_returnee == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ $applicant->is_rebel_returnee == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->
                                {{-- End of Belong to a family of rebel returnees  --}}

                            </div>

                        </div>
                        {{-- End Personal Information --}}

                    </div>


                    {{-- Family Background --}}
                    <div class="card">

                        <div class="card-body">

                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="contact"
                                    class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> FAMILY BACKGROUND
                            </h6>

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                {{-- Father Information --}}
                                <div class="xl:col-span-4">
                                    <label for="father_name" class="inline-block mb-2 text-base font-medium">
                                        Father's Full Name</label>
                                    <input type="text" name="father_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_name', $applicant->father_name ?? '') }}"
                                        placeholder="Enter your Father's Full Name" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_age" class="inline-block mb-2 text-base font-medium">
                                        Father's Age</label>
                                    <input type="text" name="father_age"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_age', $applicant->father_age ?? '') }}"
                                        placeholder="Enter your Father's Age" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_citizenship"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Citizenship<sup class="text-red-500">*
                                            required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="father_citizenship" data-choices data-choices-search-false>
                                        <option value="">Select Citizenship</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality['nationality'] }}"
                                                {{ isset($applicant) && $applicant->father_citizenship == $nationality['nationality'] ? 'selected' : '' }}>
                                                {{ $nationality['nationality'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="father_highest_educational_attainment"
                                        class="inline-block mb-2 text-base font-medium">What is your Fathers's Highest
                                        Educational Attainment?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="father_highest_educational_attainment" data-choices
                                        data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="0"
                                            {{ $applicant->father_highest_educational_attainment == '0' ? 'selected' : '' }}>
                                            No formal Education</option>
                                        <option value="1"
                                            {{ $applicant->father_highest_educational_attainment == '1' ? 'selected' : '' }}>
                                            Elementary Level</option>
                                        <option value="2"
                                            {{ $applicant->father_highest_educational_attainment == '2' ? 'selected' : '' }}>
                                            Elementary Graduate</option>
                                        <option value="3"
                                            {{ $applicant->father_highest_educational_attainment == '3' ? 'selected' : '' }}>
                                            High School Level</option>
                                        <option value="4"
                                            {{ $applicant->father_highest_educational_attainment == '4' ? 'selected' : '' }}>
                                            High School Graduate</option>
                                        <option value="5"
                                            {{ $applicant->father_highest_educational_attainment == '5' ? 'selected' : '' }}>
                                            College Level</option>
                                        <option value="6"
                                            {{ $applicant->father_highest_educational_attainment == '6' ? 'selected' : '' }}>
                                            College Graduate</option>
                                        <option value="7"
                                            {{ $applicant->father_highest_educational_attainment == '7' ? 'selected' : '' }}>
                                            Others</option>
                                    </select>
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="father_employment_status"
                                        class="inline-block mb-2 text-base font-medium">What
                                        is your Fathers's Employment
                                        Status?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="father_employment_status" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="0"
                                            {{ $applicant->father_employment_status == '0' ? 'selected' : '' }}>
                                            Unemployed, but is not seeking for employment</option>
                                        <option value="1"
                                            {{ $applicant->father_employment_status == '1' ? 'selected' : '' }}>
                                            Unemployed, but is actively seeking for employment</option>
                                        <option value="2"
                                            {{ $applicant->father_employment_status == '2' ? 'selected' : '' }}>
                                            Self-Employed</option>
                                        <option value="3"
                                            {{ $applicant->father_employment_status == '3' ? 'selected' : '' }}>
                                            Employed - Government</option>
                                        <option value="4"
                                            {{ $applicant->father_employment_status == '4' ? 'selected' : '' }}>
                                            Employed - Private</option>
                                        <option value="5"
                                            {{ $applicant->father_employment_status == '5' ? 'selected' : '' }}>
                                            Not Applicable</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_occupation" class="inline-block mb-2 text-base font-medium">What is
                                        your Father's Occupation?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="father_occupation" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="Armed Forces Occupations"
                                            {{ $applicant->father_occupation == 'Armed Forces Occupations' ? 'selected' : '' }}>
                                            Armed Forces Occupations (Military, Airforce, Navy, and Other Military Services)
                                        </option>
                                        <option value="Managers"
                                            {{ $applicant->father_occupation == 'Managers' ? 'selected' : '' }}>
                                            Managers (Chief Executives, Senior Officials and Legislators, Production and
                                            Specialized Services Managers, Hospitality, Retail and Other Services Managers)
                                        </option>
                                        <option value="Professionals"
                                            {{ $applicant->father_occupation == 'Professionals' ? 'selected' : '' }}>
                                            ⎯ Science and Engineering Professionals (physical and earth science
                                            professionals, mathematicians, actuaries and statisticians, life science
                                            professionals, engineering professionals, architects, planners, surveyors and
                                            designers)
                                            ⎯ Health Professionals (medical doctor, dentist, pharmacist, nurse, midwife,
                                            traditional and complementary medicine professionals, paramedical practitioners,
                                            veterinarians, others)
                                            ⎯ Teaching Professionals (higher education, vocational, secondary, elementary,
                                            early childhood, SPED, others)
                                            ⎯ Business and Administration Professionals (finance, administration, and sales,
                                            marketing and public relations)
                                            ⎯ Information and Communication Technology Professionals (software and
                                            applications developer and analyst, database and network professionals)
                                            ⎯ Legal, Social, and Cultural Professionals (legal; librarians, archivist, and
                                            curators; social and religious professionals; authors, journalists, and
                                            linguists; and creative and performing artists)
                                        </option>
                                        <option value="TECHNICIANS AND ASSOCIATE PROFESSIONALS"
                                            {{ $applicant->father_occupation == 'TECHNICIANS AND ASSOCIATE PROFESSIONALS' ? 'selected' : '' }}>
                                            TECHNICIANS AND ASSOCIATE PROFESSIONALS
                                        </option>
                                        <option value="CLERICAL SUPPORT WORKERS"
                                            {{ $applicant->father_occupation == 'CLERICAL SUPPORT WORKERS' ? 'selected' : '' }}>
                                            CLERICAL SUPPORT WORKERS
                                        </option>
                                        <option value="SERVICE AND SALES WORKERS"
                                            {{ $applicant->father_occupation == 'SERVICE AND SALES WORKERS' ? 'selected' : '' }}>
                                            SERVICE AND SALES WORKERS
                                        </option>
                                        <option value="SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS"
                                            {{ $applicant->father_occupation == 'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS' ? 'selected' : '' }}>
                                            SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS
                                        </option>
                                        <option value="CRAFT AND RELATED TRADES WORKERS"
                                            {{ $applicant->father_occupation == 'CRAFT AND RELATED TRADES WORKERS' ? 'selected' : '' }}>
                                            CRAFT AND RELATED TRADES WORKERS
                                        </option>
                                        <option value="PLANT AND MACHINE OPERATORS, AND ASSEMBLERS"
                                            {{ $applicant->father_occupation == 'PLANT AND MACHINE OPERATORS, AND ASSEMBLERS' ? 'selected' : '' }}>
                                            PLANT AND MACHINE OPERATORS, AND ASSEMBLERS
                                        </option>
                                        <option value="ELEMENTARY OCCUPATIONS"
                                            {{ $applicant->father_occupation == 'ELEMENTARY OCCUPATIONS' ? 'selected' : '' }}>
                                            ELEMENTARY OCCUPATIONS (cleaners, helpers, laborers, and assistants)
                                        </option>
                                        <option
                                            value="Not Applicable"{{ $applicant->mother_occupation == 'Not Applicable' ? 'selected' : '' }}>
                                            Not Applicable</option>
                                    </select>
                                </div><!--end col-->

                                {{-- end of Father information --}}


                                {{-- Mother Information --}}
                                <div class="xl:col-span-4">
                                    <label for="mother_name" class="inline-block mb-2 text-base font-medium">
                                        Mother's Full Name</label>
                                    <input type="text" name="mother_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_name', $applicant->mother_name ?? '') }}"
                                        placeholder="Enter your Mother's Full Name" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_age" class="inline-block mb-2 text-base font-medium">
                                        Mother's Age</label>
                                    <input type="text" name="mother_age"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_age', $applicant->mother_age ?? '') }}"
                                        placeholder="Enter your Mother's Age" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_citizenship"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Citizenship<sup class="text-red-500">*
                                            required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="mother_citizenship" data-choices data-choices-search-false>
                                        <option value="">Select Citizenship</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality['nationality'] }}"
                                                {{ isset($applicant) && $applicant->mother_citizenship == $nationality['nationality'] ? 'selected' : '' }}>
                                                {{ $nationality['nationality'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="mother_highest_educational_attainment"
                                        class="inline-block mb-2 text-base font-medium">What is your Mother's Highest
                                        Educational Attainment?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="mother_highest_educational_attainment" data-choices
                                        data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="0"
                                            {{ $applicant->mother_highest_educational_attainment == '0' ? 'selected' : '' }}>
                                            No formal Education</option>
                                        <option value="1"
                                            {{ $applicant->mother_highest_educational_attainment == '1' ? 'selected' : '' }}>
                                            Elementary Level</option>
                                        <option value="2"
                                            {{ $applicant->mother_highest_educational_attainment == '2' ? 'selected' : '' }}>
                                            Elementary Graduate</option>
                                        <option value="3"
                                            {{ $applicant->mother_highest_educational_attainment == '3' ? 'selected' : '' }}>
                                            High School Level</option>
                                        <option value="4"
                                            {{ $applicant->mother_highest_educational_attainment == '4' ? 'selected' : '' }}>
                                            High School Graduate</option>
                                        <option value="5"
                                            {{ $applicant->mother_highest_educational_attainment == '5' ? 'selected' : '' }}>
                                            College Level</option>
                                        <option value="6"
                                            {{ $applicant->mother_highest_educational_attainment == '6' ? 'selected' : '' }}>
                                            College Graduate</option>
                                        <option value="7"
                                            {{ $applicant->mother_highest_educational_attainment == '7' ? 'selected' : '' }}>
                                            Others</option>
                                    </select>
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="mother_employment_status"
                                        class="inline-block mb-2 text-base font-medium">What
                                        is your Mother's Employment
                                        Status?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="mother_employment_status" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="0"
                                            {{ $applicant->mother_employment_status == '0' ? 'selected' : '' }}>
                                            Unemployed, but is not seeking for employment</option>
                                        <option value="1"
                                            {{ $applicant->mother_employment_status == '1' ? 'selected' : '' }}>
                                            Unemployed, but is actively seeking for employment</option>
                                        <option value="2"
                                            {{ $applicant->mother_employment_status == '2' ? 'selected' : '' }}>
                                            Self-Employed</option>
                                        <option value="3"
                                            {{ $applicant->mother_employment_status == '3' ? 'selected' : '' }}>
                                            Employed - Government</option>
                                        <option value="4"
                                            {{ $applicant->mother_employment_status == '4' ? 'selected' : '' }}>
                                            Employed - Private</option>
                                        <option value="5"
                                            {{ $applicant->mother_employment_status == '5' ? 'selected' : '' }}>
                                            Not Applicable</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_occupation" class="inline-block mb-2 text-base font-medium">What is
                                        your Mother's Occupation?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="mother_occupation" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="Armed Forces Occupations"
                                            {{ $applicant->mother_occupation == 'Armed Forces Occupations' ? 'selected' : '' }}>
                                            Armed Forces Occupations (Military, Airforce, Navy, and Other Military Services)
                                        </option>
                                        <option value="Managers"
                                            {{ $applicant->mother_occupation == 'Managers' ? 'selected' : '' }}>
                                            Managers (Chief Executives, Senior Officials and Legislators, Production and
                                            Specialized Services Managers, Hospitality, Retail and Other Services Managers)
                                        </option>
                                        <option value="Professionals"
                                            {{ $applicant->mother_occupation == 'Professionals' ? 'selected' : '' }}>
                                            ⎯ Science and Engineering Professionals (physical and earth science
                                            professionals, mathematicians, actuaries and statisticians, life science
                                            professionals, engineering professionals, architects, planners, surveyors and
                                            designers)
                                            ⎯ Health Professionals (medical doctor, dentist, pharmacist, nurse, midwife,
                                            traditional and complementary medicine professionals, paramedical practitioners,
                                            veterinarians, others)
                                            ⎯ Teaching Professionals (higher education, vocational, secondary, elementary,
                                            early childhood, SPED, others)
                                            ⎯ Business and Administration Professionals (finance, administration, and sales,
                                            marketing and public relations)
                                            ⎯ Information and Communication Technology Professionals (software and
                                            applications developer and analyst, database and network professionals)
                                            ⎯ Legal, Social, and Cultural Professionals (legal; librarians, archivist, and
                                            curators; social and religious professionals; authors, journalists, and
                                            linguists; and creative and performing artists)
                                        </option>
                                        <option value="TECHNICIANS AND ASSOCIATE PROFESSIONALS"
                                            {{ $applicant->mother_occupation == 'TECHNICIANS AND ASSOCIATE PROFESSIONALS' ? 'selected' : '' }}>
                                            TECHNICIANS AND ASSOCIATE PROFESSIONALS
                                        </option>
                                        <option value="CLERICAL SUPPORT WORKERS"
                                            {{ $applicant->mother_occupation == 'CLERICAL SUPPORT WORKERS' ? 'selected' : '' }}>
                                            CLERICAL SUPPORT WORKERS
                                        </option>
                                        <option value="SERVICE AND SALES WORKERS"
                                            {{ $applicant->mother_occupation == 'SERVICE AND SALES WORKERS' ? 'selected' : '' }}>
                                            SERVICE AND SALES WORKERS
                                        </option>
                                        <option value="SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS"
                                            {{ $applicant->mother_occupation == 'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS' ? 'selected' : '' }}>
                                            SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS
                                        </option>
                                        <option value="CRAFT AND RELATED TRADES WORKERS"
                                            {{ $applicant->mother_occupation == 'CRAFT AND RELATED TRADES WORKERS' ? 'selected' : '' }}>
                                            CRAFT AND RELATED TRADES WORKERS
                                        </option>
                                        <option value="PLANT AND MACHINE OPERATORS, AND ASSEMBLERS"
                                            {{ $applicant->mother_occupation == 'PLANT AND MACHINE OPERATORS, AND ASSEMBLERS' ? 'selected' : '' }}>
                                            PLANT AND MACHINE OPERATORS, AND ASSEMBLERS
                                        </option>
                                        <option value="ELEMENTARY OCCUPATIONS"
                                            {{ $applicant->mother_occupation == 'ELEMENTARY OCCUPATIONS' ? 'selected' : '' }}>
                                            ELEMENTARY OCCUPATIONS (cleaners, helpers, laborers, and assistants)
                                        </option>
                                        <option
                                            value="Not Applicable"{{ $applicant->mother_occupation == 'Not Applicable' ? 'selected' : '' }}>
                                            Not Applicable</option>
                                    </select>
                                </div><!--end col-->

                                {{-- end of mother information --}}

                                <div class="xl:col-span-4">
                                    <label for="family_size" class="inline-block mb-2 text-base font-medium">
                                        Family size (No. of individuals living in a household who are related by blood,
                                        marriage, or adoption)</label>
                                    <input type="number" name="family_size"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('family_size', $applicant->family_size ?? '') }}"
                                        placeholder="Enter the size of your family" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="monthly_income" class="inline-block mb-2 text-base font-medium">
                                        Estimated average monthly income?
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="monthly_income" data-choices data-choices-search-false required>
                                        <option value="">Select</option>
                                        <option value="Less than 9,100"
                                            {{ $applicant->monthly_income == 'Less than 9,100' ? 'selected' : '' }}>Less
                                            than 9,100</option>
                                        <option value="9,100 to 18,200"
                                            {{ $applicant->monthly_income == '9,100 to 18,200' ? 'selected' : '' }}>9,100
                                            to 18,200</option>

                                        <option value="18,200 to 36,400"
                                            {{ $applicant->monthly_income == '18,200 to 36,400' ? 'selected' : '' }}>
                                            18,200 to 36,400</option>
                                        <option value="36,400 to 63,700"
                                            {{ $applicant->monthly_income == '36,400 to 63,700' ? 'selected' : '' }}>
                                            36,400 to 63,700</option>
                                        <option value="63,700 to 109,200"
                                            {{ $applicant->monthly_income == '63,700 to 109,200' ? 'selected' : '' }}>
                                            63,700 to 109,200</option>
                                        <option value="109,200 to 182,000"
                                            {{ $applicant->monthly_income == '109,200 to 182,000' ? 'selected' : '' }}>
                                            109,200 to 182,000</option>
                                        <option value="Above 182,000"
                                            {{ $applicant->monthly_income == 'Above 182,000' ? 'selected' : '' }}>Above
                                            182,000</option>
                                    </select>
                                </div><!--end col-->
                            </div>

                        </div>
                    </div>


                    {{-- Educational Background --}}
                    <div class="card">

                        <div class="card-body">

                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="school"
                                    class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> EDUCATIONAL
                                BACKGROUND
                            </h6>

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                                <div class="xl:col-span-4">
                                    <label for="type_of_school" class="inline-block mb-2 text-base font-medium">
                                        Last school attended
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="type_of_school" data-choices data-choices-search-false required>
                                        <option value="">Select</option>
                                        <option value="Public"
                                            {{ $applicant->type_of_school == 'Public' ? 'selected' : '' }}>Public</option>

                                        <option value="Private"
                                            {{ $applicant->type_of_school == 'Private' ? 'selected' : '' }}>Private
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="school_name" class="inline-block mb-2 text-base font-medium">
                                        Name of School <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="school_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('school_name', $applicant->school_name ?? '') }}"
                                        placeholder="Enter the name of school" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="last_school_year_attended"
                                        class="inline-block mb-2 text-base font-medium">
                                        School year Attended <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="last_school_year_attended"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('last_school_year_attended', $applicant->last_school_year_attended ?? '') }}"
                                        placeholder="Enter School year Attended" required>
                                </div><!--end col-->


                                {{-- Start SHS --}}
                                <div class="xl:col-span-4">
                                    <label for="shs_track" class="inline-block mb-2 text-base font-medium">
                                        Senior High School Strand and Track
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="shs_track" data-choices data-choices-search-false required>
                                        <option value="">Select</option>
                                        <option value="Academic Track - STEM"
                                            {{ $applicant->shs_track == 'Academic Track - STEM' ? 'selected' : '' }}>
                                            Academic Track - STEM</option>
                                        <option value="Academic Track - ABM"
                                            {{ $applicant->shs_track == 'Academic Track - ABM' ? 'selected' : '' }}>
                                            Academic Track - ABM</option>
                                        <option value="Academic Track - HUMSS"
                                            {{ $applicant->shs_track == 'Academic Track - HUMSS' ? 'selected' : '' }}>
                                            Academic Track - HUMSS</option>
                                        <option value="Academic Track - GAS"
                                            {{ $applicant->shs_track == 'Academic Track - GAS' ? 'selected' : '' }}>
                                            Academic Track - GAS</option>
                                        <option value="Technical-Vocational-Livelihood (TVL) Track - Home Economics"
                                            {{ $applicant->shs_track == 'Technical-Vocational-Livelihood (TVL) Track - Home Economics' ? 'selected' : '' }}>
                                            Technical-Vocational-Livelihood (TVL) Track - Home Economics</option>
                                        <option value="Technical-Vocational-Livelihood (TVL) Track - ICT"
                                            {{ $applicant->shs_track == 'Technical-Vocational-Livelihood (TVL) Track - ICT' ? 'selected' : '' }}>
                                            Technical-Vocational-Livelihood (TVL) Track - ICT</option>
                                        <option value="Technical-Vocational-Livelihood (TVL) Track - Agri-fishery Arts"
                                            {{ $applicant->shs_track == 'Technical-Vocational-Livelihood (TVL) Track - Agri-fishery Arts' ? 'selected' : '' }}>
                                            Technical-Vocational-Livelihood (TVL) Track - Agri-fishery Arts</option>
                                        <option value="Technical-Vocational-Livelihood (TVL) Track - Industrial Arts"
                                            {{ $applicant->shs_track == 'Technical-Vocational-Livelihood (TVL) Track - Industrial Arts' ? 'selected' : '' }}>
                                            Technical-Vocational-Livelihood (TVL) Track - Industrial Arts</option>
                                        <option value="Arts and Design Track"
                                            {{ $applicant->shs_track == 'Arts and Design Track' ? 'selected' : '' }}>Arts
                                            and Design Track</option>
                                        <option value="Sports Track"
                                            {{ $applicant->shs_track == 'Sports Track' ? 'selected' : '' }}>Sports Track
                                        </option>
                                        <option value="Not Application (N/A)"
                                            {{ $applicant->shs_track == 'Not Application (N/A)' ? 'selected' : '' }}>Not
                                            Application (N/A)</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_school" class="inline-block mb-2 text-base font-medium">
                                        Name of School <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_school', $applicant->shs_school ?? '') }}"
                                        placeholder="Enter the name of SHS school" required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_school_year" class="inline-block mb-2 text-base font-medium">
                                        School year Attended <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_school_year"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_school_year', $applicant->shs_school_year ?? '') }}"
                                        placeholder="Enter SHS School year Attended" required>
                                </div><!--end col-->

                                {{-- End SHS --}}

                                {{-- Start ADM --}}
                                <div class="xl:col-span-4">
                                    <label for="is_adm" class="inline-block mb-2 text-base font-medium">
                                        Alternative Delivery Modes (ADM)
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_adm" data-choices data-choices-search-false required>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_adm == '1' ? 'selected' : '1' }}>Yes
                                        </option>
                                        <option value="0" {{ $applicant->is_adm == '0' ? 'selected' : '0' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="als_school" class="inline-block mb-2 text-base font-medium">
                                        Name of School (put N/A if not applicable) <sup class="text-red-500">*
                                            required</sup></label>
                                    <input type="text" name="als_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('als_school', $applicant->als_school ?? '') }}"
                                        placeholder="Enter the name of ADM school">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="adm_school_year" class="inline-block mb-2 text-base font-medium">
                                        School year Attended (put N/A if not applicable)<sup class="text-red-500">*
                                            required</sup></label>
                                    <input type="text" name="adm_school_year"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('adm_school_year', $applicant->adm_school_year ?? '') }}"
                                        placeholder="Enter ADM School year Attended">
                                </div><!--end col-->

                                {{-- End ADM --}}

                                {{-- ALS ADM --}}
                                <div class="xl:col-span-4">
                                    <label for="is_als" class="inline-block mb-2 text-base font-medium">
                                        Alternative Learning System (ALS)
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_als" data-choices data-choices-search-false required>
                                        <option value="">Select</option>
                                        <option value="1" {{ $applicant->is_als == '1' ? 'selected' : '1' }}>Yes
                                        </option>
                                        <option value="0" {{ $applicant->is_als == '0' ? 'selected' : '0' }}>No
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="als_school" class="inline-block mb-2 text-base font-medium">
                                        Name of School (put N/A if not applicable) <sup class="text-red-500">*
                                            required</sup></label>
                                    <input type="text" name="als_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('als_school', $applicant->als_school ?? '') }}"
                                        placeholder="Enter the name of ADM school">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="als_school_year" class="inline-block mb-2 text-base font-medium">
                                        School year Attended (put N/A if not applicable)<sup class="text-red-500">*
                                            required</sup></label>
                                    <input type="text" name="als_school_year"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('als_school_year', $applicant->als_school_year ?? '') }}"
                                        placeholder="Enter ALS School year Attended">
                                </div><!--end col-->

                                {{-- End ALS --}}



                            </div>

                            <div class="flex gap-2 mt-4">

                                @if ($is_applicant_exist)
                                    @if ($is_applicant_exist->status == 0)
                                        <div class="flex gap-2 mt-4">
                                            <button type="submit"
                                                class="text-white bg-yellow-500 border-yellow-500 btn hover:text-white hover:bg-yellow-600 hover:yellow-green-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/10">
                                                <i data-lucide="pencil"
                                                    class="inline-block size-4 dark:text-zink-200"></i>
                                                Update
                                                Information</button>

                                        </div>

                                        <div class="flex gap-2 mt-4">
                                            <button type="submit" id="publishButton"
                                                class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                <i data-lucide="save-all" class="inline-block h-4 align-middle"></i>
                                                Submit
                                                and Publish </button>
                                        </div>
                                    @elseif($is_applicant_exist->status == 1)
                                        <button type="button"
                                            class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                            <i data-lucide="check" class="inline-block size-4 dark:text-zink-200"></i>
                                            Published</button>
                                    @else
                                    @endif
                                @else
                                    <div class="flex gap-2 mt-4">
                                        <button type="submit"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="save-all" class="inline-block h-4 align-middle"></i> Save
                                            Information </button>
                                    </div>
                                @endif


                            </div>


                        </div>
                    </div>


                </form>
            </div>
        {{-- @else
            <div class="xl:col-span-12">
                <div
                    class="flex gap-1 px-4 py-3 text-sm text-red-500 border border-red-200 rounded-md md:items-center bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                    <i data-lucide="alert-circle" class="h-4"></i> <span class="font-bold">Error!</span> No
                    Reservation or reservation is not confirmed!
                </div>
            </div>

        @endif --}}
    </div>
@endsection



@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> --}}
    <script src="{{ asset('backend/assets/choices/choices.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>


    {{-- initialized the data-choices --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll("[data-choices]");

            elements.forEach((element) => {
                new Choices(element, {
                    removeItemButton: true,
                    allowHTML: true,
                    searchEnabled: true,
                    itemSelectText: "Click to select",
                });
            });
        });
    </script>

    {{-- Student Category --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('student_category');
            const newTypeDiv = document.getElementById('student_category_new_type');
            const oldTypeDiv = document.getElementById('student_category_old_type');

            function toggleStudentCategoryType() {
                const selectedValue = categorySelect.value;

                if (selectedValue === "0") {
                    newTypeDiv.classList.remove('hidden');
                    oldTypeDiv.classList.add('hidden');
                } else if (selectedValue === "1") {
                    newTypeDiv.classList.add('hidden');
                    oldTypeDiv.classList.remove('hidden');
                } else {
                    newTypeDiv.classList.add('hidden');
                    oldTypeDiv.classList.add('hidden');
                }
            }

            categorySelect.addEventListener('change', toggleStudentCategoryType);

            // Trigger on load in case of old input
            toggleStudentCategoryType();
        });
    </script>

    {{-- Civil Status --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const civilstatusSelect = document.querySelector('#civil_status_id select');
            const newTypeDiv = document.getElementById('civil_status_others_id');

            function toggleCivilStatus() {
                const selectedValue = civilstatusSelect.value;

                if (selectedValue === "0") {
                    newTypeDiv.classList.remove('hidden');
                } else {
                    newTypeDiv.classList.add('hidden');
                }
            }

            civilstatusSelect.addEventListener('change', toggleCivilStatus);

            // Trigger on load in case of old input
            toggleCivilStatus();
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generic toggle function
            function setupToggle({
                selectSelector,
                fields = [],
            }) {
                const select = document.querySelector(selectSelector);
                if (!select) return;

                const toggle = () => {
                    const selectedValue = select.value;
                    const isYes = selectedValue === "1";

                    fields.forEach(field => {
                        const input = document.getElementById(field.inputId);
                        const label = document.querySelector(`label[for="${field.inputId}"]`);

                        if (isYes) {
                            input.removeAttribute('disabled');

                            // Only clear the input value if it's not already set (i.e., from DB or old value)
                            if (!input.value) {
                                input.value = '';
                            }

                            if (!label.querySelector('sup')) {
                                const sup = document.createElement('sup');
                                sup.className = 'text-red-500';
                                sup.innerText = '* required';
                                label.appendChild(sup);
                            }
                        } else {
                            input.setAttribute('disabled', true);

                            // Only set the value to 'N/A' if it's not already set (i.e., from DB or old value)
                            if (!input.value) {
                                input.value = 'N/A';
                            }

                            const sup = label.querySelector('sup');
                            if (sup) sup.remove();
                        }
                    });
                };

                select.addEventListener('change', toggle);
                toggle(); // Initial call on page load
            }

            // 4Ps
            setupToggle({
                selectSelector: '#is_4ps_beneficiary select',
                fields: [{
                    inputId: 'is_4ps_beneficiary_id'
                }],
            });

            // Solo Parent
            setupToggle({
                selectSelector: '#is_solo_parent select',
                fields: [{
                    inputId: 'is_solo_parent_id'
                }],
            });

            // PWD (2 fields)
            setupToggle({
                selectSelector: '#is_pwd select',
                fields: [{
                        inputId: 'is_pwd_desc'
                    },
                    {
                        inputId: 'is_pwd_id'
                    }
                ],
            });

            // GIDA
            setupToggle({
                selectSelector: '#is_gida select',
                fields: [{
                    inputId: 'is_gida_desc'
                }],
            });

            // IP
            setupToggle({
                selectSelector: 'select[name="is_ip"]',
                fields: [{
                    inputId: 'is_ip_type'
                }],
            });
        });
    </script>

    {{-- swal publish --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("publishButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action

                // Get the user_id from the hidden input
                const userId = document.querySelector('input[name="user_id"]').value;

                Swal.fire({
                    title: "Are you sure?",
                    text: "Submitting will finalize and publish your profile. Please ensure all details are correct before proceeding. Once your profile information is published, you will not be able to update it.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, publish it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to publish
                        // Dynamically insert the userId into the route
                        const publishUrl = `/admin/cee/ched-applicant-profile/${userId}/publish`;

                        fetch(publishUrl, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!",
                                            "Your profile has been published. You can now view your USMCEE Result",
                                            "success")
                                        .then(() => location.reload()); // Reload the page
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => {
                                Swal.fire("Error!", "Something went wrong. Please try again.",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>
@endpush
