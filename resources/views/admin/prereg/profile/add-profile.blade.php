@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Add Profile for Pre-registration
@endsection


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
            <li class="text-slate-700 dark:text-zink-100">
                Add Profile
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">

            <div class="card">

                <div class="card-body">


                    <h6 class="text-blue-500 uppercase text-15"><i data-lucide="user"
                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>Student Applicant Details
                    </h6>
                    <p class="text-slate-500">You can only select applicant with published profile.</p>

                    <form id="addstudentProfileForm" action="{{ route('admin.add-applicant-profile.save') }}"
                        method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                            <div class="mt-8 xl:col-span-4">
                                <label for="applicant_id" class="inline-block mb-2 text-base font-medium">
                                    Select Student Applicant
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="applicant_id" data-choices data-choices-search-true>
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="mt-8 xl:col-span-8">
                                <input type="hidden" name="user_id" id="user_id">
                            </div>

                            <div class="xl:col-span-4">
                                <label for="app_no" class="inline-block mb-2 text-base font-medium">CEE Application No
                                    <sup class="text-blue-500">* Read Only</sup></label>
                                <input type="text" name="app_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="csa" class="inline-block mb-2 text-base font-medium">CSA
                                    <sup class="text-blue-500">* Read Only</sup></label>
                                <input type="text" name="csa"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="birthdate" class="inline-block mb-2 text-base font-medium">Birthdate<sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="date" name="birthdate"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date" data-provider="flatpickr" data-date-format="M d, Y"
                                    value="" readonly>

                                <input type="hidden" name="date_of_birth" value="">
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="last_name" class="inline-block mb-2 text-base font-medium">Last Name <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="last_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="first_name" class="inline-block mb-2 text-base font-medium">First Name <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="first_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="middle_name" class="inline-block mb-2 text-base font-medium">Middle Name
                                    <sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="middle_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="ext_name" class="inline-block mb-2 text-base font-medium">Suffix
                                    <sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="ext_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>

                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="mobile_no" class="inline-block mb-2 text-base font-medium">Mobile No <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="mobile_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-2">
                                <label for="gender" class="inline-block mb-2 text-base font-medium">Sex <sup
                                        class="text-red-500">* Required</sup></label>
                                <input type="text" name="gender"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="email" class="inline-block mb-2 text-base font-medium">Email Address
                                    <sup class="text-red-500">* Required</sup></label>
                                <input type="text" name="email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="" readonly>
                            </div><!--end col-->

                            <div class="xl:col-span-12">

                                <h6 class="text-blue-500 uppercase text-15"><i data-lucide="graduation-cap"
                                        class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PROGRAMS OFFERED
                                </h6>
                                <p class="text-green-500">Kindly always check the campus of the program to avoid mistakes.
                                </p>

                            </div>

                            <div class="mt-2 xl:col-span-6">
                                <label for="student_type" class="inline-block mb-2 text-base font-medium">
                                    Select a Program Below
                                    <sup class="text-red-500">* required</sup>
                                </label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="policyId" data-choices data-choices-search-true data-choices-removeItem >
                                    <option value="">Select</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program['id'] }}">
                                            <span class="text-green-500">[{{ $program['realCampus'] }}]</span>
                                            {{ $program['programName'] . '-' . $program['majorDiscDesc'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="mt-8 xl:col-span-6">
                            </div>
                        </div>
                        <div class="flex gap-2 mt-4">

                            <button type="submit" id="saveProfileBtn"
                                class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                <i data-lucide="save" class="inline-block size-4 dark:text-zink-200"></i> Save Profile
                            </button>
                        </div>

                    </form>
                    {{-- form end --}}

                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll("[data-choices]");

            elements.forEach((element) => {
                const choices = new Choices(element, {
                    removeItemButton: true,
                    allowHTML: true,
                    searchEnabled: true,
                    itemSelectText: "Click to select",
                });
            });
        });
    </script>


    <script>
        document.querySelector('select[name="applicant_id"]').addEventListener('change', function() {
            const userId = this.value;
            if (!userId) return;

            // Fix: Add leading slash and properly handle the response
            fetch(`/admin/pre-registration/add-applicant/get-user-data/${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    document.querySelector('input[name="user_id"]').value = data.user_id || '';
                    document.querySelector('input[name="first_name"]').value = data.firstname || '';
                    document.querySelector('input[name="middle_name"]').value = data.middlename || '';
                    document.querySelector('input[name="last_name"]').value = data.lastname || '';
                    document.querySelector('input[name="birthdate"]').value = data.birthdate || '';
                    document.querySelector('input[name="date_of_birth"]').value = data.birthdate || '';
                    document.querySelector('input[name="app_no"]').value = data.app_no || '';
                    document.querySelector('input[name="csa"]').value = data.csa || '';
                    document.querySelector('input[name="mobile_no"]').value = data.phone || '';
                    document.querySelector('input[name="gender"]').value = data.sex || '';
                    document.querySelector('input[name="email"]').value = data.email || '';
                    document.querySelector('input[name="ext_name"]').value = data.suffix || '';
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                    // Optionally show an error message to the user
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to fetch user data. Please try again.',
                    });
                });
        });
    </script>

    {{-- pop up save button --}}
    <script>
        document.getElementById('saveProfileBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent immediate form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to save this profile.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addstudentProfileForm').submit();
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#16a34a',
            });
        </script>
    @endif

    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('message') }}",
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessages,
            });
        </script>
    @endif
@endpush
