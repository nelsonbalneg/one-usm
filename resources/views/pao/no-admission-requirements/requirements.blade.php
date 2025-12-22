@extends('pao.layouts.master')
@section('title')
    USM-CEE | Student Requirements
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Student Requirements</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Students</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Requirements</a>
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
                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">
                        @php
                            $firstRequirement = $requirements->first();
                        @endphp

                        @if ($firstRequirement && $firstRequirement->user)
                            <div class="lg:col-span-4 2xl:col-span-1">
                                <div
                                    class="relative inline-block rounded-full shadow-md size-20 bg-slate-100 profile-user xl:size-28">
                                    <img src="{{ 'http://172.16.0.43/uploads/' . basename($firstRequirement->user->photo) }}"
                                        alt="User Photo"
                                        class="w-28 h-28 object-cover border-0 rounded-full img-thumbnail user-profile-image">
                                </div>
                            </div>
                            <div class="lg:col-span-8 2xl:col-span-8">
                                <h5 class="mb-1">
                                    {{ $firstRequirement->user->firstname }} {{ $firstRequirement->user->lastname }}
                                    <i data-lucide="badge-check" class="inline-block size-4 text-sky-500 fill-sky-100"></i>
                                </h5>
                                <div class="flex gap-3 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="mail" class="inline size-4 mr-1"></i>
                                    {{ $firstRequirement->user->email }}
                                </div>
                                <div class="flex gap-3 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="phone" class="inline size-4 mr-1"></i>
                                    {{ $firstRequirement->user->phone }}
                                </div>
                                <div class="flex gap-3 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="user" class="inline size-4 mr-1"></i> {{ $firstRequirement->user->sex }}
                                </div>
                            </div>
                        @endif

                    </div><!--end grid-->
                </div>
            </div><!--end card-->
        </div><!--end col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <h6 class="text-15 mb-4" style="text-transform: uppercase;">Requirements Uploaded
                    </h6>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                    </div>
                </div>
                <div class="card-body border-y border-dashed border-slate-200 dark:border-zink-500">
                    <div class="overflow-x-auto">
                        <table id="dataTable" class="w-full whitespace-nowrap" style="width:100%">
                            <thead class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                <tr>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Documents</th>
                                    <th
                                        class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requirements as $requirement)
                                    @foreach ($requirement->toArray() as $key => $value)
                                        @if (!in_array($key, ['id', 'user_id', 'created_at', 'updated_at']) && !empty($value) && $value !== '[]')
                                            @php
                                                $decoded =
                                                    is_string($value) && str_starts_with($value, '[')
                                                        ? json_decode($value, true)
                                                        : null;

                                                $baseFolders = [
                                                    'psa' => 'psa',
                                                    'tor' => 'tor',
                                                    'shs_card' => 'card',
                                                    'enrolment_certification' => 'enrollment_certification',
                                                    'good_moral_char' => 'gmc',
                                                    'honorable_dismisal' => 'honorable_dismisal',
                                                    'hepa_b_test' => 'hepa-b',
                                                    'chest_x_ray' => 'chest-xray',
                                                    'preg_test' => 'pregnancy-test',
                                                ];

                                                $folder = $baseFolders[$key] ?? $key;
                                                $filename =
                                                    !empty($decoded) && is_array($decoded)
                                                        ? basename($decoded[0])
                                                        : null;
                                            @endphp

                                            @if ($filename)
                                                <tr>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 capitalize">
                                                        {{ str_replace('_', ' ', $key) }}
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        <button type="button"
                                                            class="py-1 text-xs px-1.5 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                            onclick="window.open('https://cee.usm.edu.ph/storage/{{ $folder }}/{{ $filename }}', '_blank')">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div><!--end card-->

        </div><!--end col-->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/dataTables.2.2.2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.tailwindcss.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
