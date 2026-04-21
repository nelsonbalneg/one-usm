@extends('student.layouts.master')
@section('title')
    One USM - CCD Cares
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
<div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
    <div class="grow">
        <h5 class="uppercase text-16 font-semibold text-green-600">CCD CARES</h5>
    </div>
    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zinc-200">
            <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
        </li>
        <li class="text-slate-700 dark:text-zink-100">
            CCD Cares
        </li>
    </ul>
</div>

<!--start grid-->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

    <div class="xl:col-span-12">
        <!--start card-->
        <div class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
            <div class="card-body flex flex-col md:flex-row items-center gap-6 p-6">

                <!-- Content -->
                <div class="flex-1">
                    <h6 class="text-green-600 text-lg font-bold uppercase mb-2">Enhance Your Well-being</h6>
                    <p class="mb-4 text-slate-500 dark:text-zinc-200">
                        CCD Cares App helps USM students monitor and improve their psychosocial well-being through screening and personalized coaching. 
                        Assess your mental state, build resilience, and access timely guidance for growth and support.
                    </p>
                 <a href="{{ route('student.student.ccdcares.connect') }}" class="inline-block px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600 transition" target="_blank"> Connect to CCD Cares </a>
                </div>

            </div>
        </div><!--end card-->
    </div><!--end col-->

</div><!--end grid-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
