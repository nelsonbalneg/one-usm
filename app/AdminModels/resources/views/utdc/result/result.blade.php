@extends('utdc.layouts.master')
@section('title')
    USM-AES | UTDC - Result Management
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE Result </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Result</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

        <div class="xl:col-span-12">
            <div class="card">
                <div class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                    <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                    <div>
                        <h6 class="mb-1">Please read this note before uploading the CEE results for this term.</h6>
                        <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i> Kindly download this
                            excel
                            form by clicking the <b>Template</b> button</p>
                        <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i> Ensure that you provide
                            accurate and correct information.</p>
                        <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i> The data must be the
                            final version, prepared and signed by the UTDC head, and approved by the ARO.</p>
                        <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i> Double-check all details
                            before uploading, as re-uploading the results is not allowed.</p>
                    </div>
                </div>
            </div>

            <!--start col-->
            <div class="xl:col-span-12">
                <!--start card-->
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">Import CEE Result from Excel</h6>
                        <div class="grid grid-cols-1 gap-2 xl:grid-cols-12">

                            <div class="xl:col-span-4">
                                <form action="{{ route('utdc.import.preview') }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <label for="file-upload" class="block mb-2 text-sm text-slate-600 dark:text-zinc-400">
                                        Select an excel file to upload (.xls and .xlxs):
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="file" id="file-upload" name="file" accept=".xls,.xlsx"
                                            class="cursor-pointer form-file border-slate-200 dark:border-zinc-500 focus:outline-none focus:border-custom-500">
                                        <button type="submit" id="preview-button" disabled
                                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <span class="align-middle">Preview</span>
                                        </button>

                                    </div>
                                </form>
                            </div>
                            {{-- <div class="xl:col-span-4 mt-7">
                                <a href="{{ route('utdc.reservation.export.confirmed-status') }}" id="upload-result-temp"
                                    class="text-white bg-green-500 btn hover:bg-green-600 focus:bg-custom-600 focus:ring focus:ring-custom-100 dark:ring-custom-400/20">
                                    <span class="align-middle">Default Template</span>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div class="flex items-center mb-4">
                            <h6 class="text-15 grow" style="text-transform: uppercase;">Records for {{ $ceeSession->name }}
                                [{{ $ceeSession->id }}]</h6>
                            {{-- <div class="shrink-0">
                                <button data-drawer-target="drawerterms" type="button"
                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    <i data-lucide="plus" class="inline-block size-4"></i>
                                    <span class="align-middle">Encode Result</span>
                                </button>
                            </div> --}}
                            <div class="flex items-center gap-2 space-x-4">
                                <button data-drawer-target="drawerterms" type="button"
                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    <i data-lucide="plus" class="inline-block size-4"></i>
                                    <span class="align-middle">Encode Result</span>
                                </button>

                                <!-- Dropdown for Filter -->
                                <div class="relative dropdown">
                                    <button type="button"
                                        class="flex items-center justify-center p-0 bg-white size-8 text-slate-500 btn hover:text-slate-600 hover:bg-slate-100 focus:text-slate-600 focus:bg-slate-100 active:text-slate-700 active:bg-slate-200 dark:bg-zinc-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle"
                                        id="dailyVisitInsightsDropdown" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                    </button>

                                    <ul class="absolute z-50 hidden py-2 mt-2 bg-white rounded-md shadow-md dropdown-menu min-w-[14rem] dark:bg-zinc-600"
                                        aria-labelledby="dailyVisitInsightsDropdown">
                                        <div class="px-3 py-2">
                                            <label for="cee-term-select"
                                                class="block text-sm font-medium text-slate-600 dark:text-white">
                                                Filter by CEE Terms
                                            </label>
                                            <select id="cee-term-select" name="cee_session_id" data-choices
                                                class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                                                <option disabled>Select Term</option>
                                                @foreach ($ceeSessionAll as $session)
                                                    <option value="{{ $session->id }}"
                                                        {{ isset($ceeSession) && $ceeSession->id == $session->id ? 'selected' : '' }}>
                                                        {{ $session->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <table id="dbData" class="display stripe group" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="ltr:!text-left rtl:!text-right">CEE Exam ID</th>
                                    <th>CEE App No</th>
                                    <th>Full Name</th>
                                    <th>Science</th>
                                    <th>Math</th>
                                    <th>Humanities</th>
                                    <th>Inductive Reasoning</th>
                                    <th>CSA</th>
                                    <th>Status</th>
                                    <th>RFC Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end grid-->

        <!-- edit Modal Structure -->
        <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
            <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
                <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                    <h5 class="text-16">Edit CEE Score</h5>
                    <button id="closeModalButton"
                        class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="p-4">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <div id="alert-error-msg"
                            class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                        </div>
                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                            <input type="hidden" name="resultId" id="resultId">

                            <div class="xl:col-span-12">
                                <label for="app_no" class="inline-block mb-2 text-base font-medium">App Number</label>
                                <input type="text" id="app_no"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score " value="{{ old('app_no') }}" disabled>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="fullname" class="inline-block mb-2 text-base font-medium">Fullname</label>
                                <input type="text" id="fullname"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score " value="{{ old('fullname') }}" disabled>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="science" class="inline-block mb-2 text-base font-medium">Science</label>
                                <input type="text" id="science" name="science"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score " value="{{ old('science') }}" onblur="validateScores()">
                            </div>

                            <div class="xl:col-span-12">
                                <label for="math" class="inline-block mb-2 text-base font-medium">Math</label>
                                <input type="text" id="math" name="math"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score" value="{{ old('math') }}">
                            </div>
                            <div class="xl:col-span-12">
                                <label for="humanities" class="inline-block mb-2 text-base font-medium">Humanities</label>
                                <input type="text" id="humanities" name="humanities"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score" value="{{ old('humanities') }}">
                            </div>
                            <div class="xl:col-span-12">
                                <label for="inductive" class="inline-block mb-2 text-base font-medium">Inductive
                                    Reasoning</label>
                                <input type="text" id="inductive" name="inductive"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score" value="{{ old('inductive') }}">
                            </div>

                            {{-- <div class="xl:col-span-12">
                                <label for="abstract" class="inline-block mb-2 text-base font-medium">Abstract
                                    Reasoning</label>
                                <input type="text" name="abstract" id="abstract"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score" required>
                            </div> --}}

                            <div class="xl:col-span-12">
                                <label for="csa" class="inline-block mb-2 text-base font-medium">Composite Scholastic
                                    Ability</label>
                                <input type="text" name="csa" id="csa"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Score" required>
                            </div>

                            <div class="xl:col-span-12">
                                <label for="remarks" class="inline-block mb-2 text-base font-medium">Remarks or
                                    Comments</label>
                                <textarea
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    id="remarks" name="remarks" placeholder="Enter Remarks" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                            <button type="submit"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                                Request for Change</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
        <!-- end edit Modal Structure -->

        {{-- start drawer --}}
        <div id="drawerterms" drawer-end
            class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-96 lg:w-1/2 z-drawer show dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
                <h5 class="text-16">ADD CEE Score</h5>
                <button data-drawer-close="drawerterms"><i data-lucide="x"
                        class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i></button>
            </div>
            <div class="h-full p-2 overflow-y-auto">
                <div class="card-body">
                    <div class="p-4">
                        <form id="addForm" method="POST">
                            @csrf

                            <div id="alert-error-msg"
                                class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                            </div>
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                                <div class="xl:col-span-12">
                                    <label for="addceeapp_no" class="inline-block mb-2 text-base font-medium">App
                                        Number</label>
                                    <select id="addceeapp_no" name="app_no" data-choices
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                        <option value="" disabled selected>Select App Number</option>
                                        @foreach ($appNumbers as $appNumber)
                                            <option value="{{ $appNumber->app_no }}"
                                                data-fullname="{{ $appNumber->fullname }}"
                                                data-userid="{{ $appNumber->user_id }}">{{ $appNumber->app_no }} -
                                                {{ $appNumber->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="addceefullname"
                                        class="inline-block mb-2 text-base font-medium">Fullname</label>
                                    <input type="text" id="addceefullname" name="fullname"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter fullname " value="{{ old('fullname') }}" readonly>
                                </div>

                                <input type="hidden" id="addceeuserid" name="addceeuserid">

                                <div class="xl:col-span-12">
                                    <label for="addceescience"
                                        class="inline-block mb-2 text-base font-medium">Science</label>
                                    <input type="text" id="addceescience" name="science"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score " value="{{ old('science') }}"
                                        onblur="validateScores()">
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="addceemath" class="inline-block mb-2 text-base font-medium">Math</label>
                                    <input type="text" id="addceemath" name="math"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score" value="{{ old('math') }}">
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="addhumanities"
                                        class="inline-block mb-2 text-base font-medium">Humanities</label>
                                    <input type="text" id="addhumanities" name="humanities"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score" value="{{ old('humanities') }}">
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="addinductive" class="inline-block mb-2 text-base font-medium">Inductive
                                        Reasoning</label>
                                    <input type="text" id="addinductive" name="inductive"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score" value="{{ old('inductive') }}">
                                </div>

                                {{-- <div class="xl:col-span-12">
                                    <label for="addceeabstract" class="inline-block mb-2 text-base font-medium">Abstract
                                        Reasoning</label>
                                    <input type="text" name="abstract" id="addceeabstract"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score" required>
                                </div> --}}

                                <div class="xl:col-span-12">
                                    <label for="addceecsa" class="inline-block mb-2 text-base font-medium">Composite
                                        Scholastic
                                        Ability</label>
                                    <input type="text" name="csa" id="addceecsa"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Score" required>
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="addceeremarks" class="inline-block mb-2 text-base font-medium">Remarks or
                                        Comments</label>
                                    <textarea
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        id="addceeremarks" name="remarks" placeholder="Enter Remarks" rows="5" readonly> Added individually by {{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}
                                   </textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                                    Save CEE Scores</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
                <h6 class="text-15">USMCEE 4.0</h6>
            </div>
        </div>
        {{-- end drawer --}}
    @endsection
    @push('scripts')
        <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
        <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.getElementById('preview-button').addEventListener('click', function(event) {
                event.preventDefault();
                // Trigger SweetAlert
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we process the file.',
                    icon: 'info',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    willClose: () => {
                        // Submit the form after SweetAlert auto closes
                        event.target.closest('form').submit();
                    }
                });
            });

            // Add event listener for file input change
            document.getElementById('file-upload').addEventListener('change', function() {
                const previewButton = document.getElementById('preview-button');
                const allowedExtensions = ['xls', 'xlsx']; // Allowed file extensions
                const file = this.files[0]; // Get the selected file

                if (file) {
                    const fileExtension = file.name.split('.').pop().toLowerCase(); // Get the file extension

                    if (allowedExtensions.includes(fileExtension)) {
                        previewButton.disabled = false; // Enable the button if the file is valid
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid File Type',
                            text: 'Only .xls and .xlsx files are allowed.',
                        });
                        this.value = ''; // Clear the file input
                        previewButton.disabled = true; // Disable the button
                    }
                } else {
                    previewButton.disabled = true; // Disable the button if no file is selected
                }
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                loadData();
            });

            function loadData() {


                // Get default selected session
                let activeSessionId = $('#cee-term-select').val();

                // Get the page number from sessionStorage if available
                let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem('currentPage')) : 0;

                // Check if DataTable is already initialized and destroy it if it is
                if ($.fn.DataTable.isDataTable('#dbData')) {
                    $('#dbData').DataTable().destroy();
                }

                var table = $('#dbData').DataTable({
                    responsive: true,
                    columnDefs: [{
                            width: "10%",
                            targets: [0]
                        },
                        {
                            className: "text-start custom-middle-align",
                            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },
                    ],
                    language: {
                        "processing": ' <div id="spinnerOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"><div class="inline-flex bg-green-400 rounded-full opacity-75 size-4 animate-ping"></div></div>'
                    },
                    processing: true,
                    serverSide: true,
                    deferRender: true, // Improves performance by delaying rendering
                    ajax: {
                        url: "{{ route('utdc.cee.result.fetch-data') }}",
                        type: "GET",
                        dataType: "JSON",
                        data: function(d) {
                            d.cee_session_id = $('#cee-term-select').val() ||
                                activeSessionId; // Load selected or default session
                        }
                    },
                    columns: [{
                            data: "cee_session_id",
                            name: "cee_session_id"
                        },
                        {
                            data: "app_no",
                            name: "app_no"
                        },
                        {
                            data: 'fullname',
                            name: 'fullname'
                        },
                        {
                            data: 'science',
                            name: 'science'
                        },
                        {
                            data: 'math',
                            name: 'math'
                        },
                        {
                            data: 'humanities',
                            name: 'humanities'
                        },
                        {
                            data: 'inductive',
                            name: 'inductive'
                        },
                        {
                            data: 'csa',
                            name: 'csa'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'ispending_edit',
                            name: 'ispending_edit'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                    order: [
                        [2, "asc"]
                    ],
                    drawCallback: function() {
                        lucide.createIcons();
                    },
                    // Once the table is initialized, move to the stored page
                    initComplete: function() {
                        if (currentPage) {
                            table.page(currentPage).draw('page');
                        }
                    }
                });
                // Save the current page in sessionStorage when page changes
                table.on('page.dt', function() {
                    let pageInfo = table.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                });

                // Save the current page in sessionStorage when search is initiated
                $('#dbData_filter input').on('input', function() {
                    let searchValue = $(this).val();

                    // If the search is cleared, use the stored page number
                    if (searchValue === '') {
                        currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                            'currentPage')) : 0;
                        table.page(currentPage).draw(false);
                    } else {
                        let pageInfo = table.page.info();
                        sessionStorage.setItem('currentPage', pageInfo.page);
                    }
                });

                // Reload table when session is changed
                $('#cee-term-select').change(function() {
                    table.ajax.reload(); // Refresh table based on new session ID
                });
            }

            //for drawer
            document.addEventListener('DOMContentLoaded', function() {
                const appNoSelect = document.getElementById('addceeapp_no');
                const fullnameInput = document.getElementById('addceefullname');
                const userIdInput = document.getElementById('addceeuserid');

                appNoSelect.addEventListener('change', function() {
                    // Get the selected option
                    const selectedOption = appNoSelect.options[appNoSelect.selectedIndex];

                    // Get the fullname from the data attribute
                    const fullname = selectedOption.getAttribute('data-fullname') || '';
                    const userId = selectedOption.getAttribute('data-userid') || '';

                    // Set the fullname input field
                    fullnameInput.value = fullname;
                    userIdInput.value = userId;
                });
            });

            // Initialize modal open event using jQuery edit entry cee-result/{cee_result}/edit
            $('body').on('click', '.edit-entry', function(event) {
                event.preventDefault();

                let id = $(this).data('id');
                let editUrl = '/utdc/cee-result/' + id + '/edit';

                $.ajax({
                    url: editUrl,
                    method: 'GET',
                    success: function(response) {

                        //populate the select elements
                        let result = response.ceeresult;

                        // fill the values
                        $('#resultId').val(result.id);
                        $('#science').val(result.science);
                        $('#math').val(result.math);
                        $('#humanities').val(result.humanities);
                        $('#inductive').val(result.inductive);
                        $('#csa').val(result.csa);
                        $('#app_no').val(result.app_no);
                        $('#fullname').val(result.fullname);
                        $('#remarks').val(result.remarks);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            'An error occurred while processing your request.';
                        swal('Unable to Delete!', errorMessage, 'error');
                    }
                })



                $('#editModal').removeClass('hidden'); // Open modal
            });

            // JavaScript for closing the modal
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('editModal');
                const closeModalButtons = modal.querySelectorAll('#closeModalButton');

                // Close Modal when clicking close buttons
                closeModalButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        modal.classList.add('hidden');
                    });
                });

                // Close when clicking outside the modal content
                modal.addEventListener('click', (event) => {
                    if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                        modal.classList.add('hidden');
                    }
                });
            });

            //update date
            $('#editForm').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = $(this).serialize();
                var resultId = $('#resultId').val(); // Get the category ID from the hidden input

                // AJAX PUT request for updating data
                $.ajax({
                    url: '/utdc/cee-result/' + resultId, // Replace with your endpoint URL
                    method: 'POST', // Use POST method
                    data: formData, // Send _method=PUT parameter
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#editModal').addClass('hidden');

                        Swal.fire("Success", data.message, 'success', {
                            button: true,
                            button: "OK"
                        });

                        // Reload or redraw the table (if using DataTables)
                        if ($.fn.DataTable.isDataTable('#dbData')) {
                            $('#dbData').DataTable().ajax.reload(null,
                                false); // false = retain pagination
                        } else {
                            location
                                .reload(); // Fallback to full page reload if not using DataTables
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error Response:", xhr.responseText); // Check the error response
                        Swal.fire("Error", data.message, 'error', {
                            button: true,
                            button: "OK"
                        });
                    }
                });
            });

            // Handle form submission with AJAX
            $('#addForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize(); // Instead of new FormData(this)

                $.ajax({
                    url: "{{ route('utdc.cee-result.store') }}",
                    method: 'POST', // Use POST method
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire("Success", data.message, 'success', {
                            button: true,
                            button: "OK"
                        });

                        // Reset the form
                        $('#addForm')[0].reset();

                        // Reset the data-choices dropdown
                        const appNoDropdown = document.querySelector('#addceeapp_no');
                        if (appNoDropdown && appNoDropdown.choices) {
                            appNoDropdown.choices.clearStore(); // Clear all choices
                            appNoDropdown.choices.setChoiceByValue(''); // Reset to placeholder
                        }

                        // Reload or redraw the table (if using DataTables)
                        if ($.fn.DataTable.isDataTable('#dbData')) {
                            $('#dbData').DataTable().ajax.reload(null,
                                false); // false = retain pagination
                        } else {
                            location.reload(); // Fallback to full page reload if not using DataTables
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) { // Laravel validation error
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            // Concatenate all error messages
                            for (let field in errors) {
                                errorMessage += `${errors[field][0]}<br>`;
                            }

                            // Show error in Swal or any alert box
                            Swal.fire("Validation Error", errorMessage, 'error', {
                                button: true,
                                button: "OK"
                            });
                        } else {
                            // General error handling
                            Swal.fire("Error", "An unexpected error occurred.", 'error', {
                                button: true,
                                button: "OK"
                            });
                        }
                    }
                });
            });
        </script>
    @endpush
