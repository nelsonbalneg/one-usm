@extends('student.layouts.master')
@section('title')
    One USM - Academic Evaluation Request
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">ACADEMIC EVALUATION</h5>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">

            {{-- Notification Card --}}
            @if (session('success'))
                <div id="success-alert"
                    class="card mb-4 border border-green-300 bg-green-50 text-green-800 rounded-lg shadow-sm p-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- Error Notification Card --}}
            @if (session('error'))
                <div id="error-alert"
                    class="card mb-4 border border-red-300 bg-red-50 text-red-800 rounded-lg shadow-sm p-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            {{-- End Notification Card --}}

            <!-- Request Card -->
            <div class="card shadow-lg border border-green-100 rounded-lg overflow-hidden mb-6">
                <div class="card-body p-6">
                    <h6 class="text-green-600 text-lg font-bold uppercase mb-2">
                        Request an Academic Evaluation
                    </h6>

                    <p class="mb-3 text-slate-600 dark:text-zinc-200">
                        The Registrar's Office will assess your academic records to determine your progress toward
                        graduation. This includes completed subjects, deficiencies, and alignment with your curriculum.
                    </p>
                    <p class="mb-4 text-slate-500 dark:text-zinc-200 font-medium">
                        <strong>Students who can request academic evaluation:</strong><br>
                        • Students preparing for graduation<br>
                        • Irregular students who shifted or changed curriculum<br>
                        • Students who want to verify academic deficiencies<br>
                        • Students who need updated evaluation records for requirements
                    </p>

                    <form action="{{ route('student.student.academic-evaluation.store') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-white rounded transition
                @if ($hasPending) bg-slate-500 opacity-60 cursor-not-allowed
                @else bg-green-500 hover:bg-green-600 @endif"
                            @if ($hasPending) disabled @endif>
                            Request Evaluation
                        </button>
                    </form>

                    <!-- Notice about cancellation -->
                    <p class="mt-3 text-sm text-red-500 dark:text-red-400">
                        Note: Requests can be cancelled only within 24 hours after submission. After 24 hours, cancellation
                        is no longer allowed.
                    </p>
                </div>
            </div>


            <!-- Request List Table -->
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4">Your Academic Evaluation Requests</h6>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="text-left">
                                <tr>
                                    <th class="px-3.5 py-2.5 border-b font-semibold">Request ID</th>
                                    <th class="px-3.5 py-2.5 border-b font-semibold">Status</th>
                                    <th class="px-3.5 py-2.5 border-b font-semibold">Remarks</th>
                                    <th class="px-3.5 py-2.5 border-b font-semibold">Requested At</th>
                                    <th class="px-3.5 py-2.5 border-b font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                @forelse($requests as $request)
                                    <tr>
                                        <td class="px-3.5 py-2.5 border-b">{{ $request->request_id }}</td>
                                        <td class="px-3.5 py-2.5 border-b">
                                            {{ $request->status }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-b">
                                            {{ $request->remarks ?? '---' }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-b">
                                            {{ $request->created_at->format('M d, Y h:i A') }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-b">
                                            @if ($request->status == 'Pending')
                                                <form
                                                    action="{{ route('student.student.academic-evaluation.cancel', $request->id) }}"
                                                    method="POST" class="cancel-request-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600 transition">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs">No Action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-slate-500">No requests yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End Table -->

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        setTimeout(() => {
            let alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.7s';
                setTimeout(() => alert.remove(), 700);
            }
        }, 3000);
        setTimeout(() => {
            let alert = document.getElementById('error-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.7s';
                setTimeout(() => alert.remove(), 700);
            }
        }, 3000);


        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.cancel-request-form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // prevent immediate submission

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to cancel this request?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // submit form if confirmed
                        }
                    });
                });
            });
        });
    </script>
@endpush
