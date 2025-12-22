@extends('pao.layouts.master')
@section('title')
    USM-AES | Applicants with No Admission Requirements
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">{{ $programTitle }} </h5>
        </div>

        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Students</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">No Admission Requirements</a>
            </li>
        </ul>
    </div>
    <!-- Error Message Section -->
    <div class="grid grid-cols-1 gap-4 mb-4 xl:grid-cols-12">
        <div class="xl:col-span-12">
            @if (session('error'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error') }}
                </div>
            @endif
            @if (session('error_enroll'))
                <div
                    class="px-4 py-3 text-sm text-red-600 bg-red-100 border border-red-200 rounded-md dark:bg-red-400/20 dark:text-red-300">
                    <strong class="font-semibold">Notification:</strong> {{ session('error_enroll') }}
                </div>
            @endif
        </div>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <!--start col-->
            <div class="xl:col-span-12">
                <!--start card-->
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h6 class="mb-4 text-15" style="text-transform: uppercase;">List of applicants with No Admission
                            Requirements
                        </h6>
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        </div>
                    </div>
                    <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap" style="width:100%">
                                <thead class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                    <tr>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">No.</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Status</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Type</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Full Name</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Gender</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Contact</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Email</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Requirements</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y">Date Confirmed</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-y"></th>
                                    </tr>
                                </thead>

                                <tbody class="text-sm text-slate-700 dark:text-zink-100">
                                    @forelse ($students as $student)
                                        <tr class="border-b dark:border-zink-500">
                                            <td class="px-3.5 py-2.5 font-medium">{{ $loop->iteration }}</td>
                                            <!-- status -->
                                            <td class="px-3.5 py-2.5">
                                                @php
                                                    $status = match ($student->status_id) {
                                                        1 => 'Enrolled',
                                                        0 => 'For Assessment',
                                                        3 => 'Cancelled',
                                                        null => 'Pending',
                                                        default => 'Unknown',
                                                    };
                                                    $badgeClasses = match ($student->status_id) {
                                                        1 => 'bg-green-100 text-green-500',
                                                        0 => 'bg-yellow-100 text-yellow-500',
                                                        3 => 'bg-red-100 text-red-500',
                                                        null => 'bg-orange-100 text-orange-500',
                                                        default => 'bg-slate-100 text-slate-800',
                                                    };
                                                @endphp
                                                <span
                                                    class="inline-block text-xs font-medium px-2.5 py-0.5 rounded {{ $badgeClasses }}">
                                                    {{ $status }}
                                                </span>
                                            </td>

                                            <!-- student type -->
                                            <td class="px-3.5 py-2.5">
                                                @php
                                                    $type = match ($student->student_type) {
                                                        '1' => 'Freshman',
                                                        '2' => 'Transferee',
                                                        '3' => 'ALS/Other',
                                                        default => 'Unknown',
                                                    };
                                                    $badgeClasses = match ($student->student_type) {
                                                        '1' => 'bg-custom-100 text-custom-500',
                                                        '2' => 'bg-purple-100 text-purple-500',
                                                        '3' => 'bg-orange-100 text-orange-500',
                                                        default => 'bg-gray-100 text-gray-500',
                                                    };
                                                @endphp
                                                <span
                                                    class="inline-block text-xs font-medium px-2.5 py-0.5 rounded {{ $badgeClasses }}">
                                                    {{ $type }}
                                                </span>
                                            </td>

                                            <!-- name -->
                                            <td class="px-3.5 py-2.5">
                                                {{ $student->last_name }}, {{ $student->first_name }}
                                                {{ $student->middle_initial }}
                                            </td>

                                            <!-- gender -->
                                            <td class="px-3.5 py-2.5">
                                                {{ $student->gender ?? 'N/A' }}
                                            </td>

                                            <!-- mobile -->
                                            <td class="px-3.5 py-2.5">
                                                {{ $student->mobile_no ?? 'N/A' }}
                                            </td>

                                            <!-- email -->
                                            <td class="px-3.5 py-2.5">
                                                {{ $student->email ?? 'N/A' }}
                                            </td>

                                            <!-- requirements -->
                                            <td class="px-3.5 py-2.5">
                                                <ul class="pl-4 list-disc">
                                                    @if ($student->goodmoral)
                                                        <li>Good Moral</li>
                                                    @endif
                                                    @if ($student->card)
                                                        <li>Card</li>
                                                    @endif
                                                    @if ($student->psa)
                                                        <li>PSA</li>
                                                    @endif
                                                    @if ($student->hdismissal)
                                                        <li>Honorable Dismissal</li>
                                                    @endif
                                                    @if ($student->certificatetransfer)
                                                        <li>Transfer Certificate</li>
                                                    @endif
                                                    @if ($student->transcript)
                                                        <li>Transcript</li>
                                                    @endif
                                                    @if ($student->affidavit)
                                                        <li>Affidavit</li>
                                                    @endif

                                                    @if (
                                                        !$student->goodmoral &&
                                                            !$student->card &&
                                                            !$student->psa &&
                                                            !$student->hdismissal &&
                                                            !$student->certificatetransfer &&
                                                            !$student->transcript &&
                                                            !$student->affidavit)
                                                        <span
                                                            class="px-2.5 py-0.5 text-red-500 bg-red-100 rounded text-xs font-medium">
                                                            No submitted requirements
                                                        </span>
                                                    @endif
                                                </ul>
                                            </td>

                                            {{-- Date Confirmed --}}
                                            <td>
                                                @if ($student->date_confirmed)
                                                    {{ \Carbon\Carbon::parse($student->date_confirmed)->format('F j, Y') }}
                                                @else
                                                    <span class="text-sm text-slate-500">Not confirmed</span>
                                                @endif
                                            </td>

                                            <!-- cancel button -->
                                            <td class="px-3.5 py-2.5">
                                                <button type="button"
                                                    class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10"
                                                    id="btnEnroll"
                                                    onclick="cancelRegistration({{ $student->student_profile_id }})">
                                                    Cancel
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-3.5 py-2.5 text-center text-slate-500 italic">
                                                No records available.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>


                            </table>

                        </div>
                    </div>
                </div><!--end card-->

            </div><!--end col-->
        </div><!--end grid-->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/dataTables.2.2.2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.tailwindcss.js') }}"></script>
    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        lucide.createIcons();

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addModal');
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

        function cancelRegistration(studentId) {
            Swal.fire({
                title: 'Please provide a reason for cancellation',
                html: '<p style="margin-bottom: 10px; color: #888; font-size: 0.9rem;">Reminder: Please be specific. This field is required.</p>',
                input: 'textarea',
                inputPlaceholder: 'Type your reason here...',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10 ltr:mr-1 rtl:ml-1',
                    cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20',
                },
                buttonsStyling: false,
                showCloseButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    const textarea = Swal.getInput();
                    if (textarea) {
                        textarea.style.resize = 'none';
                    }
                },
                preConfirm: function(reason) {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            if (!reason || reason.trim() === '') {
                                Swal.hideLoading();
                                Swal.showValidationMessage(
                                    'Cancellation reason is required.');
                                return;
                            }
                            resolve(reason);
                        }, 500);
                    });
                },
            }).then(function(result) {
                if (result.isConfirmed) {
                    const reason = result.value;
                    cancelConfirmation(studentId, reason);
                }
            });
        }

        function cancelConfirmation(studentId, reason) {
            fetch(`{{ route('pao.student.cancel-confirmation.update', ['id' => '__ID__']) }}`.replace('__ID__',
                studentId), {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        reason: reason
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        showAlert(data.message, 'warning');
                        location.reload();
                    } else {
                        showAlert('An error occurred while cancelling the confirmation.', 'error');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred. Please try again.', 'error');
                });
        }


        function showAlert(message, type = 'info') {
            let title = '';
            switch (type) {
                case 'success':
                    title = 'Success!';
                    break;
                case 'error':
                    title = 'Error!';
                    break;
                case 'warning':
                    title = 'Warning!';
                    break;
                default:
                    title = 'Notice';
                    break;
            }

            Swal.fire({
                title: title,
                text: message,
                icon: type,
                customClass: {
                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                },
                buttonsStyling: false
            });
        }
    </script>
@endpush
