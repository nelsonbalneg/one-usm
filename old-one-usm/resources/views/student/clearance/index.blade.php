@extends('student.layouts.master')
@section('title', 'One USM - Student Clearances')

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16 font-semibold text-green-600">Clearance</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zinc-200">
                <a href="#!" class="text-slate-400 dark:text-zinc-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zinc-100">
                Clearance
            </li>
        </ul>
    </div>

    <!-- Clearances Cards -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        <div class="xl:col-span-12">
            @forelse($clearances as $semester_key => $semester_clearances)
                <div
                    class="card mb-6 shadow-lg rounded-lg border border-green-100 hover:shadow-2xl transition duration-300">
                    <div class="card-body p-6">
                        <h6 class="mb-4 text-15 font-semibold text-green-600">{{ $semester_key }}</h6>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="ltr:text-left rtl:text-right">
                                    <tr>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Status</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Description</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Remarks</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Office</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Cleared By</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200">Settled Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semester_clearances as $clearance)
                                        <tr
                                            class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                <span
                                                    class="px-2 py-1 text-xs rounded {{ $clearance->status == 'cleared' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ ucfirst($clearance->status) }}
                                                </span>
                                            </td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                {{ $clearance->description }}</td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                {{ $clearance->remarks ?? '-' }}</td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                {{ $clearance->office_name }}</td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                @if ($clearance->clearedByUser)
                                                    {{ $clearance->clearedByUser->lastname }},
                                                    {{ $clearance->clearedByUser->firstname }}
                                                    {{ $clearance->clearedByUser->middlename ?? '' }}
                                                @else
                                                    Not Cleared
                                                @endif
                                            </td>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200">
                                                @if ($clearance->settled_date)
                                                    {{ \Carbon\Carbon::parse($clearance->settled_date)->format('M. d, Y g:i A') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end card-->
            @empty
                <div class="text-center py-6">
                    <h4 class="text-gray-500"><i>No clearances available.</i></h4>
                </div>
            @endforelse
        </div>
    </div>
@endsection
