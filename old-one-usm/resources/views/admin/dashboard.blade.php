@extends('admin.layouts.master')
@section('title')
    One USM - Dashboard
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">One USM - Dashboard</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->

            <div class="card">
                <div class="card-body">

                    <h6 class="text-green-500 uppercase text-15">Announcements</h6>
                    <p class="mb-4 text-slate-500 dark:text-zink-200">All recent announcements will be displayed here.
                    </p>


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
                            "{{ route('admin.dashboard') }}"; // Redirect after confirmation
                    }
                });
            });
        </script>
    @endif

@endpush
