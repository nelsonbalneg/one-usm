@extends('aro.layouts.master')
@section('title')
    USM-AES | Pre-registration - Dashboard
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/choices/choices.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION DASHBOARD <span class="text-custom-500">1ST SEMESTER SY 2025-2026</span>
            </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

        <div
            class=" bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-3 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center rounded-md bg-sky-500 size-12 text-15 text-sky-50">
                    <i data-lucide="check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $prereg_pending }}"></span></h5>
                <p class="text-slate-500 dark:text-slate-200">Pending for Enrollment</p>
            </div>
        </div><!--end col-->

        <div
            class=" bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-3 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="circle"
                    class="absolute top-0 stroke-1 size-32 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-orange-500 rounded-md size-12 text-15 text-orange-50">
                    <i data-lucide="circle"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $prereg_for_ranking }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">For Ranking </p>
            </div>
        </div><!--end col -->
        {{-- {{ $count_published }} --}}

        <div
            class=" bg-green-100 dark:bg-green-500/20 card 2xl:col-span-3 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                    <i data-lucide="users"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $total_pend_for_ranking }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">Pending + For Ranking</p>
            </div>
        </div><!--end col-->

        <div
            class=" bg-purple-100 dark:bg-purple-500/20 card 2xl:col-span-3 group-data-[skin=bordered]:border-purple-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 stroke-1 size-32 text-purple-200/50 dark:text-purple-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center bg-purple-500 rounded-md size-12 text-15 text-purple-50">
                    <i data-lucide="thumbs-up"></i>
                </div>
                <a href="{{ route('aro.prereg.enrolled-applicants-summary.index') }}" target="_blank">
                    <h5 class="mt-4 mb-2">
                        <span class="counter-value" data-target="{{ $prereg_step_6 }}"></span>
                    </h5>
                </a>
                <p class="text-slate-500 dark:text-zink-200">Total Enrolled Applicants </p>
            </div>
        </div><!--end col-->



    </div>
@endsection
@push('scripts')
    <!-- JS for Search -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTable tbody .program-row');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
    </script>

    <script>
        document.getElementById('searchInputforRanking').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTableforRanking tbody .program-row-for-ranking');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
    </script>
@endpush
