@extends('osa.layouts.master')
@section('title')
    USM-AES | OSA Dashboard
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">
                {{-- @if ($selectedPrograms->isNotEmpty())
                    <h5 class="text-16">OFFICE OF STUDENT AFFAIRS DASHBOARD</h5>
                    <span
                        class='uppercase inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>
                    </span>
                @endif --}}
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">


        <div class="xl:col-span-12 md:col-span-12">
            <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                <div class="card-body">
                    <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">PROGRAMS TAGGED</h6>

                    <p class="mb-4 rounded-md text-slate-500">
                        The figures below represent the number of applicants at each stage of the enrollment process:
                        pending for enrollment, under assessment, and fully enrolled.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>
@endpush
