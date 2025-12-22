<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewOnlineUsersController extends Controller
{
    public function index()
    {
        return view('admin.users.online-users');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {

            $onlineThreshold = Carbon::now()->subMinutes(5);

            $data = User::select([
                'id',
                'firstname',
                'lrn',
                'lastname',
                'middlename',
                'suffix',
                'email',
                'phone',
                'status',
                'role',
                'photo',
                'created_at',
                'last_seen',
                DB::raw("CONCAT(lastname, ', ', firstname, ' ', COALESCE(middlename, '')) AS fullname")
            ])->where('last_seen', '>=', $onlineThreshold);


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($query) {
                    $onlineThreshold = Carbon::now()->subMinutes(5);
                    if (Carbon::parse($query->last_seen)->greaterThanOrEqualTo($onlineThreshold)) {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">Online</span>';
                    }
                    return Carbon::parse($query->last_seen)
                        ->timezone('Asia/Manila')
                        ->format('F j, Y g:i A');
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && isset($request->get('search')['value'])) {
                        $searchValue = $request->get('search')['value'];
                        $query->where('firstname', 'like', "%{$searchValue}%")
                            ->orWhere('lastname', 'like', "%{$searchValue}%")
                            ->orWhere('lrn', 'like', "%{$searchValue}%")
                            ->orWhere('email', 'like', "%{$searchValue}%");
                    }
                })
                ->addColumn('last_seen', function ($query) {
                    return Carbon::parse($query->last_seen)
                        ->timezone('Asia/Manila')
                        ->format('F j, Y g:i A');
                })
                ->rawColumns(['status', 'last_seen'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }
}
