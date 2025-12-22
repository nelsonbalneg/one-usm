@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Emergency Contact Information
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
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Educational Background</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Emergency Contact Information
            </li>
        </ul>
    </div>


    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

            <div class="xl:col-span-12">
                <form id="studentProfileForm" action="{{ route('admin.applicant-profile.step4.save') }}" method="POST">
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
                                <div class=" xl:col-span-12">
                                    <h6 class="text-blue-500 uppercase text-15"><i data-lucide="shield-alert"
                                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> EMERGENCY
                                        CONTACT
                                        DETAILS
                                    </h6>
                                </div>




                                {{-- Emergency --}}
                                <div class="xl:col-span-4">

                                    <input type="hidden" name="user_id" value="{{ $applicant->id }}">
                                    <input type="hidden" name="applicant_prof_id" value="{{ $applicant->id }}">

                                    <label for="emergency_contact" class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Full Name <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="emergency_contact"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_contact', $applicant->emergency_contact ?? '') }}"
                                        placeholder="Enter Emergency Contact Full Name " />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="emergency_mobileno"
                                        class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Mobile No.<sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="emergency_mobileno"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_mobileno', $applicant->emergency_mobileno ?? '') }}"
                                        placeholder="Enter Emergency Contact Mobile No.">
                                </div><!--end col-->
                                <div class="xl:col-span-4">
                                    <label for="emergency_telno" class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Telephone No.<sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="emergency_telno"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_telno', $applicant->emergency_telno ?? '') }}"
                                        placeholder="Enter Emergency Contact Telephone No.">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="emergency_address" class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Address<sup class="text-red-500">* requred</sup></label>
                                    <input type="text" name="emergency_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_address', $applicant->emergency_address ?? '') }}"
                                        placeholder="Enter Emergency Contact Address">
                                </div><!--end col-->
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
                                    <a href="{{ route('admin.applicant-profile.step5.show',['id' => $applicant->id]) }}"
                                        class="flex items-center gap-1 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        Next<i data-lucide="arrow-right"
                                            class="inline-block size-4 dark:text-zink-200"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.applicant-profile.step3.show',['id' => $applicant->id]) }}"
                                    class="flex items-center gap-1 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-green-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                    <i data-lucide="arrow-left" class="inline-block size-4 dark:text-zink-200"></i>
                                    Previous
                                </a>
                            </div>
                        </div>
                        {{-- end card body --}}
                    </div>


                </form>
            </div>
    </div>
@endsection
