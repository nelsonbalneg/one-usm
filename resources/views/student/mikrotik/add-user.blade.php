@extends('student.layouts.master')
@section('title')
    One USM - Request Internet Account
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
<div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
    <div class="grow">
        <h5 class="uppercase text-16 font-semibold text-green-600">INTERNET ACCESS</h5>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

    <div class="xl:col-span-12">

        {{-- Notification Card --}}
        @if(session('success'))
            <div class="card mb-4 border border-green-300 bg-green-50 text-green-800 rounded-lg shadow-sm p-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="card mb-4 border border-red-300 bg-red-50 text-red-800 rounded-lg shadow-sm p-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        {{-- End Notification Card --}}

        <!-- Request Card -->
        <div class="card shadow-lg border border-green-100 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-2xl transition duration-300 mb-6">
            <div class="card-body flex flex-col md:flex-row items-center gap-6 p-6">
                <div class="flex-1">
                    <h6 class="text-green-600 text-lg font-bold uppercase mb-2">Request Your Internet Account</h6>
                    <p class="mb-4 text-slate-500 dark:text-zinc-200">
                        Click the button below to request your USM internet account. Your student ID will be used automatically, 
                        and a secure password will be generated for you.
                    </p>

                    <form action="{{ route('student.internet.request.submit') }}" method="POST">
                        @csrf
                        <button 
                            type="submit"
                            class="inline-block px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600 transition"
                        >
                            Request Internet Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Request Card -->

        <!-- Requested Accounts Table -->
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">Your Requested Internet Accounts</h6>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Semester</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Username</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Password</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Requested At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                                <tr class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $req->semester }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $req->student_no }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $req->password }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3.5 py-2.5 text-center border-y border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zinc-400">
                                        No internet accounts requested yet.
                                    </td>
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
{{-- No Toastify needed anymore --}}
@endpush
