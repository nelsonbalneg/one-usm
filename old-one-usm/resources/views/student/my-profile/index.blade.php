@extends('student.layouts.master')
@section('title', 'One USM - My Year Book')

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">My Year Book</h5>
            <p class="text-slate-700 mt-1 font-bold">Manage your year book information</p>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">My Year Book</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            @if(session('success'))
            <div class="flex gap-1 px-4 py-3 text-sm text-green-500 border border-green-200 rounded-md md:items-center bg-green-50 dark:bg-green-400/20 dark:border-green-500/50 mb-4">
                <i data-lucide="alert-circle" class="h-4"></i>
                <span class="font-bold">Success!</span> {{ session('success') }}
            </div>
        @endif
            <div
                class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="card-body p-6">

                    <h6 class="mb-4 text-15 text-green-700 font-semibold">Student Information</h6>

                    <form action="{{ route('student.student.yearbook.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                            <!-- Motto -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Motto in Life</label>
                                <textarea name="motto" rows="2" placeholder="Dream big, work hard, stay humble."
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('motto', $profile?->motto) }}</textarea>
                            </div>

                            <!-- Awards -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Awards / Achievements</label>
                                <div class="flex flex-col gap-2" id="awards-list">
                                    @foreach ($profile?->awards ?? [''] as $award)
                                        <div class="flex gap-2 items-center">
                                            <input type="text" name="awards[]" value="{{ $award }}"
                                                placeholder="Enter award"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200 flex-grow">
                                            <button type="button" onclick="removeField(this)"
                                                class="flex items-center justify-center w-9 h-9 p-0 text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                                <i class="ri-delete-bin-5-line text-lg"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addField('awards-list','awards[]')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Hobbies -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Hobbies / Skills</label>
                                <div class="flex flex-col gap-2" id="hobbies-list">
                                    @foreach ($profile?->hobbies ?? [''] as $hobby)
                                        <div class="flex gap-2 items-center">
                                            <input type="text" name="hobbies[]" value="{{ $hobby }}"
                                                placeholder="Enter hobby/skill"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200 flex-grow">
                                            <button type="button" onclick="removeField(this)"
                                                class="flex items-center justify-center w-9 h-9 p-0 text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                                <i class="ri-delete-bin-5-line text-lg"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addField('hobbies-list','hobbies[]')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Organizations -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Organizations / Memberships</label>
                                <div class="flex flex-col gap-2" id="organizations-list">
                                    @foreach ($profile?->organizations ?? [''] as $org)
                                        <div class="flex gap-2 items-center">
                                            <input type="text" name="organizations[]" value="{{ $org }}"
                                                placeholder="Enter organization"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200 flex-grow">
                                            <button type="button" onclick="removeField(this)"
                                                class="flex items-center justify-center w-9 h-9 p-0 text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                                <i class="ri-delete-bin-5-line text-lg"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addField('organizations-list','organizations[]')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- Trainings -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Trainings / Seminars Attended</label>
                                <div class="flex flex-col gap-2" id="trainings-list">
                                    @foreach ($profile?->trainings ?? [''] as $training)
                                        <div class="flex gap-2 items-center">
                                            <input type="text" name="trainings[]" value="{{ $training }}"
                                                placeholder="Enter training/seminar"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200 flex-grow">
                                            <button type="button" onclick="removeField(this)"
                                                class="flex items-center justify-center w-9 h-9 p-0 text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                                <i class="ri-delete-bin-5-line text-lg"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addField('trainings-list','trainings[]')"
                                    class="text-green-600 mt-1">+ Add another</button>
                            </div>

                            <!-- OJT Experience -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">On-the-Job Training (OJT) Experience</label>
                                <textarea name="ojt_experience" rows="2" placeholder="ABC Tech Solutions, Web Developer Intern, June-August 2024"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('ojt_experience', $profile?->ojt_experience) }}</textarea>
                            </div>

                            <!-- Most Memorable Experience -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Most Memorable Experience in USM</label>
                                <textarea name="memorable_experience" rows="2"
                                    placeholder="Participating in the annual inter-college sports fest and winning 1st place."
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('memorable_experience', $profile?->memorable_experience) }}</textarea>
                            </div>

                            <!-- Career Goal -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Future Career Goal</label>
                                <textarea name="career_goal" rows="2"
                                    placeholder="To become a software engineer specializing in AI and Machine Learning."
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('career_goal', $profile?->career_goal) }}</textarea>
                            </div>

                            <!-- Favorite Quote -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="font-medium">Favorite Quote</label>
                                <textarea name="favorite_quote" rows="2"
                                    placeholder="The only limit to our realization of tomorrow is our doubts of today. – FDR"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('favorite_quote', $profile?->favorite_quote) }}</textarea>
                            </div>

                            <!-- Social Links -->
                            <div>
                                <label class="font-medium">Facebook Profile (optional)</label>
                                <input type="text" name="facebook" value="{{ old('facebook', $profile?->facebook) }}"
                                    placeholder="https://facebook.com/john.doe"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            </div>

                            <div>
                                <label class="font-medium">LinkedIn Profile (optional)</label>
                                <input type="text" name="linkedin" value="{{ old('linkedin', $profile?->linkedin) }}"
                                    placeholder="https://linkedin.com/in/johndoe"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            </div>

                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <button type="submit"
                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Save
                                Changes</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function addField(containerId, name) {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-center';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = name;
            input.placeholder = 'Enter entry';
            input.className =
                'form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200 flex-grow';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className =
                'flex items-center justify-center w-9 h-9 p-0 text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20';
            removeBtn.innerHTML = '<i class="ri-delete-bin-5-line text-lg"></i>';
            removeBtn.onclick = () => removeField(removeBtn);

            div.appendChild(input);
            div.appendChild(removeBtn);
            container.appendChild(div);
        }

        function removeField(button) {
            button.parentElement.remove();
        }
    </script>

@endsection
