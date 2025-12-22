<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersNoReservationExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('users')
            ->leftJoin('reservations', 'users.id', '=', 'reservations.user_id')
            ->join('cee_sessions', 'users.exam_session_id', '=', 'cee_sessions.id')
            ->whereNull('reservations.user_id')
            ->where('cee_sessions.status', 'active')
            ->select(
                DB::raw("ROW_NUMBER() OVER (ORDER BY CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) ASC) AS row_number"),
                  'cee_sessions.id',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                DB::raw("CAST(users.lrn AS NVARCHAR) AS lrn"),
                'users.email',
                'users.phone',
                'users.email',
                'users.created_at',
            )
            ->get();

        return $data;
    }


    public function headings(): array
    {
        return [
            'Row Number',
            'CEE Session ID',
            'Fullname',
            'LRN',
            'Email',
            'Phone',
            'Date Registered'
        ];
    }

    public function registerEvents(): array
    {
        return [
           AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                foreach (range('A', $sheet->getHighestColumn()) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true); // Set columns to autofit
                }
                  // Apply numeric formatting to the LRN column (assuming column D is LRN)
                  $highestRow = $sheet->getHighestRow();
                  $sheet->getStyle('D2:D' . $highestRow)->getNumberFormat()->setFormatCode('0'); // Ensure numeric format
            },
        ];
    }
}
