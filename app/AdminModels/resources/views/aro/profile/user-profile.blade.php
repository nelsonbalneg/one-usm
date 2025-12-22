@extends('aro.layouts.master')
@section('title')
    USM-AES | PAO - User Profile
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Profile Settings</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Profile</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#" class="text-slate-400 dark:text-zink-200">Edit Profile</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->

            <div class="xl:col-span-12">
                @if (session('success'))
                    <div class="text-green-500"></div>
                    <div
                        class="px-4 py-3 mb-2 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                        <span class="font-bold">Success!</span> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="px-4 py-3 mb-2 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                        <span class="font-bold">Error!</span>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>



            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Profile Information </h6>
                    </div>
                    <p>Update your account's profile information and email address.</p>

                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">

                    <div class="flex justify-center mb-4 lg:col-span-2 2xl:col-span-1">
                        <div
                            class="relative inline-block rounded-full shadow-md size-21 bg-slate-100 profile-user xl:size-28">
                            @if (empty($user->photo))
                                <img src="data:image/jpeg;base64,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"
                                    alt="" name='photo'
                                    class="object-cover w-full h-full rounded-full user-profile-image">
                            @else
                                <img src="{{ asset($user->photo) }}" alt=""
                                    class="object-cover w-full h-full rounded-full user-profile-image">
                            @endif
                        </div>
                    </div><!--end col-->

                    <form action="{{ route('aro.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-6">
                                <label for="lastname" class="inline-block mb-2 text-base font-medium">Last Name</label>
                                <input type="text" name="lastname" id="lastname"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter last name" value="{{ $user ? $user->lastname : '' }}" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="firstname" class="inline-block mb-2 text-base font-medium">First Name</label>
                                <input type="text" name="firstname" id="firstname"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter first name" value="{{ $user ? $user->firstname : '' }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-6">
                                <label for="middlename" class="inline-block mb-2 text-base font-medium">Middle Name
                                    <sup class="text-blue-500">* optional</sup>
                                </label>
                                <input type="text" name="middlename" id="middlename"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter middle name" value="{{ $user ? $user->middlename : '' }}">
                            </div><!--end col-->
                            <div class="xl:col-span-6">
                                <label for="suffix" class="inline-block mb-2 text-base font-medium">Suffix
                                    (ext.) <sup class="text-blue-500">* optional</sup></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="suffix" data-choices name="suffix">
                                    <option value="">-Select-</option>
                                    <option value="Jr"
                                        {{ old('suffix', $user->suffix ?? '') == 'Jr' ? 'selected' : '' }}>Jr
                                    </option>
                                    <option value="Sr"
                                        {{ old('suffix', $user->suffix ?? '') == 'Sr' ? 'selected' : '' }}>Sr
                                    </option>
                                    <option value="I"
                                        {{ old('suffix', $user->suffix ?? '') == 'I' ? 'selected' : '' }}>I
                                    </option>
                                    <option value="II"
                                        {{ old('suffix', $user->suffix ?? '') == 'II' ? 'selected' : '' }}>II
                                    </option>
                                    <option value="III"
                                        {{ old('suffix', $user->suffix ?? '') == 'III' ? 'selected' : '' }}>
                                        III</option>
                                    <option value="IV"
                                        {{ old('suffix', $user->suffix ?? '') == 'IV' ? 'selected' : '' }}>IV
                                    </option>
                                    <option value="V"
                                        {{ old('suffix', $user->suffix ?? '') == 'V' ? 'selected' : '' }}>V
                                    </option>
                                    <option value="VI"
                                        {{ old('suffix', $user->suffix ?? '') == 'VI' ? 'selected' : '' }}>
                                        VI</option>
                                    <option value="VII"
                                        {{ old('suffix', $user->suffix ?? '') == 'VII' ? 'selected' : '' }}>
                                        VII</option>
                                    <option value="VIII"
                                        {{ old('suffix', $user->suffix ?? '') == 'VIII' ? 'selected' : '' }}>VIII</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="site_name" class="inline-block mb-2 text-base font-medium">Email Address</label>
                                <input type="text" name="email" id="email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter email" value="{{ $user ? $user->email : '' }}" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="site_name" class="inline-block mb-2 text-base font-medium">Photo</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />
                            </div><!--end col-->


                            <div class="flex xl:col-span-12">
                                <button type="submit"
                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">
                                    Save Changes</button>
                            </div><!--end col-->
                        </div>

                    </form>


                </div>
            </div><!--end card-->

            <!--start card-->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Update Password </h6>
                    </div>
                    <p>Ensure your account is using a long, random password to stay secure</p>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">


                    <form action="{{ route('aro.password.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-12">
                                <label for="current_password" class="inline-block mb-2 text-base font-medium">Current
                                    Password</label>
                                <input type="text" name="current_password" id="current_password"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter current password" required>
                            </div><!--end col-->

                            <div class="xl:col-span-12">
                                <label for="password" class="inline-block mb-2 text-base font-medium">New Password</label>
                                <input type="text" name="password" id="password"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter new password" required>
                            </div><!--end col-->
                            <div class="xl:col-span-12">
                                <label for="password_confirmation" class="inline-block mb-2 text-base font-medium">Confirm
                                    Password
                                </label>
                                <input type="text" name="password_confirmation" id="password_confirmation"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Re-enter password" required>
                            </div><!--end col-->



                            <div class="flex xl:col-span-12">
                                <button type="submit"
                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">
                                    Update Password</button>
                            </div><!--end col-->
                        </div>

                    </form>

                </div>
            </div><!--end card-->

        </div><!--end col-->


    </div><!--end grid-->
@endsection
