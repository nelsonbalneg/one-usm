@extends('admin.layouts.master')
@section('title')
    USM-AES | First Generation Students Index
@endsection


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">AES - First Generation Freshmen Students </h5>
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
                <a href="#!" class="text-slate-400 dark:text-zink-200">Analytics</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                First Generation Students
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
                    <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">First Generation Students for
                        {{ $data->isNotEmpty() ? $data->first()->session_name : '-' }}</h6>

                    <p class="rounded-md text-slate-500">
                        The data below show the number of first generation enrolled freshmen students.
                    </p>
                </div>


                <div class="overflow-x-auto border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-2">
                        <div>
                            <div class="relative xl:w-3/6">
                                <input type="text"
                                    class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Search for ..." autocomplete="off">
                                <i data-lucide="search"
                                    class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                            </div>
                        </div>

                        <div class="ltr:md:text-end rtl:md:text-start">
                            <a href="{{ route('admin.preregistration.analytics.first-generation-students.export-excel', $termid) }}"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600">
                                <i class="align-bottom ri-file-excel-2-line me-2 size-4"></i>
                                Export to Excel
                            </a>
                        </div>
                    </div>

                    <table class="w-full whitespace-nowrap" id="firstGenTable">
                        <thead class="bg-slate-100 dark:bg-zink-600">
                            <tr>
                                <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                    data-sort="cee_term">CEE Term</th>
                                <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                    data-sort="campus">Campus</th>
                                <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                    data-sort="program">Program</th>
                                <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                    data-sort="first_generation_students">First Gen Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                @php
                                    $isTotal = $row->programName === 'TOTAL' && $row->campusName !== 'TOTAL';
                                    $isOverallTotal = $row->programName === 'TOTAL' && $row->campusName === 'TOTAL';
                                @endphp

                                <tr
                                    class="@if ($isOverallTotal) bg-green-400 text-green-600 @elseif($isTotal) bg-green-200 text-green-600 @endif">
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 cee_term">
                                        {{ $row->session_name ?? '-' }}
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 campus">
                                        {{ $row->campusName }}
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 program">
                                        {{ $row->programName }}
                                    </td>
                                    <td
                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 first_generation_students">
                                        <span
                                            class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                        @if ($isOverallTotal || $isTotal) bg-green-200 text-green-800 border-800
                        @else
                            bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent @endif">
                                            {{ $row->first_generation_students }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div><!--end card-->

        </div><!--end col-->


    </div><!--end grid-->
@endsection

@push('scripts')
    {{-- script for search --}}
    <script>
        // Wait until the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search');
            const table = document.getElementById('firstGenTable');
            const rows = table.querySelectorAll('tbody tr');

            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let match = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(query)) {
                            match = true;
                        }
                    });

                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
