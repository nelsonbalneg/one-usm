@extends('student.layouts.master')
@section('title', 'One USM - My Profile')

@section('contents')
    <!-- Header -->
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">My Profile</h5>
            <p class="text-slate-700 mt-1 font-bold">Manage your profile information</p>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">My Profile</li>
        </ul>
    </div>

    <!-- Card -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            <div
                class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="card-body p-6">

                    <h6 class="mb-4 text-15 text-green-700 font-semibold">Student Information</h6>

                    <form action="#">

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                            <!-- Motto in Life -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Motto in Life</label>
                                <textarea rows="2" placeholder="Example: 'Dream big, work hard, stay humble.'"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></textarea>
                            </div>

                            <!-- Awards / Achievements -->
                            <div class="md:col-span-2 lg:col-span-3" id="awards-container">
                                <label class="font-medium">Awards / Achievements</label>
                                <div class="flex flex-col gap-2">
                                    <input type="text" placeholder="Example: 'Dean's Lister 2023'"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </div>
                                <button type="button" onclick="addField('awards-container')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Hobbies / Skills -->
                            <div class="md:col-span-2 lg:col-span-3" id="hobbies-container">
                                <label class="font-medium">Hobbies / Skills</label>
                                <div class="flex flex-col gap-2">
                                    <input type="text" placeholder="Example: 'Playing guitar, Graphic Design'"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </div>
                                <button type="button" onclick="addField('hobbies-container')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Organizations / Memberships -->
                            <div class="md:col-span-2 lg:col-span-3" id="organizations-container">
                                <label class="font-medium">Organizations / Memberships</label>
                                <div class="flex flex-col gap-2">
                                    <input type="text" placeholder="Example: 'Student Council 2022-2023'"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </div>
                                <button type="button" onclick="addField('organizations-container')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Trainings / Seminars -->
                            <div class="md:col-span-2 lg:col-span-3" id="trainings-container">
                                <label class="font-medium">Trainings / Seminars Attended</label>
                                <div class="flex flex-col gap-2">
                                    <input type="text" placeholder="Example: 'Leadership Training Workshop 2023'"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </div>
                                <button type="button" onclick="addField('trainings-container')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- On-the-Job Training (OJT) -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">On-the-Job Training (OJT) Experience</label>
                                <textarea rows="2" placeholder="Example: 'ABC Tech Solutions, Web Developer Intern, June-August 2024'"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></textarea>
                            </div>

                            <!-- Most Memorable Experience -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Most Memorable Experience in USM</label>
                                <textarea rows="2"
                                    placeholder="Example: 'Participating in the annual inter-college sports fest and winning 1st place.'"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></textarea>
                            </div>

                            <!-- Future Career Goal -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Future Career Goal</label>
                                <textarea rows="2" placeholder="Example: 'To become a software engineer specializing in AI and Machine Learning.'"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></textarea>
                            </div>

                            <!-- Favorite Quote -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Favorite Quote</label>
                                <textarea rows="2"
                                    placeholder="Example: 'The only limit to our realization of tomorrow is our doubts of today. – FDR'"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></textarea>
                            </div>

                            <!-- Social Media Links -->
                            <div>
                                <label class="font-medium">Facebook Profile (optional)</label>
                                <input type="text" placeholder="Example: https://facebook.com/john.doe"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            </div>

                            <div>
                                <label class="font-medium">LinkedIn Profile (optional)</label>
                                <input type="text" placeholder="Example: https://linkedin.com/in/johndoe"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-2 mt-6">
                            <button type="submit"
                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Save Changes</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
       function addField(containerId) {
    const container = document.getElementById(containerId).querySelector('div.flex.flex-col');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = containerId.split('-')[0] + '[]'; // e.g., awards[]
    input.placeholder = 'Add another entry';
    input.className = 'form-input ...'; // keep your classes
    container.appendChild(input);
}
    </script>
@endsection
