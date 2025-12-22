@extends('aro.layouts.master')
@section('title')
    USM-AES | Pre-registration -  Student Requirements
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
                    <div class="lg:col-span-4 2xl:col-span-1">
                        <div
                            class="relative inline-block rounded-full shadow-md size-20 bg-slate-100 profile-user xl:size-28">
                            <img src="./assets/images/avatar-1.png" alt=""
                                class="object-cover border-0 rounded-full img-thumbnail user-profile-image">
                            <div
                                class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                <input id="profile-img-file-input" type="file"
                                    class="hidden profile-img-file-input">
                                <label for="profile-img-file-input"
                                    class="flex items-center justify-center bg-white rounded-full shadow-lg cursor-pointer size-8 dark:bg-zink-600 profile-photo-edit">
                                    <i data-lucide="image-plus"
                                        class="size-4 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                </label>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="lg:col-span-8 2xl:col-span-8">
                        <h5 class="mb-1">Paula Keenan <i data-lucide="badge-check"
                                class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i>
                        </h5>
                        <div class="flex gap-3 mb-4">
                            <p class="text-slate-500 dark:text-zink-200"><i data-lucide="user-circle"
                                    class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                CEO & Founder</p>
                            <p class="text-slate-500 dark:text-zink-200"><i data-lucide="map-pin"
                                    class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                Los Angeles, California</p>
                        </div>
                        <div class="lg:col-span-2">
                            <h2 class="mb-4 text-25">Requirements</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Good Moral</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="directMessage" id="directMessage"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="directMessage"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Form 138</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="emailNotification" id="emailNotification"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="emailNotification"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">PSA</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="chatNotification" id="chatNotification"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="chatNotification"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2">
                                    <div>
                                        <h4 class="text-15">Honorable Dismissal</h4>
                                    </div>
                                    <div class="shrink-0">
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <input type="checkbox" name="showPurchase" id="showPurchase"
                                                class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer size-5 border-slate-200 dark:border-zink-600 bg-white/80 dark:bg-zink-400 peer/published checked:bg-custom-500 dark:checked:bg-custom-500 ltr:checked:right-0 rtl:checked:left-0 checked:border-custom-100 dark:checked:border-custom-900 arrow-none checked:bg-none"
                                                checked="">
                                            <label for="customSoftSwitch"
                                                class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-custom-100 dark:peer-checked/published:bg-custom-900 peer-checked/published:border-custom-100 dark:peer-checked/published:border-custom-900"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end grid-->
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
