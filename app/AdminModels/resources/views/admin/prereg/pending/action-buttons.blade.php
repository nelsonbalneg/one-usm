<td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
    <div class="relative dropdown">
        <button id="orderAction5{{ $id }}" data-bs-toggle="dropdown"
            class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"><i
                data-lucide="more-horizontal" class="size-3"></i></button>
        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
            aria-labelledby="orderAction5{{ $id }}">
            @if ($prereg_status_raw === 'enrolled')
                <li>
                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                        href="{{ route('admin.prereg.enrolled-applicants.download-cor', ['reg_no' => $reg_no]) }}" title="Download Certificate of Registration">
                        <i data-lucide="newspaper" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                        <span class="align-middle">Certificate of Registration</span>
                    </a>
                </li>
            @endif
            <li>
                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                    href="apps-ecommerce-order-overview.html"><i data-lucide="thumbs-up"
                        class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Approve</span></a>
            </li>
            <li>
                <a class="delete-button block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                    href="#!" data-id="{{ $id }}"><i data-lucide="thumbs-down"
                        class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Cancel</span></a>
            </li>
            <li>
                <a href="#!"
                    class="open-modal block px-4 py-1.5 text-base transition-all duration-200 text-slate-600 dropdown-item hover:bg-slate-100 dark:text-zink-100 dark:hover:bg-zink-500"
                    id="openModalButton" data-student-id="{{ $id }}" data-student-type="{{ $student_type }}"
                    data-fullname="{{ $fullname }}">
                    <i data-lucide="pencil-line" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                    <span class="align-middle">Requirements</span>
                </a>
            </li>
            <li>
                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                    href="{{ route('admin.applicant-profile.step1.show', ['id' => $id]) }}"
                    data-id="{{ $id }}"><i data-lucide="user"
                        class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">View
                        Profile</span></a>
            </li>
        </ul>
    </div>
</td>
