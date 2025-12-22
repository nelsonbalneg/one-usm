<?php

namespace App\Http\Controllers\Backend;

use App\Models\PastCeeData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LegacyUserController extends Controller
{
    public function index()
    {
        return view("admin.old-cee.old-cee-users");
    }

    public function getUsers(Request $request)
    {
        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = PastCeeData::select([
            'id',
            'ceeSessoion',
            'firstname',
            'lrn',
            'lastname',
            'middlename',
            'suffix',
            'email',
            'phone',
            'birthdate',
            DB::raw("CONCAT(lastname, ', ', firstname, ' ', ISNULL(middlename, ''), ISNULL(suffix, '')) AS fullname")
        ]);

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('firstname', 'like', "%{$searchValue}%")
                        ->orWhere('lastname', 'like', "%{$searchValue}%")
                        ->orWhere('email', 'like', "%{$searchValue}%");
                }
            })
            ->make(true);
    }


}
