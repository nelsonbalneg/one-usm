<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ReservationsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $databyCeeSession = DB::table('reservations')
        ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
        ->select('reservations.firstpriorty', 'reservations.firstpriorty_desc',  DB::raw('count(reservations.id) as total'))
        ->where('cee_sessions.status','=','active')
        ->groupBy('reservations.firstpriorty', 'reservations.firstpriorty_desc')
        ->orderBy('total', 'desc')
        ->get();

        return $databyCeeSession;
    }

    /**
    * Define the column headings for Excel
    *
    * @return array
    */
    public function headings(): array
    {
        return [
            'Program Name',
            'Program Description',
            'Count'
        ];
    }
}
