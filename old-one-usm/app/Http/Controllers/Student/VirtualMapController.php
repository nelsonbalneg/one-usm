<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\VirtualMap;

class VirtualMapController extends Controller
{

    public function index()
    {
        // Fetch markers where campus_id = 1 and tenant_id = 1 (and optionally active)
        $markers = VirtualMap::where('campus_id', 1)
                            ->where('tenant_id', 1)
                            ->where('is_active', true) // optional
                            ->get();

        // Pass to view as JSON
        return view('student.virtual-map.index', [
            'markers' => $markers
        ]);
    }

    public function kcc()
    {
        // Fetch markers where campus_id = 3 and tenant_id = 3 (and optionally active)
        $markers = VirtualMap::where('campus_id', 3)
                            ->where('tenant_id', 3)
                            ->where('is_active', true) // optional
                            ->get();

        // Pass to view as JSON
        return view('student.virtual-map.kcc', [
            'markers' => $markers
        ]);
    }

    public function libungan()
    {
        // Fetch markers where campus_id = 3 and tenant_id = 3 (and optionally active)
        $markers = VirtualMap::where('campus_id', 1)
                            ->where('tenant_id', 2)
                            ->where('is_active', true) // optional
                            ->get();

        // Pass to view as JSON
        return view('student.virtual-map.libungan', [
            'markers' => $markers
        ]);
    }
}
