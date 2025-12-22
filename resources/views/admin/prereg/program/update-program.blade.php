@extends('admin.layouts.master')
@section('title')
   USM-AES | Pre-registration -Update Program Information
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION <span class="text-custom-500"> UPDATE PROGRAM INFORMATION</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Program</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Update
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">


            @if ($program)
                <form id="updateProgramForm" action="{{ route('admin.prereg.program-policy-details.update', $policyId) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card">

                        <div class="card-body">

                            <h6 class="mb-6 text-blue-500 uppercase text-15">
                                <i data-lucide="user" class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>
                                <b>
                                    {{ $program['programName'] }}
                                    @if (!empty($program['majorDiscDesc']))
                                        - {{ $program['majorDiscDesc'] }}
                                    @endif
                                </b>
                            </h6>

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                {{-- policyId --}}
                                <input type="hidden" name="policyId" value="{{ $program['id'] }}">

                                <div class="xl:col-span-4">
                                    <label for="programName" class="inline-block mb-2 text-base font-medium">Program Name
                                        <sup class="text-red-500">* Required</sup></label>
                                    <input type="text" name="programName"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('programName', $program['programName']) }}">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="majorDiscDesc" class="inline-block mb-2 text-base font-medium">Major
                                        Name</label>
                                    <input type="text" name="majorDiscDesc"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('majorDiscDesc', $program['majorDiscDesc']) }}">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="usmceefp" class="inline-block mb-2 text-base font-medium">First Priority Cut
                                        Off Score</label>
                                    <input type="text" name="usmceefp"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('usmceefp', $program['usmceefp']) }}">
                                </div><!--end col-->
                                <div class="xl:col-span-4">
                                    <label for="pendingLimit"
                                        class="inline-block mb-2 text-base font-medium">Pre-registration Limit</label>
                                    <input type="text" name="pendingLimit"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('pendingLimit', $program['pendingLimit']) }}">
                                </div><!--end col-->



                            </div>
                            <div class="flex gap-2 mt-4">

                                <button type="submit"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    <i data-lucide="save" class="inline-block size-4 dark:text-zink-200"></i> Save Changes
                                </button>


                            </div>
                        </div>

                    </div>
                </form>
            @else
                <p class="text-red-600">Program not found or data is unavailable.</p>
            @endif

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('updateProgramForm');
            const submitBtn = form.querySelector('button[type="submit"]');

            submitBtn.addEventListener('click', function(e) {
                e.preventDefault(); // prevent default submit

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the program policy?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // submit the form if confirmed
                    }
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
