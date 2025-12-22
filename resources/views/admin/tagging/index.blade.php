@extends('admin.layouts.master')
@section('title')
    USM-CEE | Program Tagging
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">{{ $userFullname }}</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">USM CEE</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Programs</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex">
                        <h6 class="text-15 grow">LIST OF PROGRAMS</h6>
                        <div class="flex items-center gap-6">
                            <!-- Academic Status Toggle -->
                            <div class="flex items-center gap-2">
                                <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                    <div class="toggle-container" data-user-id="{{ $user->id }}">
                                        <input type="checkbox" id="toggle-academic-{{ $user->id }}"
                                            {{ $user->assignedAcademicStatus && $user->assignedAcademicStatus->status ? 'checked' : '' }}
                                            class="absolute block size-5 transition duration-300 ease-linear border-2 border-slate-200 dark:border-zink-500 rounded-full appearance-none cursor-pointer bg-white/80 dark:bg-zink-600 peer/academic checked:bg-white checked:border-green-500 ltr:checked:right-0 rtl:checked:left-0"
                                            onchange="handleAcademicStatusToggle(this)">
                                        <label for="toggle-academic-{{ $user->id }}"
                                            class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/academic:bg-green-500 peer-checked/academic:border-green-500"></label>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    Academic Status
                                </span>
                            </div>

                            <!-- Tag All Toggle -->
                            <div class="flex items-center gap-2">
                                <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                    <div class="toggle-container-tag-all">
                                        <input type="checkbox" id="toggle-tag-all"
                                            class="absolute block size-5 transition duration-300 ease-linear border-2 border-slate-200 dark:border-zink-500 rounded-full appearance-none cursor-pointer bg-white/80 dark:bg-zink-600 peer/tagall checked:bg-white checked:border-blue-500 ltr:checked:right-0 rtl:checked:left-0"
                                            onchange="handleTagAllToggle(this)">
                                        <label for="toggle-tag-all"
                                            class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/tagall:bg-blue-500 peer-checked/tagall:border-blue-500"></label>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    Tag All
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Policy ID</th>
                                <th>Campus</th>
                                <th>College</th>
                                <th>Program</th>
                                <th>Real Campus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programs as $program)
                                <tr>
                                    <td>
                                        {{ $program['id'] }}
                                    </td>
                                    <td>{{ $program['campusName'] }}</td>
                                    <td>{{ $program['collegeName'] }}</td>
                                    <td>{{ $program['programName'] }} {{ $program['majorDiscDesc'] }}</td>
                                    <td>{{ $program['realCampus'] }}</td>
                                    <td>
                                        <div
                                            class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                                            <div class="toggle-container" data-policy-id="{{ $program['id'] }}">
                                                <input type="checkbox" name="isOpen" id="toggle-{{ $program['id'] }}"
                                                    {{ in_array($program['id'], $userTaggedPolicyIds) ? 'checked' : '' }}
                                                    class="absolute block size-5 transition duration-300 ease-linear border-2 border-slate-200 dark:border-zink-500 rounded-full appearance-none cursor-pointer bg-white/80 dark:bg-zink-600 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none after:absolute after:text-slate-500 dark:after:text-zink-200 after:content-['\eb99'] after:text-xs after:inset-0 after:flex after:items-center after:justify-center after:font-remix after:leading-none checked:after:text-green-500 dark:checked:after:text-green-500 checked:after:content-['\eb7b']"
                                                    onchange="handleToggleChange(this, {{ $program['id'] }}, '{{ $program['programName'] }}')">
                                                <label for="toggle-{{ $program['id'] }}"
                                                    class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    {{-- data table scripts --}}
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#dbData').DataTable();
        });

       document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('toggle-tag-all');
    const userId = {{ $id }};

    // 1️⃣ Check if all programs are tagged
    fetch(`{{ route('admin.user.user-tagging.check-all', ['userId' => $id]) }}`)
        .then(res => res.json())
        .then(data => {
            toggle.checked = data.success && data.isAllTagged;
        })
        .catch(err => {
            console.error('Error checking Tag All status:', err);
            toggle.checked = false;
        });

    // 2️⃣ Handle toggle changes
    toggle.addEventListener('change', function() {
        const isChecked = toggle.checked;

        // Determine the correct route
        const route = isChecked
            ? "{{ route('admin.user.user-tagging.all') }}"
            : "{{ route('admin.user.user-tagging.all.remove') }}";

        fetch(route, {
            method: isChecked ? 'POST' : 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                console.log(data.message);

            } else {
                alert(data.message || 'Operation failed.');
                toggle.checked = !isChecked; // revert
            }
        })
        .catch(err => {
            console.error(err);
            alert('Server error.');
            toggle.checked = !isChecked; // revert
        });
    });
});


        function handleAcademicStatusToggle(checkbox) {
            const container = checkbox.closest('.toggle-container');
            const userId = container.getAttribute('data-user-id');
            const status = checkbox.checked ? 1 : 0;

            // Update text beside switch
            const statusLabel = container.closest('.flex').querySelector('.status-label');
            if (statusLabel) {
                // statusLabel.textContent = status === 1 ? 'Active' : 'Inactive';
                statusLabel.textContent = 'Academic Status';
            }

            fetch('{{ route('admin.user.toggle.academic-status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }


function handleTagAllToggle(checkbox) {
    const isChecked = checkbox.checked;
    const userId = {{ $id }};

    const route = isChecked
        ? "{{ route('admin.user.user-tagging.all') }}"           // POST
        : "{{ route('admin.user.user-tagging.all.remove') }}";  // DELETE

    fetch(route, {
        method: isChecked ? 'POST' : 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ user_id: userId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            console.log(data.message);
            alert(data.message); // ✅ show alert on success
        } else {
            alert(data.message || 'Operation failed.');
            checkbox.checked = !isChecked;
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error.');
        checkbox.checked = !isChecked;
    });
}




        function handleToggleChange(checkbox, policyId, programName) {
            const isChecked = checkbox.checked;
            const userId = {{ $id }};

            // Get additional program data from DOM
            const row = checkbox.closest('tr');
            const campusId = row.getAttribute('data-campus-id');
            const collegeId = row.getAttribute('data-college-id');
            const programId = row.getAttribute('data-program-id');
            const majorDiscId = row.getAttribute('data-major-id');

            if (isChecked) {
                // ADD (Insert)
                fetch('{{ route('admin.user.user-tagging.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            policy_id: policyId,
                            campus_id: campusId,
                            college_id: collegeId,
                            program_id: programId,
                            major_disc_id: majorDiscId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);
                        } else {
                            alert('Failed to tag program.');
                            checkbox.checked = false;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error tagging program.');
                        checkbox.checked = false;
                    });

            } else {
                // DELETE (Remove)
                if (confirm(`Remove "${programName}" from user?`)) {
                    fetch('{{ route('admin.user.user-tagging.remove') }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                user_id: userId,
                                policy_id: policyId
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                console.log(data.message);
                            } else {
                                alert('Failed to untag program.');
                                checkbox.checked = true;
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Error untagging program.');
                            checkbox.checked = true;
                        });
                } else {
                    checkbox.checked = true;
                }
            }
        }
    </script>
@endpush
