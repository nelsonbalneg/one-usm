@extends('admin.layouts.master')
@section('title')
    USM-AES | Pre-registration - Profile Complete
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
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Emergency Contact Information</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Final Step
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                        <div class="xl:col-span-12">
                            <div class="px-4 py-6 mx-auto text-center lg:w-2/3">

                                @if ($applicant->applicant_profile_status == 1)
                                    <i data-lucide="check-circle"
                                        class="block w-10 h-10 mx-auto mb-4 text-green-500 fill-green-100 dark:fill-green-500/20 animate-icons"></i>

                                    <h5 class="mb-2 uppercase">Student Applicant Profile has been published
                                        successfully! 🎉</h5>
                                    <p class="mb-5 text-slate-500 text-15">
                                        Congratulations! Your profile has been successfully saved and published.
                                    </p>
                                @else
                                    <i data-lucide="pen"
                                        class="block w-10 h-10 mx-auto mb-4 text-yellow-500 fill-yellow-100 dark:fill-yellow-500/20 animate-icons"></i>

                                    <h5 class="mb-2 uppercase">Student Applicant Profile has been saved as a DRAFT!🎉
                                    </h5>
                                    <p class="mb-5 text-slate-500 text-15">
                                        You can still update your information while your profile status is in DRAFT.
                                        Kindly
                                        click the previous button to go back.
                                        Please review all the details carefully.
                                        If there are any incorrect entries, you can update them. Once everything is
                                        correct,
                                        click the <b>'Publish'</b> button to finalize.
                                    </p>
                                @endif

                                @if (
                                    $applicant->applicant_profile_status == 0 ||
                                        empty($applicant->applicant_profile_status) ||
                                        is_null(value: $applicant->applicant_profile_status))
                                    <button type="submit" id="publishButton" data-id="{{ $applicant->id }}"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="save" class="inline-block size-4 dark:text-zink-200"></i>
                                        Publish</button>
                                @else
                                @endif
                            </div>

                        </div>


                    </div>

                    <div class="flex justify-between mt-4">
                        <a href="{{ route('admin.applicant-profile.step4.show', ['id' => $applicant->id]) }}"
                            class="flex items-center gap-1 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-green-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                            <i data-lucide="arrow-left" class="inline-block size-4 dark:text-zink-200"></i>
                            Previous
                        </a>
                    </div>
                </div>
                {{-- END card body --}}
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
