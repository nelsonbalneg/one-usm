@extends('student.layouts.master')
@section('title')
    One USM - SAR System
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
<div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
    <div class="grow">
        <h5 class="uppercase text-16 font-semibold text-green-600">SAR System</h5>
    </div>
    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zinc-200">
            <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
        </li>
        <li class="text-slate-700 dark:text-zink-100">
            SAR
        </li>
    </ul>
</div>

<!--start grid-->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

    <!-- SAR System Card -->
    <div class="xl:col-span-12">
        <div class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
            <div class="card-body p-6 flex flex-col md:flex-row items-start gap-6">

                <!-- Content -->
                <div class="flex-1">
                    <h6 class="text-green-600 text-lg font-bold uppercase mb-3">Student Academic Record (SAR) System</h6>
                    <p class="text-slate-500 dark:text-zinc-200 mb-4">
                        The <strong>SAR System</strong> is an online platform that allows students to manage their academic and enrollment records efficiently.
                    </p>
                    <ul class="list-disc list-inside text-slate-500 dark:text-zinc-200 mb-4">
                        <li>Submit confirmation for enrollment each semester.</li>
                        <li>View grades for completed and ongoing subjects.</li>
                        <li>Check curriculum and academic progress.</li>
                        <li>Verify academic standing (Regular or Irregular).</li>
                        <li>Receive notifications when the Registrar has processed enrollment.</li>
                    </ul>
                    <p class="text-slate-500 dark:text-zinc-200 mb-4">
                        The SAR System ensures transparency, accuracy, and convenience for students in tracking their academic journey and enrollment status.
                    </p>

                     <a href="{{ route('student.student.sar.connect') }}" class="inline-block px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600 transition" target="_blank"> Connect to SAR </a>
                </div>

            </div>
        </div>
    </div>

</div><!--end grid-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
