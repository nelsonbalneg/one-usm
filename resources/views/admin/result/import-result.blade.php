@extends('admin.layouts.master')
@section('title')
    USM-AES | CEE - Import Result From Excel
@endsection

@push('styles')
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE Result Preview </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Result</a>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
            <div>
                <h6 class="mb-1">Please read this note before saving the data to the database this term.</h6>
                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i>The red color highlight indicates
                    the presence of an existing CEE application number and/or duplicate data within the database.</p>
                <p><i data-lucide="check" class="inline-block size-4 mt-0.5 shrink-0"></i> The red-highlighted entries will
                    be ignored by the system and will not be saved in the database.</p>
            </div>
        </div>
    </div>
    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <h6 class="mb-4 text-15">Preview Imported Data: CEE Result from Excel</h6>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    @if ($paginatedRows->isNotEmpty())
                        <form id="saveDataForm" action="{{ route('admin.import.save') }}" method="POST">
                            @csrf
                            <table id="dbData" class="display stripe group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left border-b">CEE Exam Session</th>
                                        <th class="px-4 py-2 text-left border-b">User Id</th>
                                        <th class="px-4 py-2 text-left border-b">App No</th>
                                        <th class="px-4 py-2 text-left border-b">Fullname</th>
                                        <th class="px-4 py-2 text-left border-b">Science</th>
                                        <th class="px-4 py-2 text-left border-b">Math</th>
                                        <th class="px-4 py-2 text-left border-b">Humanities</th>
                                        <th class="px-4 py-2 text-left border-b">Inductive</th>
                                        {{-- <th class="px-4 py-2 border-b">Abstract</th> --}}
                                        <th class="px-4 py-2 text-left border-b">CSA</th>
                                        <th class="px-4 py-2 text-left border-b">Status</th>
                                        {{-- <th class="px-4 py-2 border-b">Created At</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paginatedRows as $row)
                                        <tr class="{{ $row['is_duplicate'] ? 'bg-red-100' : '' }}">
                                            <!-- Add a conditional class here -->
                                            <td class="px-4 py-2 border-b">{{ $row['cee_session_id'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['user_id'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['app_no'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['fullname'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['science'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['math'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['humanities'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['inductive'] }}</td>
                                            {{-- <td class="px-4 py-2 border-b">{{ $row['abstract'] }}</td> --}}
                                            <td class="px-4 py-2 border-b">{{ $row['csa'] }}</td>
                                            <td class="px-4 py-2 border-b">{{ $row['status'] }}</td>
                                            {{-- <td class="px-4 py-2 border-b">
                                            {{ \Carbon\Carbon::parse($row['created_at'])->format('F j, Y') }}
                                        </td> --}}
                                            <input type="hidden" name="data[]" value="{{ json_encode($row) }}">
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <!-- Updated button container -->
                            <div class="absolute flex p-4 mb-10 space-x-2 right-10">
                                <div>
                                    <button type="button" id="saveDataButton"
                                        class="px-4 py-2 font-semibold text-white bg-green-500 rounded btn hover:bg-green-600">
                                        <i data-lucide="plus" class="inline-block size-4"></i>
                                        Save All Data
                                    </button>
                                </div>
                            </div>

                        </form>

                        <!-- Pagination Links -->
                        <div class="mt-20">
                            {{ $paginatedRows->links() }}
                        </div>
                    @else
                        <p>No data available to preview.</p>
                    @endif
                </div>

            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.cee-result.index') }}";
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.getElementById('saveDataButton').addEventListener('click', function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save all the data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while the system is validating all the fields.',
                        icon: 'info',
                        timer: 5000, // Auto close after 5 seconds
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            document.getElementById('saveDataForm').submit(); // Submit the form
                        }
                    });

                }
            });
        });
    </script>
@endpush
