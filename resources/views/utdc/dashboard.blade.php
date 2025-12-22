@extends('utdc.layouts.master')
@section('title')
     USM-AES | UTDC Dashboard
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            {{-- <li class="text-slate-700 dark:text-zink-100">
            Dahboard
        </li> --}}
        </ul>
    </div>
    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="relative col-span-12 overflow-hidden card 2xl:col-span-8 bg-slate-900">
            <div class="absolute inset-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-100" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="1440"
                    height="560" preserveAspectRatio="none" viewBox="0 0 1440 560">
                    <g mask="url(&quot;#SvgjsMask1000&quot;)" fill="none">
                        <use xlink:href="#SvgjsSymbol1007" x="0" y="0"></use>
                        <use xlink:href="#SvgjsSymbol1007" x="720" y="0"></use>
                    </g>
                    <defs>
                        <mask id="SvgjsMask1000">
                            <rect width="1440" height="560" fill="#ffffff"></rect>
                        </mask>
                        <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                        <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                        <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                        <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                        <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                        <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                    </defs>
                    <symbol id="SvgjsSymbol1007">
                        <use xlink:href="#SvgjsPath1001" x="30" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="90" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="90" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="150" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1004" x="150" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="150" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="210" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="210" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="270" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="90" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="270" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="330" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="390" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="390" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="450" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="510" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="510" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="510" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="510" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="570" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="450" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="690" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                    </symbol>
                </svg>
            </div>
            <div class="relative card-body">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                        <h5 class="mb-3 font-normal tracking-wide text-slate-200">Welcome {{ Auth::user()->firstname }}
                            {{ Auth::user()->middlename }} {{ Auth::user()->lastname }} 🎉</h5>
                        <p class="mb-5 text-slate-400">University of Southern Mindanao - College Entrance Examination
                            System v4.0</p>
                        <button type="button"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">
                            CEE Exam Term: {{ $ceesessionactive->name }} - [{{ $ceesessionactive->id }}]</button>
                    </div>
                    <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                        <img src="{{ asset('backend/assets/images/dashboard.png') }}" alt=""
                            class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card 2xl:col-span-4 2xl:row-span-2">

            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">Sex Orientation Statistics</h6>
                </div>
                <div id="sexStatisticsChart" class="apex-charts" data-chart-colors="['#6b46c1', '#0ea5e9']"
                    dir="ltr"></div>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div
                    class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                    <i data-lucide="users"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value"
                        data-target="{{ $reg_user }}">{{ $reg_user }}</span></h5>
                <p class="text-slate-500 dark:text-zink-200">Registered Users</p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div
                    class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                    <i data-lucide="calendar-check"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value"
                        data-target="{{ $reservationDataByCEESession->reservation_count }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">CEE Reservations</p>
                <p><b>{{ $ceesessionactive->name }}</b></p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div
                    class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                    <i data-lucide="store"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $activeslots }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">Reserved Rooms</p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div
                    class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                    <i data-lucide="warehouse"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $activerooms }}"></span></h5>
                <p class="text-slate-500 dark:text-zink-200">Active Rooms</p>
            </div>
        </div>

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">Reservation By First Priority Program</h6>
                    <div class="shrink-0">
                        <a type="button" href="{{ route('utdc.export.reservations') }}"
                            class="bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                                class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export</a>
                        {{-- <a type="button" href="{{ route('admin.export.reservations') }}"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            <i data-lucide="sheet" class="inline-block size-4"></i>
                            <span class="align-middle">Excel</span>
                        </a> --}}
                    </div>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <table id="dbData" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="ltr:!text-left rtl:!text-right">No</th>
                            <th>Program Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div><!--end col-->

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">Reservation By Municipality</h6>
                    {{-- <div class="shrink-0">
                        <button type="button"
                            class="bg-white border-dashed shrink-0 text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i
                                class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export</button>
                    </div> --}}
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <table id="dataMun" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="ltr:!text-left rtl:!text-right">No</th>
                            <th>Municipality</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div><!--end col-->

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">Reservation By School</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <table id="dataSchool" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="ltr:!text-left rtl:!text-right">No</th>
                            <th>School</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div><!--end col-->

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">CEE Reservations per Campus</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="stackedBarChart" class="apex-charts" dir="ltr"></div>
            </div>
        </div><!--end col-->

        <div class="col-span-3 card 2xl:col-span-3 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="mb-4 text-15">Slot Reservation Turnout</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="gradientChart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>

        <div class="col-span-3 card 2xl:col-span-3 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="mb-4 text-15">Reservations vs Confirmed Reservations</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <div id="gradientChart2" class="apex-charts" dir="ltr"></div>
            </div>
        </div>

        <div class="col-span-12 card 2xl:col-span-6 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center">
                    <h6 class="text-15 grow">CEE Reservations</h6>
                </div>
            </div>
            <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                <h6 class="mb-4 text-15">Daily Reservation Statistics</h6>


                <div id="dateTimeChart" class="apex-charts" data-chart-colors='["bg-custom-500"]' dir="ltr"></div>
            </div>
        </div><!--end col-->

    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/datatables.init.js') }}"></script>


    {{-- Reservation per day Statistics --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.querySelector('#dateTimeChart');

            // Fetch data from the backend
            fetch('{{ route('utdc.reservations.per-day') }}')
                .then(response => response.json())
                .then(data => {
                    // Transform data into the format required by ApexCharts
                    const dates = data.map(item => item.reservation_date); // Extract reservation dates
                    const counts = data.map(item => item.daily_total); // Extract daily totals

                    // Function to format the date to '12-May-24'
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const day = date.getDate().toString().padStart(2, '0'); // Two-digit day
                        const month = date.toLocaleString('default', {
                            month: 'short'
                        }); // Abbreviated month
                        const year = date.getFullYear().toString().slice(-2); // Last 2 digits of the year
                        return `${day}-${month}-${year}`;
                    }

                    // Format dates for x-axis categories
                    const formattedDates = dates.map(formatDate);

                    // Initialize ApexCharts
                    const options = {
                        chart: {
                            type: 'line', // or 'area' for an area chart
                            height: 350,
                            toolbar: {
                                show: false,
                            },
                        },
                        series: [{
                            name: 'Daily Reservations',
                            data: counts // Use daily totals
                        }],
                        xaxis: {
                            type: 'category', // Change to 'category' for custom labels
                            categories: formattedDates, // Use formatted reservation dates
                            labels: {
                                formatter: function(val) {
                                    return val; // Already formatted in 'formattedDates'
                                },
                            },
                            title: {
                                text: 'Date',
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Reservations Count',
                            },
                        },
                        colors: ['#0d6efd'], // Customize colors if needed
                        tooltip: {
                            x: {
                                formatter: function(val, opts) {
                                    // Format tooltip date
                                    return formatDate(dates[opts.dataPointIndex]);
                                },
                            },
                        },
                    };

                    const chart = new ApexCharts(chartElement, options);
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Replace with actual data from PHP
            var seriesData = {!! json_encode(array_values($sexStatistics)) !!};
            var categories = {!! json_encode(array_keys($sexStatistics)) !!};

            // Check if there’s data to render
            if (seriesData.length === 0) {
                console.error("No data available for chart.");
                return;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true
                },
                series: [{
                    name: 'Users',
                    data: seriesData
                }],
                xaxis: {
                    categories: categories
                },
                colors: ['#6b46c1', '#0ea5e9'], // Adjust colors as needed
                legend: {
                    position: 'top'
                },
                plotOptions: {
                    bar: {
                        horizontal: false
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#sexStatisticsChart"), options);
            chart.render();
        });
    </script>

    <script>
        $(document).ready(function() {
            loadData();
            loadDataMun();
            loadDataSchool();
        });

        function loadData() {
            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dbData')) {
                $('#dbData').DataTable().destroy();
            }

            var loadData = $('#dbData').DataTable({
                responsive: true,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1]
                    },
                ],
                language: {
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('utdc.reservation.data-first-priority') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: 'DT_RowIndex', // Use 'DT_RowIndex' for the index column added by addIndexColumn()
                        name: 'DT_RowIndex',
                        orderable: false, // Prevent sorting on the index column
                        searchable: false // Prevent searching on the index column
                    }, {
                        data: 'firstpriorty_desc',
                        name: 'firstpriorty_desc'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    }
                ],
                pageLength: 5, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
                order: [
                    [2, 'desc']
                ], // Default sorting by 'Total Reservations' column
            });
        }

        function loadDataMun() {
            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dataMun')) {
                $('#dataMun').DataTable().destroy();
            }

            var loadData = $('#dataMun').DataTable({
                responsive: true,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1]
                    },
                ],
                language: {
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('utdc.reservation.data-by-municipility') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: 'DT_RowIndex', // Use 'DT_RowIndex' for the index column added by addIndexColumn()
                        name: 'DT_RowIndex',
                        orderable: false, // Prevent sorting on the index column
                        searchable: false // Prevent searching on the index column
                    },
                    {
                        data: 'city',
                        name: 'city',
                        title: "City"
                    },
                    {
                        data: 'total',
                        name: 'total',
                        title: "Total Reservations"
                    }
                ],
                pageLength: 5, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
                order: [
                    [2, 'desc']
                ], // Default sorting by 'Total Reservations' column
            });
        }

        function loadDataSchool() {
            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dataSchool')) {
                $('#dataSchool').DataTable().destroy();
            }

            var loadData = $('#dataSchool').DataTable({
                responsive: true,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1, 2]
                    },
                ],
                language: {
                    "processing": '<div class="inline-block border-2 rounded-full size-4 animate-spin border-l-transparent border-custom-500"></div>'
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Only render rows when visible
                ajax: {
                    url: "{{ route('utdc.reservation.data-by-school') }}",
                    type: "GET",
                    dataType: "JSON"
                },
                columns: [{
                        data: 'DT_RowIndex', // Use 'DT_RowIndex' for the index column added by addIndexColumn()
                        name: 'DT_RowIndex',
                        orderable: false, // Prevent sorting on the index column
                        searchable: false // Prevent searching on the index column
                    },
                    {
                        data: 'shs_school',
                        name: 'shs_school',
                        title: "School"
                    },
                    {
                        data: 'total',
                        name: 'total',
                        title: "Total Reservations"
                    }
                ],
                pageLength: 5, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
                order: [
                    [2, 'desc']
                ], // Default sorting by 'Total Reservations' column
            });
        }
    </script>

    {{-- reservaation turnout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.querySelector('#gradientChart');

            // Fetch percentage from the backend
            fetch('{{ route('utdc.reservation.percentage') }}')
                .then(response => response.json())
                .then(data => {
                    const percentage = data.percentage;

                    // Initialize ApexCharts Radial Bar Chart
                    const options = {
                        chart: {
                            type: 'radialBar',
                            height: 350,
                        },
                        series: [percentage], // The percentage value
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: '70%', // Adjust the donut size
                                },
                                dataLabels: {
                                    name: {
                                        offsetY: -10,
                                        show: true,
                                        color: '#000',
                                        fontSize: '20px',
                                        text: 'Percent',
                                    },
                                    value: {
                                        color: '#000',
                                        fontSize: '30px',
                                        offsetY: 5,
                                        formatter: function(val) {
                                            return `${val}%`;
                                        },
                                    },
                                },
                            },
                        },
                        colors: ['#00A8FF', '#42E695'], // Gradient colors
                        stroke: {
                            lineCap: 'round',
                        },
                        labels: ['Percent'], // Label for the chart
                    };

                    const chart = new ApexCharts(chartElement, options);
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching percentage data:', error);
                });
        });
    </script>

    {{-- confirmed reservaation turnout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.querySelector('#gradientChart2');

            // Fetch percentage from the backend
            fetch('{{ route('utdc.confirmed-reservation.percentage') }}')
                .then(response => response.json())
                .then(data => {
                    const percentage = data.percentage;

                    // Initialize ApexCharts Radial Bar Chart
                    const options = {
                        chart: {
                            type: 'radialBar',
                            height: 350,
                        },
                        series: [percentage], // The percentage value
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: '70%', // Adjust the donut size
                                },
                                dataLabels: {
                                    name: {
                                        offsetY: -10,
                                        show: true,
                                        color: '#000',
                                        fontSize: '20px',
                                        text: 'Percent',
                                    },
                                    value: {
                                        color: '#000',
                                        fontSize: '30px',
                                        offsetY: 5,
                                        formatter: function(val) {
                                            return `${val}%`;
                                        },
                                    },
                                },
                            },
                        },
                        colors: ['#00A8FF', '#42E695'], // Gradient colors
                        stroke: {
                            lineCap: 'round',
                        },
                        labels: ['Percent'], // Label for the chart
                    };

                    const chart = new ApexCharts(chartElement, options);
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching percentage data:', error);
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('utdc.reservation-stackbar') }}")
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data.series,
                        chart: {
                            type: "bar",
                            height: 400,
                            stacked: true
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: "60%"
                            }
                        },
                        xaxis: {
                            categories: data.categories
                        },
                        colors: ["#1E40AF", "#10B981", "#F59E0B", "#EAB308", "#8B5CF6",
                            "#EF4444"
                        ], // Matching colors
                        dataLabels: {
                            enabled: true
                        },
                        legend: {
                            position: "top"
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#stackedBarChart"), options);
                    chart.render();
                });
        });
    </script>
@endpush
