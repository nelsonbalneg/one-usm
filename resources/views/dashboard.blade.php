@extends('student.layouts.master')
@section('title')
    USM Hiraya - Dashboard
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM Hiraya - College of Medicine | Admission System</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                My Profile
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            {{-- @if (!empty($alert)) --}}
            <div class="card">
                <div class="card-body">
                    {{-- <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">

                            <form id="profile-form" action="{{ route('student.cee.update-photo', ['id' => $studentdetails->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="lg:col-span-2 2xl:col-span-1">
                                    <div
                                        class="relative inline-block rounded-full shadow-md size-21 bg-slate-100 profile-user xl:size-28">
                                        @if (empty($studentdetails->photo))
                                            <img src="data:image/jpeg;base64,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"
                                                alt="" name='photo'
                                                class="object-cover w-full h-full rounded-full user-profile-image">
                                        @else
                                            <img src="{{ asset($studentdetails->photo) }}" alt=""
                                                class="object-cover w-full h-full rounded-full user-profile-image">
                                        @endif
                                        <div
                                            class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                            <input id="profile-img-file-input" name="photo" type="file"
                                                class="hidden profile-img-file-input">
                                            <label for="profile-img-file-input"
                                                class="flex items-center justify-center bg-white rounded-full shadow-lg cursor-pointer size-8 dark:bg-zink-600 profile-photo-edit">
                                                <i data-lucide="image-plus"
                                                    class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div><!--end col-->

                            </form>



                            <div class="lg:col-span-10 2xl:col-span-9">
                                <h5 class="mb-1">Hi! {{ $studentdetails->firstname }} {{ $studentdetails->middlename }}
                                    {{ $studentdetails->lastname }} {{ $studentdetails->ssuffix }} <i
                                        data-lucide="badge-check"
                                        class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i>
                                </h5>
                                <div class="flex gap-3 mb-4">
                                    <p class="text-slate-500 dark:text-zink-200"><i data-lucide="phone"
                                            class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                        {{ $studentdetails->phone }}</p>
                                    <p class="text-slate-500 dark:text-zink-200"><i data-lucide="mail"
                                            class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                        {{ $studentdetails->email }}</p>
                                </div>
                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                        class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                    Please take time to complete your profile to be able to reserve a slot in USM-CEE 2025.
                                </p>
                                <p class="text-orange-500 text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                        class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                    Please
                                    ensure that you provide
                                    accurate and
                                    correct information.</p>
                                <p class="text-orange-500 text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                        class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                    Double-check
                                    all details before submitting, as you will not be able to edit them once saved.</p>
                            </div>
                        </div><!--end grid--> --}}
                </div>
            </div><!--end card-->
            {{-- @endif --}}
            <div class="card">
                <div class="card-body">

                    <h6 class="mb-5 text-blue-500 text-15">School Information</h6>
                    {{-- <p class="mb-4 text-slate-500 dark:text-zink-200">Update your photo and personal details here easily. --}}
                    </p>

                    {{-- <form action="{{ route('student.profile.update', ['profile' => $studentdetails->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="xl:col-span-8">
                        </div>
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                            @if (empty($studentdetails->lrn))
                            <div class="mb-2 xl:col-span-4">
                                <label for="lrn" class="inline-block mb-2 text-base font-medium">Upload School ID
                                    Picture
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="file" id="schoolIdPicture" name="image"
                                    class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    placeholder="Upload your school id picture">
                            </div>
                            @endif


                            <div class="xl:col-span-8">
                            </div>


                            <div class="xl:col-span-6">
                                <label for="lrn" class="inline-block mb-2 text-base font-medium">Learner Reference
                                    Number<sup class="text-blue-500">* read only</sup></label>
                                <input type="text" id="lrn" name="lrn"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter your 12 digits LRN" value="{{ $studentdetails->lrn }}" readonly>
                                @error('lrn')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="track" class="inline-block mb-2 text-base font-medium">Track<sup
                                        class="text-red-500">* required</sup></label>
                                <input type="text" id="track" name="track"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter your SHS track" value="{{ $studentdetails->track }}">
                                @error('track')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="choices-single-default" class="inline-block mb-2 text-base font-medium">School
                                    ID <sup class="text-red-500">* required</sup></label>
                                <input type="text" id="school_id" name="school_id"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="School ID" value="{{ $studentdetails->schoolid }}"
                                    onchange="handleChange(this.value)">
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="school_name" class="inline-block mb-2 text-base font-medium">School Name <sup
                                        class="text-blue-500">* read only</sup></span></label>
                                <input type="text" id="school_name" name="school_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    readonly placeholder=" School Name" value="{{ $studentdetails->shs_school }}">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="school_address" class="inline-block mb-2 text-base font-medium">School Address
                                    <sup class="text-blue-500">* read only</sup></label>
                                <input type="text" id="school_address" name="school_address"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    readonly placeholder="Enter School Address"
                                    value="{{ $studentdetails->school_address }}">
                            </div><!--end col-->


                            <div class="xl:col-span-12">
                                <h6 class="mb-1 text-blue-500 text-15">Address</h6>
                                <p class="mb-4 text-slate-500 dark:text-zink-200">Update your photo and personal details
                                    here easily.</p>
                            </div>

                            <div class="xl:col-span-3">
                                <label for="region" class="inline-block mb-2 text-base font-medium">Region <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="region" name="region">
                                    <option selected="true" disabled>Choose Region</option>
                                </select>
                                <input type="hidden" name="region_text" id="region-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="province" class="inline-block mb-2 text-base font-medium">Province <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="province" name="province">
                                    <option selected="true" disabled>Choose Province</option>
                                </select>
                                <input type="hidden" name="province_text" id="province-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="city" class="inline-block mb-2 text-base font-medium">Municipality/City
                                    <span class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="city" name="city">
                                    <option selected="true" disabled>Choose Municipality</option>
                                </select>
                                <input type="hidden" name="city_text" id="city-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="barangay" class="inline-block mb-2 text-base font-medium">Barangay <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="barangay" name="barangay">
                                    <option selected="true" disabled>Choose Barangay</option>
                                </select>
                                <input type="hidden" name="barangay_text" id="barangay-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="street" class="inline-block mb-2 text-base font-medium">Street<span></label>
                                <input type="text" id="street" name="street"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Street" value="{{ $studentdetails->street }}">
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                    Code<span></label>
                                <input type="text" id="track" name="zipcode"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter your zipcode" value="{{ $studentdetails->zipcode }}">
                            </div><!--end col-->

                            @if (empty($studentdetails->lrn))
                            <div class="flex justify-end gap-2 xl:col-span-12">
                                <button type="button"
                                    class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                        data-lucide="x" class="inline-block size-4"></i> <span
                                        class="align-middle">Cancel</span></button>
                                <button type="submit"
                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Submit</button>
                            </div><!--end col-->
                            @endif

                    </form> --}}

                    <!--end form-->
                </div>




            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection

@push('scripts')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('message') }}", // Retrieve the message from session
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                            "{{ route('student.dashboard') }}"; // Redirect after confirmation
                    }
                });
            });
        </script>
    @endif

    <script>
        document.getElementById('profile-img-file-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Preview the selected image
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Automatically submit the form after previewing
                document.getElementById('profile-form').submit();
            }
        });

        document.getElementById('schoolIdPicture').addEventListener('change', async function(event) {
            const formData = new FormData();
            const uploadImageUrl = "{{ route('student.upload_image') }}";
            const imageFile = event.target.files[0];
            const lrn = document.getElementById(
                "lrn"); // Assuming this is an input field for displaying the extracted number
            const school_id = document.getElementById("school_id");
            formData.append('image', imageFile);

            // Retrieve the CSRF token from the meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            try {
                // const response = await fetch("http://127.0.0.1:8000/student/cee/upload-image", {
                //     method: 'POST',
                //     body: formData,
                //     headers: {
                //         'X-CSRF-TOKEN': csrfToken,
                //         'X-Requested-With': 'XMLHttpRequest' // Helps Laravel recognize it as an AJAX request
                //     }
                // });

                const response = await fetch(uploadImageUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                // Set the extracted 12-digit number to the `lrn` input field if available
                if (result.success && result['twelve_digit_number']) {
                    lrn.value = result['twelve_digit_number'];
                    school_id.value = result['six_digit_number'];
                    schoolid = result['six_digit_number'];
                    handleChange(schoolid);
                    Toastify({
                        text: "LRN: " + result['twelve_digit_number'],
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#48bb78", // orange for success
                        className: "success",
                    }).showToast();
                } else {
                    Toastify({
                        text: result.error,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f56565", // Red for error
                        className: "error",
                    }).showToast();
                }

            } catch (error) {
                Toastify({
                    text: 'An error occurred while processing the image.',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f56565", // Red for error
                    className: "error",
                }).showToast();
            }
        });

        async function handleChange(schoolid) {
            const school_name = document.getElementById("school_name");
            const school_address = document.getElementById("school_address");

            // If schoolid is empty, clear the fields and return early
            if (!schoolid) {
                clearSchoolFields(school_name, school_address);
                return;
            }

            try {
                const data = await fetchSchoolData(schoolid);

                if (Array.isArray(data) && data.length > 0) {
                    const school = data[0];
                    populateSchoolFields(school, school_name, school_address);
                } else {
                    handleSchoolNotFound(school_name, school_address);
                }
            } catch (error) {
                school_name.value = '';
                school_address.value = '';
            }
        }

        // Fetch school data from the server
        async function fetchSchoolData(schoolid) {
            // const url = schoolid ?
            //     `http://127.0.0.1:8000/student/cee/schoolname?schoolid=${encodeURIComponent(schoolid)}` :
            //     'http://127.0.0.1:8000/student/cee/schoolname';

            const schoolListUrl = "{{ route('school_list.index') }}";
            const url = schoolid ?
                `${schoolListUrl}?schoolid=${encodeURIComponent(schoolid)}` :
                schoolListUrl;

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                school_name.value = '';
                school_address.value = '';
            }

            return await response.json();
        }

        // Populate school fields if data is found
        function populateSchoolFields(school, school_name, school_address) {
            school_name.value = school.school_name;
            school_address.value = school.school_address;
        }

        // Handle scenario when school is not found
        function handleSchoolNotFound(school_name, school_address) {
            alert('School not found');
            clearSchoolFields(school_name, school_address);
        }

        // Clear the school name and address fields
        function clearSchoolFields(school_name, school_address) {
            school_name.value = '';
            school_address.value = '';
        }

        $(document).ready(function() {

            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "I confirm that all data has been reviewed and is accurate. I understand that once saved, I will no longer be able to edit the information.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        this.submit();
                    }
                });
            });

            // URLs for JSON files
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            // Saved values from the database (passed from the backend)
            var savedRegion = "{{ $studentdetails->region }}";
            var savedProvince = "{{ $studentdetails->province }}";
            var savedCity = "{{ $studentdetails->city }}";
            var savedBarangay = "{{ $studentdetails->brgy }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#region', '#region-text');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#region').on('change', function() {
                var region_code = $(this).val();
                $('#province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#province', '#province-text');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#province').on('change', function() {
                var province_code = $(this).val();
                $('#city').empty().append('<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#city').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#city', '#city-text');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#city').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#city').on('change', function() {
                var city_code = $(this).val();
                $('#barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#barangay', '#barangay-text');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#region').on('change', function() {
                updateHiddenTextField('#region', '#region-text');
            });
            $('#province').on('change', function() {
                updateHiddenTextField('#province', '#province-text');
            });
            $('#city').on('change', function() {
                updateHiddenTextField('#city', '#city-text');
            });
            $('#barangay').on('change', function() {
                updateHiddenTextField('#barangay', '#barangay-text');
            });
        });
    </script>

    <script>
        document.getElementById('profile-img-file-input').addEventListener('change', function(event) {
            const imageInput = event.target;
            const reader = new FileReader();

            // When the file is loaded, update the image preview
            reader.onload = function(e) {
                document.querySelector('.user-profile-image').src = e.target.result;
            }

            // Read the file if it exists
            if (imageInput.files && imageInput.files[0]) {
                reader.readAsDataURL(imageInput.files[0]);
            }
        });
    </script>
@endpush
