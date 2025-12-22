<?php

namespace App\Http\Controllers\Aro;


use App\Models\SiteSetting;
use App\Models\StundentProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class ARODashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //count the number of preregistrations pending
        $prereg_pending = StundentProfile::where('prereg_status', 'pending')->count();
        $prereg_for_ranking = StundentProfile::where('prereg_status', 'for_ranking')
            ->whereNotNull('campus_id')
            ->whereNotNull('prog_id')->count();

        $total_pend_for_ranking = $prereg_pending + $prereg_for_ranking;

        $site_settings = SiteSetting::select(
            'start_prereg_second_batch',
            'end_prereg_second_batch'
        )->first();

        $prereg_step_6 = StundentProfile::where('prereg_status', 'enrolled')->count();

        return view('aro.dashboard', compact(
            'prereg_pending',
            'prereg_for_ranking',
            'prereg_step_6',
            'site_settings',
            'total_pend_for_ranking'
        ));
    }
}
