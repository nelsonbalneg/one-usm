<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationconfirmedExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('reservations')
            ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                'reservations.cee_session_id',
                'reservations.user_id',
                'reservations.app_no',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname")
            )
            ->where('cee_sessions.status', 'active')
            ->where('reservations.status', '=', 'confirmed')
            ->orderBy('fullname', 'asc')
            ->get();

        return $data;

    }

    public function headings(): array
    {
        return [
            'cee_session_id',
            'user_id',
            'app_no',
            'fullname',
            'science',
            'math',
            'humanities',
            'inductive',
            // 'abstract',
            'csa',
            'status'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Lock columns A to D (cee_session_id, user_id, app_no, fullname)
                $sheet = $event->sheet->getDelegate();

                // Protect the sheet
                $sheet->getProtection()->setSheet(true);
                $sheet->getProtection()->setPassword('#usmcee2024#'); // Set a password for protection

                // Lock specific columns
                $sheet->getStyle('A:D')->getProtection()->setLocked(true); // Lock columns A to D

                // Unlock other columns (E to H, for example)
                $sheet->getStyle('E:L')->getProtection()->setLocked(false);

                // Lock the header row (Row 1)
                $sheet->getStyle('1:1')->getProtection()->setLocked(true);

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

                // Dynamically set 'status' column to 'posted' for all rows
                $highestRow = $sheet->getHighestRow(); // Get the last row number
                for ($row = 2; $row <= $highestRow; $row++) {
                    $sheet->setCellValue("J{$row}", 'posted'); // Assuming 'status' is in column L
                }

                // Format column L (from row 2 onward) as a date
                $sheet->getStyle('K2:K' . $highestRow)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            },
        ];
    }
}
