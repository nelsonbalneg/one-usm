@extends('admin.layouts.master')
@section('title')
   USM-AES | Pre-registration - Parent and Guardian Information
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
            <li class="text-slate-700 dark:text-zink-100">
                Parent and Guardian Information
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-12">
            <form id="studentProfileForm" action="{{ route('admin.applicant-profile.step2.save') }}" method="POST">
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

                {{-- parents  and Guardian Information --}}
                <div class="card">
                    <div class="card-body">

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-blue-500 uppercase text-15"> <i data-lucide="monitor"
                                        class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PARENT AND
                                    GUARDIAN
                                    INFORMATION
                                </h6>
                            </div>


                            <div class="xl:col-span-12">
                                <h6 class="text-green-500 uppercase text-15 xl:col-span-12">PARENT INFORMATION</h6>
                                <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.</p>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $applicant->id }}">
                            <input type="hidden" name="applicant_prof_id" value="{{ $applicant->id }}">

                            <div class="xl:col-span-4">
                                <label for="father" class="inline-block mb-2 text-base font-medium">Father's Name
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="text" name="father"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father', $applicant->father ?? '') }}"
                                    placeholder="Enter Father's full name">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_birth_date" class="inline-block mb-2 text-base font-medium">Father's
                                    Birthdate
                                    <sup class="text-green-500">* optional</sup>
                                </label>
                                <input type="date" name="father_birth_date"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_birth_date', isset($applicant) && $applicant->father_birth_date ? \Carbon\Carbon::parse($applicant->father_birth_date)->format('Y-m-d') : '') }}"
                                    placeholder="Enter Father's Birthdate">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_educ_attain" class="inline-block mb-2 text-base font-medium">Father's
                                    Educationl Attainment
                                    <sup class="text-green-500">* optional</sup>
                                </label>
                                <input type="text" name="father_educ_attain"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_educ_attain', $applicant->father_educ_attain ?? '') }}"
                                    placeholder="Enter Father's educational attainment">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_occupation" class="inline-block mb-2 text-base font-medium">Father's
                                    Occupation</label>
                                <input type="text" name="father_occupation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_occupation', $applicant->father_occupation ?? '') }}"
                                    placeholder="Enter Father's Occupation">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_company" class="inline-block mb-2 text-base font-medium">Father's
                                    Company Name</label>
                                <input type="text" name="father_company"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_company', $applicant->father_company ?? '') }}"
                                    placeholder="Enter Father's Company Name">
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="father_company_address" class="inline-block mb-2 text-base font-medium">Father's
                                    Company Address</label>
                                <input type="text" name="father_company_address"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_company_address', $applicant->father_company_address ?? '') }}"
                                    placeholder="Enter Father's Company Address">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_tel_no" class="inline-block mb-2 text-base font-medium">Father's
                                    Telephone No</label>
                                <input type="text" name="father_tel_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_tel_no', $applicant->father_tel_no ?? '') }}"
                                    placeholder="Enter Father's Telephone #">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="father_email" class="inline-block mb-2 text-base font-medium">Father's
                                    Email (Leave it Blank if no email)</label>
                                <input type="text" name="father_email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('father_email', $applicant->father_email ?? '') }}"
                                    placeholder="Enter Father's email">
                            </div><!--end col-->

                            <div class="mb-4 xl:col-span-4">
                                <label for="father_income_from" class="inline-block mb-2 text-base font-medium">Father's
                                    Monthly Income
                                    <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="father_income_from">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($applicant) && $applicant->father_income_from == 1 ? 'selected' : '' }}>
                                        Less than 9,100</option>
                                    <option value="2"
                                        {{ isset($applicant) && $applicant->father_income_from == 2 ? 'selected' : '' }}>
                                        9,100 to 18,200</option>
                                    <option value="3"
                                        {{ isset($applicant) && $applicant->father_income_from == 3 ? 'selected' : '' }}>
                                        18,200 to 36,400</option>
                                    <option value="4"
                                        {{ isset($applicant) && $applicant->father_income_from == 4 ? 'selected' : '' }}>
                                        36,400 to 63,700</option>
                                    <option value="5"
                                        {{ isset($applicant) && $applicant->father_income_from == 5 ? 'selected' : '' }}>
                                        63,700 to 109,200</option>
                                    <option value="6"
                                        {{ isset($applicant) && $applicant->father_income_from == 6 ? 'selected' : '' }}>
                                        109,200 to 182,000</option>
                                    <option value="7"
                                        {{ isset($applicant) && $applicant->father_income_from == 7 ? 'selected' : '' }}>
                                        Above 182,000</option>
                                    <option value="0"
                                        {{ isset($applicant) && $applicant->father_income_from == 0 ? 'selected' : '' }}>
                                        Not Applicable</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="mother" class="inline-block mb-2 text-base font-medium">Mother's
                                    Name <sup class="text-red-500">* required</sup></label>
                                <input type="text" name="mother"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother', $applicant->mother ?? '') }}"
                                    placeholder="Enter Mother's full name">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_birth_date" class="inline-block mb-2 text-base font-medium">Mother's
                                    Birthdate
                                    <sup class="text-green-500">* optional</sup>
                                </label>
                                <input type="date" name="mother_birth_date"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_birth_date', isset($applicant) ? \Carbon\Carbon::parse($applicant->mother_birth_date)->format('Y-m-d') : '') }}"
                                    placeholder="Enter Mothers's Birthdate">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_educ_attain" class="inline-block mb-2 text-base font-medium">Mother's
                                    Educationl Attainment
                                    <sup class="text-green-500">* optional</sup>
                                </label>
                                <input type="text" name="mother_educ_attain"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_educ_attain', $applicant->mother_educ_attain ?? '') }}"
                                    placeholder="Enter Mother's educational attainment">
                            </div><!--end col-->



                            <div class="xl:col-span-4">
                                <label for="mother_occupation" class="inline-block mb-2 text-base font-medium">Mother's
                                    Occupation</label>
                                <input type="text" name="mother_occupation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_occupation', $applicant->mother_occupation ?? '') }}"
                                    placeholder="Enter Mother's Occupation">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_company" class="inline-block mb-2 text-base font-medium">Mother's
                                    Company Name</label>
                                <input type="text" name="mother_company"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_company', $applicant->mother_company ?? '') }}"
                                    placeholder="Enter Mother's Company Name">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_company_address"
                                    class="inline-block mb-2 text-base font-medium">Mother's
                                    Company Address</label>
                                <input type="text" name="mother_company_address"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_company_address', $applicant->mother_company_address ?? '') }}"
                                    placeholder="Enter Mother's Company Address">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_tel_no" class="inline-block mb-2 text-base font-medium">Mother's
                                    Telephone No</label>
                                <input type="text" name="mother_tel_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_tel_no', $applicant->mother_tel_no ?? '') }}"
                                    placeholder="Enter Mother's Telephone #">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="mother_email" class="inline-block mb-2 text-base font-medium">Mother's
                                    Email (Leave it Blank if no email)</label>
                                <input type="text" name="mother_email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('mother_email', $applicant->mother_email ?? '') }}"
                                    placeholder="Enter Mother's email">
                            </div><!--end col-->

                            <div class="mb-4 xl:col-span-4">
                                <label for="mother_income_from" class="inline-block mb-2 text-base font-medium">Mother's
                                    Monthly Income
                                    <sup class="text-red-500">* required</sup></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="mother_income_from">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($applicant) && $applicant->mother_income_from == 1 ? 'selected' : '' }}>
                                        Less than 9,100</option>
                                    <option value="2"
                                        {{ isset($applicant) && $applicant->mother_income_from == 2 ? 'selected' : '' }}>
                                        9,100 to 18,200</option>
                                    <option value="3"
                                        {{ isset($applicant) && $applicant->mother_income_from == 3 ? 'selected' : '' }}>
                                        18,200 to 36,400</option>
                                    <option value="4"
                                        {{ isset($applicant) && $applicant->mother_income_from == 4 ? 'selected' : '' }}>
                                        36,400 to 63,700</option>
                                    <option value="5"
                                        {{ isset($applicant) && $applicant->mother_income_from == 5 ? 'selected' : '' }}>
                                        63,700 to 109,200</option>
                                    <option value="6"
                                        {{ isset($applicant) && $applicant->mother_income_from == 6 ? 'selected' : '' }}>
                                        109,200 to 182,000</option>
                                    <option value="7"
                                        {{ isset($applicant) && $applicant->mother_income_from == 7 ? 'selected' : '' }}>
                                        Above 182,000</option>
                                    <option value="0"
                                        {{ isset($applicant) && $applicant->mother_income_from == 0 ? 'selected' : '' }}>
                                        Not Applicable</option>
                                </select>
                            </div><!--end col-->

                            {{-- Guardian Information --}}
                            <div class="xl:col-span-12">
                                <h6 class="text-green-500 uppercase text-15 xl:col-span-12">GUARDIAN INFORMATION</h6>
                                <p class="text-custom-500">Enter N/A in the fields that are not applicable to you.</p>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="guardian" class="inline-block mb-2 text-base font-medium">Guardian Full
                                    Name
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="text" name="guardian"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian', $applicant->guardian ?? '') }}"
                                    placeholder="Enter Guardian's full name">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_relationship"
                                    class="inline-block mb-2 text-base font-medium">Relationship
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="text" name="guardian_relationship"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_relationship', $applicant->guardian_relationship ?? '') }}"
                                    placeholder="Enter relationship">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_occupation"
                                    class="inline-block mb-2 text-base font-medium">Guardian's
                                    Occupation <sup class="text-red-500">* required</label>
                                <input type="text" name="guardian_occupation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_occupation', $applicant->guardian_occupation ?? '') }}"
                                    placeholder="Enter Guardians's Occupation">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_company" class="inline-block mb-2 text-base font-medium">Guardian's
                                    Company Name <sup class="text-red-500">* required</label>
                                <input type="text" name="guardian_company"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_company', $applicant->guardian_company ?? '') }}"
                                    placeholder="Enter Guardian's Company Name">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_telno" class="inline-block mb-2 text-base font-medium">Guardian's
                                    Telephone No</label>
                                <input type="text" name="guardian_telno"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_telno', $applicant->guardian_telno ?? '') }}"
                                    placeholder="Enter Guardian's Telephone #">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_email" class="inline-block mb-2 text-base font-medium">Guardian's
                                    Email (Leave it Blank if no email)</label>
                                <input type="text" name="guardian_email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_email', $applicant->guardian_email ?? '') }}"
                                    placeholder="Enter Mother's email">
                            </div><!--end col-->

                            {{-- Guardian Address --}}
                            <div class="xl:col-span-12">
                                <h6 class="text-green-500 uppercase text-15 xl:col-span-12">GUARDIAN ADDRESS</h6>
                            </div>

                            <div class="xl:col-span-3">
                                <label for="guardian_region" class="inline-block mb-2 text-base font-medium">Region
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="guardian_region" name="guardian_region">
                                    <option selected="true" disabled>Choose Region</option>
                                </select>
                                <input type="hidden" name="region_text-guardian" id="region-text-guardian" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="guardian_province" class="inline-block mb-2 text-base font-medium">Province
                                    <sup class="text-red-500">* required</sup></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="guardian_province" name="guardian_province">
                                    <option selected="true" disabled>Choose Province</option>
                                </select>
                                <input type="hidden" name="province_text-guardian" id="province-text-guardian" required>
                            </div><!--end col-->
                            <div class="xl:col-span-3">
                                <label for="guardian_towncity"
                                    class="inline-block mb-2 text-base font-medium">Municipality/City
                                    <sup class="text-red-500">* required</sup></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="guardian_towncity" name="guardian_towncity">
                                    <option selected="true" disabled>Choose Municipality</option>
                                </select>
                                <input type="hidden" name="city_text-guardian" id="city-text-guardian" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="guardian_barangay" class="inline-block mb-2 text-base font-medium">Barangay
                                    <sup class="text-red-500">* required</sup></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="guardian_barangay" name="guardian_barangay">
                                    <option selected="true" disabled>Choose Barangay</option>
                                </select>
                                <input type="hidden" name="barangay_text-guardian" id="barangay-text-guardian" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_street" class="inline-block mb-2 text-base font-medium">Street
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <input type="text" id="guardian_street" name="guardian_street"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Street"
                                    value="{{ old('guardian_telno', $applicant->guardian_street ?? '') }}" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="guardian_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                    Code (Number only)<span></label>
                                <input type="text" id="guardian_zipcode" name="guardian_zipcode"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ old('guardian_zipcode', $applicant->guardian_zipcode ?? '') }}"
                                    placeholder="Enter your zipcode">
                            </div><!--end col-->
                        </div><!--end grid-->

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
                                <a href="{{ route('admin.applicant-profile.step3.show', ['id' => $applicant->id]) }}"
                                    class="flex items-center gap-1 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    Next<i data-lucide="arrow-right" class="inline-block size-4 dark:text-zink-200"></i>
                                </a>
                            @endif


                            <a href="{{ route('admin.applicant-profile.step1.show', ['id' => $applicant->id]) }}"
                                class="flex items-center gap-1 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                <i data-lucide="arrow-left" class="inline-block size-4 dark:text-zink-200"></i>
                                Previous
                            </a>

                        </div>

                    </div>
                </div><!--end card-->

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Guardian Addresss --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->guardian_region }}";
            var savedProvince = "{{ $applicant->guardian_province }}";
            var savedCity = "{{ $applicant->guardian_towncity }}";
            var savedBarangay = "{{ $applicant->guardian_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#guardian_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#guardian_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#guardian_region', '#region-text-guardian');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#guardian_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#guardian_region').on('change', function() {
                var region_code = $(this).val();
                $('#guardian_province').empty().append(
                    '<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#guardian_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_province', '#province-text-guardian');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#guardian_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#guardian_province').on('change', function() {
                var province_code = $(this).val();
                $('#guardian_towncity').empty().append(
                    '<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#guardian_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_towncity', '#city-text-guardian');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#guardian_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#guardian_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#guardian_barangay').empty().append(
                    '<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#guardian_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_barangay', '#barangay-text-guardian');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#guardian_region').on('change', function() {
                updateHiddenTextField('#guardian_region', '#region-text-guardian');
            });
            $('#guardian_province').on('change', function() {
                updateHiddenTextField('#guardian_province', '#province-text-guardian');
            });
            $('#guardian_towncity').on('change', function() {
                updateHiddenTextField('#guardian_towncity', '#city-text-guardian');
            });
            $('#guardian_barangay').on('change', function() {
                updateHiddenTextField('#guardian_barangay', '#barangay-text-guardian');
            });
        });
    </script>
@endpush
