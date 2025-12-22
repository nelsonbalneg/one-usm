@extends('admin.layouts.master')
@section('title')
   USM-AES | Pre-registration - Personal Information
@endsection

@php
    use Carbon\Carbon;
    // Ensure birthdate is formatted for the date input
    $birthdate = $applicant->date_of_birth ? Carbon::parse($applicant->date_of_birth)->format('Y-m-d') : '';

@endphp

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
            <li class="text-slate-700 dark:text-zink-100">
                Personal Information
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            <form id="studentProfileForm" action="{{ route('admin.applicant-profile.step1.save') }}" method="POST">
                @csrf
                {{-- Success & Error Alert Notifications --}}
                @php
                    $alertTypes = [
                        'success' => ['color' => 'green', 'message' => session('success')],
                        'error' => [
                            'color' => 'red',
                            'message' => $errors->any() ? 'You should check in on some of those fields below.' : null,
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

                {{-- Personal Information --}}
                <div class="card">

                    <div class="card-body">


                        <h6 class="text-blue-500 uppercase text-15"><i data-lucide="user"
                                class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PERSONAL INFORMATION
                            <b> {{ $applicant->first_name }} {{ $applicant->middle_initial }} {{ $applicant->last_name }}
                                {{ $applicant->ext_name }} </b>
                        </h6>

                        <div class="flex gap-2 mt-1 mb-6">
                            @if (
                                $applicant->applicant_profile_status == 0 ||
                                    empty($applicant->applicant_profile_status) ||
                                    is_null(value: $applicant->applicant_profile_status))
                                <button type="submit" id="publishButton" data-id="{{ $applicant->id }}"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    <i data-lucide="check" class="inline-block size-4 dark:text-zink-200"></i> Publish Profile
                                </button>
                            @else
                                <button type="submit" id="unpostProfileBtn" data-id="{{ $applicant->id }}"
                                    class="text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                    <i data-lucide="x" class="inline-block size-4 dark:text-zink-200"></i> Unpost Profile
                                </button>
                            @endif

                        </div>

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                            <div class="xl:col-span-4">
                                <label for="app_no" class="inline-block mb-2 text-base font-medium">CEE Application No
                                    <sup class="text-blue-500">* Read Only</sup></label>
                                <input type="text" name="app_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('app_no', $applicant->app_no) }}" readonly>
                            </div><!--end col-->

                              <div class="xl:col-span-4">
                                 <label for="status_id" class="inline-block mb-2 text-base font-medium">Status ID (Set blank if applicant will be tranferred to other program)</label>
                                <input type="text" name="status_id"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('status_id', $applicant->status_id) }}">
                            </div>
                            <div class="xl:col-span-4">
                            </div>

                            <div class="xl:col-span-6">
                                <label for="student_type" class="inline-block mb-2 text-base font-medium">Student Type
                                    <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="student_type" data-choices data-choices-search-false>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($applicant) && $applicant->student_type == 1 ? 'selected' : '' }}>
                                        New Student</option>
                                    <option value="2"
                                        {{ isset($applicant) && $applicant->student_type == 2 ? 'selected' : '' }}>
                                        Transferee</option>
                                    <option value="3"
                                        {{ isset($applicant) && $applicant->student_type == 3 ? 'selected' : '' }}>
                                        Shiftee</option>
                                </select>
                            </div><!--end col-->

                            <div class="mb-4 xl:col-span-6">
                                <label for="freshmen_type" class="inline-block mb-2 text-base font-medium">Freshmen Type
                                    <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="freshmen_type" data-choices data-choices-search-false>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($applicant) && $applicant->freshmen_type == 1 ? 'selected' : '' }}>
                                        Graduated Grade 12</option>
                                    <option value="2"
                                        {{ isset($applicant) && $applicant->freshmen_type == 2 ? 'selected' : '' }}>
                                        On-going Grade 12</option>
                                    <option value="3"
                                        {{ isset($applicant) && $applicant->freshmen_type == 3 ? 'selected' : '' }}>
                                        High School (Did Not Undergo Senior High)</option>
                                </select>
                            </div><!--end col-->




                            <input type="hidden" name="user_id" value="{{ $applicant->user_id }}">
                            <input type="hidden" name="applicant_prof_id" value="{{ $applicant->id }}">
                            {{-- <input type="hidden" name="app_no" value="{{ $applicant->app_no }}"> --}}

                            <div class="xl:col-span-4">
                                <label for="last_name" class="inline-block mb-2 text-base font-medium">Last Name <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="last_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('last_name', $applicant->last_name) }}">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="first_name" class="inline-block mb-2 text-base font-medium">First Name <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="first_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('first_name', $applicant->first_name) }}">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="middle_name" class="inline-block mb-2 text-base font-medium">Middle Name
                                    <sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="middle_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('middle_name', $applicant->middle_name) }}">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="ext_name" class="inline-block mb-2 text-base font-medium">Suffix
                                    <sup class="text-red-500">* Required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="ext_name" data-choices data-choices-search-false>
                                    <option value="">-Select-</option>
                                    <option value="Jr" {{ $applicant->ext_name == 'Jr' ? 'selected' : '' }}>Jr
                                    </option>
                                    <option value="Sr" {{ $applicant->ext_name == 'Sr' ? 'selected' : '' }}>Sr
                                    </option>
                                    <option value="I" {{ $applicant->ext_name == 'I' ? 'selected' : '' }}>I
                                    </option>
                                    <option value="II" {{ $applicant->ext_name == 'II' ? 'selected' : '' }}>II
                                    </option>
                                    <option value="III" {{ $applicant->ext_name == 'III' ? 'selected' : '' }}>III
                                    </option>
                                    <option value="IV" {{ $applicant->ext_name == 'IV' ? 'selected' : '' }}>IV
                                    </option>
                                    <option value="V" {{ $applicant->ext_name == 'V' ? 'selected' : '' }}>V
                                    </option>
                                    <option value="VI" {{ $applicant->ext_name == 'VI' ? 'selected' : '' }}>VI
                                    </option>
                                    <option value="VII" {{ $applicant->ext_name == 'VII' ? 'selected' : '' }}>VII
                                    </option>
                                    <option value="VIII" {{ $applicant->ext_name == 'VIII' ? 'selected' : '' }}>VIII
                                    </option>
                                </select>
                                {{-- <input type="hidden" name="ext_name" value="{{ $applicant->ext_name }}"> --}}
                            </div><!--end col-->


                            <div class="xl:col-span-4">
                                <label for="birthdate" class="inline-block mb-2 text-base font-medium">Birthdate<sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="date" name="birthdate"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date" data-provider="flatpickr" data-date-format="M d, Y"
                                    value="{{ \Carbon\Carbon::parse($birthdate)->format('Y-m-d') }}">

                                <input type="hidden" name="date_of_birth" value="{{ $birthdate }}">
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="mobile_no" class="inline-block mb-2 text-base font-medium">Mobile No <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="mobile_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value={{ old('mobile_no', $applicant->mobile_no) }}>
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="gender" class="inline-block mb-2 text-base font-medium">Sex <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="gender"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value={{ old('gender', $applicant->gender) }}>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="email" class="inline-block mb-2 text-base font-medium">Email Address
                                    <sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value={{ old('email', $applicant->email) }}>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="civil_status_id" class="inline-block mb-2 text-base font-medium">Civil
                                    Status <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="civil_status_id" data-choices data-choices-search-false>
                                    <option value="">Select Civil Status</option>
                                    <option value="1"
                                        {{ isset($applicant) && $applicant->civil_status_id == 1 ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="2"
                                        {{ isset($applicant) && $applicant->civil_status_id == 2 ? 'selected' : '' }}>
                                        Married</option>
                                    <option value="3"
                                        {{ isset($applicant) && $applicant->civil_status_id == 3 ? 'selected' : '' }}>
                                        Separated</option>
                                    <option value="4"
                                        {{ isset($applicant) && $applicant->civil_status_id == 4 ? 'selected' : '' }}>
                                        Widow/er</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="religion_id" class="inline-block mb-2 text-base font-medium">Religion <sup
                                        class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="religion_id" data-choices data-choices-search-false>
                                    <option value="">Select Religion</option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion['religionId'] }}"
                                            {{ isset($applicant) && $applicant->religion_id == $religion['religionId'] ? 'selected' : '' }}>
                                            {{ $religion['religion'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="nationality_id"
                                    class="inline-block mb-2 text-base font-medium">Nationality<sup class="text-red-500">*
                                        required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="nationality_id" data-choices data-choices-search-false>
                                    <option value="">Select Nationality</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality['nationalityId'] }}"
                                            {{ isset($applicant) && $applicant->nationality_id == $nationality['nationalityId'] ? 'selected' : '' }}>
                                            {{ $nationality['nationality'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="height" class="inline-block mb-2 text-base font-medium">Height (cm)<sup
                                        class="text-red-500">* required</sup></label>
                                <input type="number" name="height"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Height" value="{{ old('height', $applicant->height ?? '') }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="weight" class="inline-block mb-2 text-base font-medium">Weight (kg) <sup
                                        class="text-red-500">* required</sup></label>
                                <input type="number" name="weight"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter weight" value="{{ old('weight', $applicant->weight ?? '') }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="blood_type" class="inline-block mb-2 text-base font-medium">Blood Type
                                    <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="blood_type" data-choices required>
                                    <option value="">Select Blood Type</option>
                                    <option value="A+"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'A+' ? 'selected' : '' }}>
                                        A+</option>
                                    <option value="A-"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'A-' ? 'selected' : '' }}>
                                        A-</option>
                                    <option value="B+"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'B+' ? 'selected' : '' }}>
                                        B+</option>
                                    <option value="B-"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'B-' ? 'selected' : '' }}>
                                        B-</option>
                                    <option value="AB+"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'AB+' ? 'selected' : '' }}>
                                        AB+</option>
                                    <option value="AB-"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'AB-' ? 'selected' : '' }}>
                                        AB-</option>
                                    <option value="O+"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'O+' ? 'selected' : '' }}>
                                        O+</option>
                                    <option value="O-"
                                        {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'O-' ? 'selected' : '' }}>
                                        O-</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="no_of_brothers" class="inline-block mb-2 text-base font-medium">Number of
                                    Brothers
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="number" name="no_of_brothers"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('no_of_brothers', $applicant->no_of_brothers ?? '') }}"
                                    placeholder="Enter Number of Brothers">
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="no_of_sisters" class="inline-block mb-2 text-base font-medium">Number of
                                    Sisters
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="number" name="no_of_sisters"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('no_of_sisters', $applicant->no_of_sisters ?? '') }}"
                                    placeholder="Enter Number of Sisters">
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="is_illegitimate_child"
                                    class="inline-block mb-2 text-base font-medium">Legitimate Child?
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="is_illegitimate_child" data-choices>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ old('is_illegitimate_child', isset($applicant) ? $applicant->is_illegitimate_child : '') == '1' ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('is_illegitimate_child', isset($applicant) ? $applicant->is_illegitimate_child : '') == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-2">
                                <label for="tribe_id" class="inline-block mb-2 text-base font-medium">Tribe
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="tribe_id" data-choices>
                                    <option value="">Select a tribe</option>
                                    @foreach ($tribes as $tribe)
                                        <option value="{{ $tribe['tribeId'] }}"
                                            {{ old('tribe_id', isset($applicant) ? $applicant->tribe_id : '') == $tribe['tribeId'] ? 'selected' : '' }}>
                                            {{ $tribe['tribeName'] }}
                                        </option>
                                    @endforeach

                                </select>
                            </div><!--end col-->

                            {{-- IP Member? --}}
                            <div class="xl:col-span-2" id="ip_member">
                                <label for="ip_member" class="inline-block mb-2 text-base font-medium">IP Member?
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select id="ip_member_select"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="ip_member" data-choices>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ old('ip_member', isset($applicant) ? $applicant->ip_member : '') == '1' ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('ip_member', isset($applicant) ? $applicant->ip_member : '') == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                            </div><!--end col-->


                            <div class="xl:col-span-2">
                                <label for="ip_member_tribe" class="inline-block mb-2 text-base font-medium">IP Member
                                    Tribe
                                    <sup class="text-green-500">* optional</sup>
                                </label>
                                <input type="text" name="ip_member_tribe" id="is_ip_type"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('ip_member_tribe', $applicant->ip_member_tribe ?? 'N/A') }}"
                                    placeholder="Enter IP Member Tribe" disabled>
                            </div><!--end col-->

                            {{-- IS PWD? --}}
                            <div class="xl:col-span-2" id="pwd_member">
                                <label for="pwd_member" class="inline-block mb-2 text-base font-medium">PWD?
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select id="pwd_member_select"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="pwd_member" data-choices>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ old('pwd_member', isset($applicant) ? $applicant->pwd_member : '') == '1' ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('pwd_member', isset($applicant) ? $applicant->pwd_member : '') == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="pwd_member_id" class="inline-block mb-2 text-base font-medium">
                                    PWD ID Number <sup class="text-red-500">* required</sup></label>
                                <input type="text" name="pwd_member_id" id="pwd_id_number"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value={{ old('pwd_member_id', $applicant->pwd_member_id ?? '') }} disabled>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="pwd_category" class="inline-block mb-2 text-base font-medium">
                                    PWD Category <sup class="text-red-500">* required</sup></label>
                                <input type="text" name="pwd_category" id="pwd_category"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value={{ old('pwd_category', $applicant->pwd_category ?? '') }} disabled>
                            </div><!--end col-->

                            {{-- IS Solo Parent? --}}
                            <div class="xl:col-span-2" id="solo_parent">
                                <label for="solo_parent" class="inline-block mb-2 text-base font-medium">Solo Parent?
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select id="solo_parent_select"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="solo_parent" data-choices>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ old('solo_parent', isset($applicant) ? $applicant->solo_parent : '') == '1' ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('solo_parent', isset($applicant) ? $applicant->solo_parent : '') == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="solo_parent_id" class="inline-block mb-2 text-base font-medium">Solo
                                    Parent ID
                                    <sup class="text-red-500">* required</sup></label>
                                <input type="text" name="solo_parent_id" id="solo_parent_id"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('solo_parent_id', $applicant->solo_parent_id ?? '') }}" disabled>
                            </div><!--end col-->


                            <div class="xl:col-span-8">
                                <label for="place_of_birth" class="inline-block mb-2 text-base font-medium">Place of
                                    Birth <sup class="text-red-500">* required</sup></label>
                                <input type="text" name="place_of_birth"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('place_of_birth', $applicant->place_of_birth ?? '') }}">
                            </div><!--end col-->
                        </div><!--end grid-->

                        <div class="grid grid-cols-1 gap-5 mt-10 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-blue-500 uppercase text-15">
                                    <i data-lucide="map-pin-house"
                                        class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>
                                    RESIDENCE AND PERMANENT ADDRESS
                                </h6>
                            </div>

                            <!-- Residential Address Section -->
                            <div id="residentAddressSection" class="col-span-12">
                                <h6 class="text-green-500 uppercase text-15 xl:col-span-12">Residential Address</h6>
                                <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 xl:grid-cols-4">
                                    <div>
                                        <label for="res_region" class="inline-block mb-2 text-base font-medium">Region
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="res_region" name="res_region"></select>
                                        <input type="hidden" name="region_text-res" id="region-text-res" required>
                                    </div>

                                    <div>
                                        <label for="res_province" class="inline-block mb-2 text-base font-medium">Province
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="res_province" name="res_province">
                                            <option selected disabled>Choose Province</option>
                                        </select>
                                        <input type="hidden" name="province_text-res" id="province-text-res" required>
                                    </div>

                                    <div>
                                        <label for="res_towncity"
                                            class="inline-block mb-2 text-base font-medium">Municipality/City
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="res_towncity" name="res_towncity">
                                            <option selected disabled>Choose Municipality</option>
                                        </select>
                                        <input type="hidden" name="city_text-res" id="city-text-res" required>
                                    </div>

                                    <div>
                                        <label for="res_barangay" class="inline-block mb-2 text-base font-medium">Barangay
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="res_barangay" name="res_barangay">
                                            <option selected disabled>Choose Barangay</option>
                                        </select>
                                        <input type="hidden" name="barangay_text-res" id="barangay-text-res" required>
                                    </div>

                                    <div class="col-span-2">
                                        <label for="res_street" class="inline-block mb-2 text-base font-medium">Street
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <input type="text" id="res_street" name="res_street"
                                            class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Street"
                                            value="{{ old('res_street', $applicant->res_street ?? '') }}" required>
                                    </div>

                                    <div class="col-span-2">
                                        <label for="res_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                            Code (Number only)</label>
                                        <input type="text" id="res_zipcode" name="res_zipcode"
                                            class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter your zipcode"
                                            value="{{ old('res_zipcode', $applicant->res_zipcode ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Permanent Address Section -->
                            <div id="permanentAddressSection" class="col-span-12 mt-4 ">
                                <h6 class="text-green-500 uppercase text-15 xl:col-span-12">Permanent Address</h6>

                                <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 xl:grid-cols-4">
                                    <div>
                                        <label for="perm_region" class="inline-block mb-2 text-base font-medium">Region
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="perm_region" name="perm_region"></select>
                                        <input type="hidden" name="region_text-perm" id="region-text-perm">
                                    </div>

                                    <div>
                                        <label for="perm_province"
                                            class="inline-block mb-2 text-base font-medium">Province
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="perm_province" name="perm_province">
                                            <option selected disabled>Choose Province</option>
                                        </select>
                                        <input type="hidden" name="province_text-perm" id="province-text-perm">
                                    </div>

                                    <div>
                                        <label for="perm_towncity"
                                            class="inline-block mb-2 text-base font-medium">Municipality/City
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="perm_towncity" name="perm_towncity">
                                            <option selected disabled>Choose Municipality</option>
                                        </select>
                                        <input type="hidden" name="city_text-perm" id="city-text-perm">
                                    </div>

                                    <div>
                                        <label for="perm_barangay"
                                            class="inline-block mb-2 text-base font-medium">Barangay
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="perm_barangay" name="perm_barangay">
                                            <option selected disabled>Choose Barangay</option>
                                        </select>
                                        <input type="hidden" name="barangay_text-perm" id="barangay-text-perm">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="perm_street" class="inline-block mb-2 text-base font-medium">Street
                                            <sup class="text-red-500">* required</sup>
                                        </label>
                                        <input type="text" id="perm_street" name="perm_street"
                                            class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Street"
                                            value="{{ old('perm_street', $applicant->perm_street ?? '') }}">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="perm_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                            Code (Number only)</label>
                                        <input type="text" id="perm_zipcode" name="perm_zipcode"
                                            class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter your zipcode"
                                            value="{{ old('perm_zipcode', $applicant->perm_zipcode ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2 mt-4">

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
                                <a href="{{ route('admin.applicant-profile.step2.show', ['id' => $applicant->id]) }}"
                                    class="flex items-center gap-1 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    Next<i data-lucide="arrow-right" class="inline-block size-4 dark:text-zink-200"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                </div><!--end card-->
            </form>


        </div><!--end col-->

    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    {{-- residential address --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->res_region }}";
            var savedProvince = "{{ $applicant->res_province }}";
            var savedCity = "{{ $applicant->res_towncity }}";
            var savedBarangay = "{{ $applicant->res_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#res_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#res_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#res_region', '#region-text-res');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#res_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#res_region').on('change', function() {
                var region_code = $(this).val();
                $('#res_province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#res_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_province', '#province-text-res');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#res_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#res_province').on('change', function() {
                var province_code = $(this).val();
                $('#res_towncity').empty().append('<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#res_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_towncity', '#city-text-res');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#res_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#res_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#res_barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#res_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_barangay', '#barangay-text-res');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#res_region').on('change', function() {
                updateHiddenTextField('#res_region', '#region-text-res');
            });
            $('#res_province').on('change', function() {
                updateHiddenTextField('#res_province', '#province-text-res');
            });
            $('#res_towncity').on('change', function() {
                updateHiddenTextField('#res_towncity', '#city-text-res');
            });
            $('#res_barangay').on('change', function() {
                updateHiddenTextField('#res_barangay', '#barangay-text-res');
            });
        });
    </script>

    {{-- Permanent address --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->perm_region }}";
            var savedProvince = "{{ $applicant->perm_province }}";
            var savedCity = "{{ $applicant->perm_towncity }}";
            var savedBarangay = "{{ $applicant->perm_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#perm_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#perm_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#perm_region', '#region-text-perm');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#perm_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#perm_region').on('change', function() {
                var region_code = $(this).val();
                $('#perm_province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#perm_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_province', '#province-text-perm');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#perm_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#perm_province').on('change', function() {
                var province_code = $(this).val();
                $('#perm_towncity').empty().append(
                    '<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#perm_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_towncity', '#city-text-perm');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#perm_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#perm_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#perm_barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#perm_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_barangay', '#barangay-text-perm');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#perm_region').on('change', function() {
                updateHiddenTextField('#perm_region', '#region-text-perm');
            });
            $('#perm_province').on('change', function() {
                updateHiddenTextField('#perm_province', '#province-text-perm');
            });
            $('#perm_towncity').on('change', function() {
                updateHiddenTextField('#perm_towncity', '#city-text-perm');
            });
            $('#perm_barangay').on('change', function() {
                updateHiddenTextField('#perm_barangay', '#barangay-text-perm');
            });
        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const ipMemberSelect = document.getElementById('ip_member_select');
            const tribeInput = document.getElementById('is_ip_type');

            if (ipMemberSelect && tribeInput) {
                function toggleTribeInput() {
                    tribeInput.disabled = ipMemberSelect.value !== '1';
                    if (tribeInput.disabled) {
                        // tribeInput.value = 'N/A';
                    }
                }

                ipMemberSelect.addEventListener('change', toggleTribeInput);
                toggleTribeInput(); // Initial run
            } else {
                console.error('IP Member select or Tribe input not found in DOM.');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pwdSelect = document.getElementById('pwd_member_select');
            const pwdIdInput = document.getElementById('pwd_id_number');
            const pwdCategoryInput = document.getElementById('pwd_category');

            if (pwdSelect && pwdIdInput && pwdCategoryInput) {
                function togglePWDFields() {
                    const isPWD = pwdSelect.value === '1';

                    pwdIdInput.disabled = !isPWD;
                    pwdCategoryInput.disabled = !isPWD;

                    if (isPWD) {
                        pwdIdInput.placeholder = 'Enter PWD ID number';
                        pwdCategoryInput.placeholder = 'Enter PWD category';
                    } else {
                        pwdIdInput.value = 'N/A';
                        pwdCategoryInput.value = 'N/A';
                        pwdIdInput.placeholder = 'N/A';
                        pwdCategoryInput.placeholder = 'N/A';
                    }
                }

                pwdSelect.addEventListener('change', togglePWDFields);
                togglePWDFields(); // Run on page load
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const soloParentSelect = document.getElementById('solo_parent_select');
            const soloParentIdInput = document.getElementById('solo_parent_id');

            if (soloParentSelect && soloParentIdInput) {
                function toggleSoloParentField() {
                    const isSoloParent = soloParentSelect.value === '1';

                    soloParentIdInput.disabled = !isSoloParent;

                    if (isSoloParent) {
                        soloParentIdInput.placeholder = 'Enter Solo Parent ID';
                    } else {
                        soloParentIdInput.value = '';
                        soloParentIdInput.placeholder = '';
                    }
                }

                soloParentSelect.addEventListener('change', toggleSoloParentField);
                toggleSoloParentField(); // Run on page load
            }
        });
    </script>

    {{-- swal unpost   --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const unpostBtn = document.getElementById("unpostProfileBtn");

            unpostBtn.addEventListener("click", function(event) {
                event.preventDefault();

                const studentId = this.dataset.id;

                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to unpost this profile. Once unposted, you will be able to update the student applicant's information.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, unpost it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Using proper Laravel named routes
                        fetch("{{ route('admin.student-profile.unpost', ['id' => ':id']) }}"
                                .replace(
                                    ':id', studentId), {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json",
                                        "Accept": "application/json"
                                    },
                                    body: JSON.stringify({})
                                })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!", data.message, "success")
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch((error) => {
                                console.error("Fetch error:", error);
                                Swal.fire("Error!", "Something went wrong. Please try again.",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>

     {{-- swal publish --}}
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const unpostBtn = document.getElementById("publishButton");

            unpostBtn.addEventListener("click", function(event) {
                event.preventDefault();

                const studentId = this.dataset.id;

                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to Publish this profile. Once unposted, you will be able to update the student applicant's information.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, unpost it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Using proper Laravel named routes
                        fetch("{{ route('admin.student-profile.publish', ['id' => ':id']) }}"
                                .replace(
                                    ':id', studentId), {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json",
                                        "Accept": "application/json"
                                    },
                                    body: JSON.stringify({})
                                })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!", data.message, "success")
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch((error) => {
                                console.error("Fetch error:", error);
                                Swal.fire("Error!", "Something went wrong. Please try again.",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>
@endpush
