@extends('student.layouts.master')
@section('title')
    One USM - Dashboard
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">One USM </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-12">
            <!--start card-->
<div class="card mt-4">
    <div class="card-body">
        <h6 class="text-green-500 uppercase text-15 mb-3">Student Accountabilities</h6>

        @if(count($accountabilities) > 0)
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="text-left bg-slate-100 dark:bg-zinc-700">
                        <tr>
                            <th class="px-3 py-2 border font-semibold">Reason</th>
                            <th class="px-3 py-2 border font-semibold">Entered By</th>
                            <th class="px-3 py-2 border font-semibold">Date Entered</th>
                            <th class="px-3 py-2 border font-semibold">Last Updated</th>
                            <th class="px-3 py-2 border font-semibold">Cleared</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accountabilities as $acc)
                            <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800">
                                <td class="px-3 py-2 border">{{ $acc['reason'] }}</td>
                                <td class="px-3 py-2 border">{{ $acc['enteredBy'] }}</td>
                                <td class="px-3 py-2 border">{{ date('M d, Y h:i A', strtotime($acc['dateEntered'])) }}</td>
                                <td class="px-3 py-2 border">{{ date('M d, Y h:i A', strtotime($acc['dateUpdate'])) }}</td>
                                <td class="px-3 py-2 border">
                                    @if($acc['cleared'])
                                        <span class="text-green-600 font-semibold">Yes</span>
                                    @else
                                        <span class="text-red-600 font-semibold">No</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-slate-500 dark:text-zinc-200">No accountabilities found.</p>
        @endif
    </div>
</div>


        </div><!--end col-->
        <!--end col-->



    </div><!--end grid-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
