<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicantByActiveCeeTermExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('users as u')
            ->select([
                'u.id',
                'ce.name',
                'r.app_no',
                DB::raw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) AS fullname"),
                'u.region',
                'u.province',
                'u.city',
                'u.phone',
                'u.email',
                DB::raw("CASE
                WHEN r.campus_id = 1 THEN 'USM-Main'
                WHEN r.campus_id = 3 THEN 'USM KCC'
                WHEN r.campus_id = 5 THEN 'USM PALMA CLUSTER'
                WHEN r.campus_id = 6 THEN 'USM MLANG'
                WHEN r.campus_id = 7 THEN 'USM Antipas'
                WHEN r.campus_id = 8 THEN 'USM Pigcawayan'
                ELSE 'Unknown'
            END AS campus_name"),
                'r.firstpriorty_desc',
                'r.secondpriority_desc',
                'r.thirdpriorty_desc',
            ])
            ->leftJoin('reservations as r', 'u.id', '=', 'r.user_id')
            ->join('cee_sessions as ce', 'r.cee_session_id', '=', 'ce.id')
            ->where('ce.status', 'active')
            ->orderBy('fullname', 'asc')
            ->get();

        // Add row numbers
        $data = $data->map(function ($item, $key) {
            return [
                '#' => $key + 1, // Start numbering from 1
                'ID' => $item->id,
                'CEE Term' => $item->name,
                'App No' => $item->app_no,
                'Full Name' => $item->fullname,
                'Region' => $item->region,
                'Province' => $item->province,
                'City/Municipality' => $item->city,
                'Phone' => $item->phone,
                'Email' => $item->email,
                'Campus (First Priority)' => $item->campus_name,
                'First Priority' => $item->firstpriorty_desc,
                'Second Priority' => $item->secondpriority_desc,
                'Third Priority' => $item->thirdpriorty_desc,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'ID',
            'CEE Term',
            'App No',
            'Full Name',
            'Region',
            'Province',
            'City/Municipality',
            'Phone',
            'Email',
            'Campus (First Priority)',
            'First Priority',
            'Second Priority',
            'Third Priority',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Lock columns A to D (cee_session_id, user_id, app_no, fullname)
                $sheet = $event->sheet->getDelegate();

                // AutoSize all columns
                foreach (range('A', $sheet->getHighestColumn()) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Apply bold font to the header row
                $sheet->getStyle('1:1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
