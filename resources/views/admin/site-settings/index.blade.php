@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Site Settings
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">General Settings</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Settings</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Site Settings</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Site Settings</h6>
                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">

                    <form id="addDataSite" action="{{ route('admin.site-settings.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                            <div class="xl:col-span-6">
                                <label for="site_name" class="inline-block mb-2 text-base font-medium">Site Name</label>
                                <input type="text" name="site_name" id="site_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Site Name" value="{{ $sitesetting ? $sitesetting->site_name : '' }}"
                                    required>
                            </div><!--end col-->
                            <div class="xl:col-span-6"></div>

                            <div class="xl:col-span-6">
                                <label for="utdc_head" class="inline-block mb-2 text-base font-medium">UTDC Head</label>
                                <input type="text" name="utdc_head" id="utdc_head"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter UTDC Head" value="{{ $sitesetting ? $sitesetting->utdc_head : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="aro_head" class="inline-block mb-2 text-base font-medium">Admission and Records
                                    Office Director</label>
                                <input type="text" name="aro_head" id="aro_head"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Admission and Records Office Director"
                                    value="{{ $sitesetting ? $sitesetting->aro_head : '' }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-6">
                                <label for="di_head" class="inline-block mb-2 text-base font-medium">Director for
                                    Intruction</label>
                                <input type="text" name="di_head" id="di_head"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Director for Intruction"
                                    value="{{ $sitesetting ? $sitesetting->di_head : '' }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-6">
                                <label for="vpaa" class="inline-block mb-2 text-base font-medium">Vice President for
                                    Academic Affairs</label>
                                <input type="text" name="vpaa" id="vpaa"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Vice President for Academic Affairs"
                                    value="{{ $sitesetting ? $sitesetting->vpaa : '' }}" required>
                            </div><!--end col-->


                            <div class="xl:col-span-6">
                                <label for="footer_one" class="inline-block mb-2 text-base font-medium">Footer 1</label>
                                <input type="text" name="footer_one" id="footer_one"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Footer one"
                                    value="{{ $sitesetting ? $sitesetting->footer_one : '' }}" required>
                                <p class="mt-1 text-sm text-slate-400 dark:text-zink-200">Do not exceed 50 characters for
                                    the footer one.</p>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="footer_two" class="inline-block mb-2 text-base font-medium">Footer 2</label>
                                <input type="text" name="footer_two" id="footer_two"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Footer two"
                                    value="{{ $sitesetting ? $sitesetting->footer_two : '' }}" required>
                                <p class="mt-1 text-sm text-slate-400 dark:text-zink-200">Do not exceed 50 characters for
                                    the footer two.</p>
                            </div><!--end col-->

                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-green-500">
                                    ACCOUNT REGISTRATION AND SLOT RESERVATION
                                </h6>
                            </div>

                            <div class="hidden xl:col-span-6">
                                <label for="openreservation" class="inline-block mb-2 text-base font-medium">Open Date of
                                    CEE Reservation</label>
                                <input type="text" id="openreservation" name="openreservation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr" data-date-format="d M, Y"
                                    data-enable-time
                                    value="{{ $sitesetting && $sitesetting->openreservation ? \Carbon\Carbon::parse($sitesetting->openreservation)->format('d M, Y H:i') : '' }}"
                                    disabled>
                            </div><!--end col-->
                            <div class="xl:col-span-6">
                                <label for="endreservation" class="inline-block mb-2 text-base font-medium">End Date of
                                    CEE
                                    Reservation</label>
                                <input type="text" id="endreservation" name="endreservation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->endreservation ? \Carbon\Carbon::parse($sitesetting->endreservation)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="endregistration" class="inline-block mb-2 text-base font-medium">End Date of
                                    CEE
                                    Registration</label>
                                <input type="text" id="endregistration" name="endregistration"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->endregistration ? \Carbon\Carbon::parse($sitesetting->endregistration)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-green-500">
                                    PRE-REGISTRATION SCHEDULE
                                </h6>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="startPrereg" class="inline-block mb-2 text-base font-medium">Start of
                                    Pre-regitration</label>
                                <input type="text" id="startPrereg" name="start_prereg_second_batch"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->start_prereg_second_batch ? \Carbon\Carbon::parse($sitesetting->start_prereg_second_batch)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="endPrereg" class="inline-block mb-2 text-base font-medium">End Date of
                                    CEE
                                    Registration</label>
                                <input type="text" id="endPrereg" name="end_prereg_second_batch"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->end_prereg_second_batch ? \Carbon\Carbon::parse($sitesetting->end_prereg_second_batch)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            {{-- start enrollment period --}}
                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-green-500">
                                    ENROLLMENT SCHEDULE FOR FRESHMEN
                                </h6>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="start_enrollment" class="inline-block mb-2 text-base font-medium">Start of
                                    Enrollment</label>
                                <input type="text" id="start_enrollment" name="start_enrollment"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->start_enrollment ? \Carbon\Carbon::parse($sitesetting->start_enrollment)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="end_enrollment" class="inline-block mb-2 text-base font-medium">End Date of
                                    Enrollment</label>
                                <input type="text" id="end_enrollment" name="end_enrollment"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Select date & time" data-provider="flatpickr"
                                    data-date-format="d M, Y h:i K" data-enable-time
                                    value="{{ $sitesetting && $sitesetting->end_enrollment ? \Carbon\Carbon::parse($sitesetting->end_enrollment)->format('d M, Y h:i A') : '' }}"
                                    required>
                            </div><!--end col-->

                            <div class="xl:col-span-12">
                                <label for="enrollment_announcement"
                                    class="inline-block mb-2 text-base font-medium">Enrollment Announcement</label>
                                <input type="text" id="enrollment_announcement" name="enrollment_announcement"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ $sitesetting && $sitesetting->enrollment_announcement ? $sitesetting->enrollment_announcement : '' }}">
                            </div><!--end col-->

                            {{-- end of enrollment period --}}

                            {{-- start pao enrollment for higher years --}}
                            <div class="mt-2 xl:col-span-12">
                                <h6 class="text-green-500">
                                    ENROLLMENT SCHEDULE FOR HIGHER YEARS
                                </h6>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="enrollment_hy_reg_status"
                                    class="inline-block mb-2 text-base font-medium">Enrollment for Regular Students
                                    Status</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="enrollment_hy_reg_status" id="enrollment_hy_reg_status">
                                    <option value="">--Select--</option>
                                    <option value="1"
                                        {{ $sitesetting && $sitesetting->enrollment_hy_reg_status == 1 ? 'selected' : '' }}>
                                        Open</option>
                                    <option value="0"
                                        {{ $sitesetting && $sitesetting->enrollment_hy_reg_status == 0 ? 'selected' : '' }}>
                                        Close</option>
                                </select>
                            </div>

                            <div class="xl:col-span-6">
                                <label for="enrollment_hy_ireg_status"
                                    class="inline-block mb-2 text-base font-medium">Enrollment for Irregular Students
                                    Status</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="enrollment_hy_ireg_status" id="enrollment_hy_ireg_status">
                                    <option value="">--Select--</option>
                                    <option value="1"
                                        {{ $sitesetting && $sitesetting->enrollment_hy_ireg_status == 1 ? 'selected' : '' }}>
                                        Open</option>
                                    <option value="0"
                                        {{ $sitesetting && $sitesetting->enrollment_hy_ireg_status == 0 ? 'selected' : '' }}>
                                        Close</option>
                                </select>
                            </div>

                            {{-- end pao enrollment for higher years --}}

                            <div class="mt-4 xl:col-span-12">
                                <h6 class="text-green-500">
                                    SITE MAINTENANCE SETTINGS
                                </h6>
                            </div>
                            <div class="xl:col-span-6">
                                <label for="status" class="inline-block mb-2 text-base font-medium">Status</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="status" id="status">
                                    <option value="">--Select--</option>
                                    <option value="1"
                                        {{ $sitesetting && $sitesetting->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0"
                                        {{ $sitesetting && $sitesetting->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="xl:col-span-6">
                                <label for="is_maintenance" class="inline-block mb-2 text-base font-medium">Is
                                    Maintenance?</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    name="is_maintenance" id="is_maintenance">
                                    <option value="">--Select--</option>
                                    <option value="1"
                                        {{ $sitesetting && $sitesetting->is_maintenance == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0"
                                        {{ $sitesetting && $sitesetting->is_maintenance == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <button type="reset"
                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                            <button type="submit"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Save
                                Settings</button>
                        </div>

                    </form>

                </div>
            </div><!--end card-->

            {{-- <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Site Settings</h6>
                    </div>
                </div>
            </div> --}}
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#endreservation", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("endreservation")
                    .value // Ensure Flatpickr uses input value
            });

            // Initialize Flatpickr for #endregistration
            flatpickr("#endregistration", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("endregistration")
                    .value // Ensure Flatpickr uses input value
            });

            // Initialize Flatpickr for #endregistration
            flatpickr("#startPrereg", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("startPrereg")
                    .value // Ensure Flatpickr uses input value
            });

            // Initialize Flatpickr for #endregistration
            flatpickr("#endPrereg", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("endPrereg")
                    .value // Ensure Flatpickr uses input value
            });

            flatpickr("#start_enrollment", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("start_enrollment")
                    .value // Ensure Flatpickr uses input value
            });

            flatpickr("#end_enrollment", {
                enableTime: true, // Enable time picker
                dateFormat: "d M, Y h:i K", // Use 12-hour format with AM/PM
                defaultDate: document.getElementById("end_enrollment")
                    .value // Ensure Flatpickr uses input value
            });
        });
    </script>

    <script>
        document.getElementById('addDataSite').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: form.method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error updating the site settings.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error processing your request.'
                    });
                });
        });
    </script>
@endpush
