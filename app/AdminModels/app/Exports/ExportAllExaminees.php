<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAllExaminees implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('users as u')
            ->select([
                'r.app_no',
                'r.firstpriorty_desc',
                'r.secondpriority_desc',
                'r.thirdpriorty_desc',
                DB::raw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) AS fullname"),
                'u.phone',
                'u.email',
                'rm.exam_session as batch_number',
                'rm.college_name',
                'rm.room_name',
                'rm.schedule',
                'rm.time',
            ])
            ->leftJoin('reservations as r', 'u.id', '=', 'r.user_id')
            ->join('cee_sessions as ce', 'r.cee_session_id', '=', 'ce.id')
            ->leftJoin('rooms as rm', 'r.room_id', '=', 'rm.id')
            ->where('rm.status', 'active')
            ->where('ce.status', 'active')
            ->orderBy('batch_number', 'asc')  // Order by batch
            ->orderBy('rm.room_name', 'asc')    // Order by room
            ->orderByRaw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) asc")
            ->get();

        // Prepare grouped data with counters that reset
        $groupedData = [];
        $currentBatch = null;
        $currentRoom = null;
        $counter = 1; // Counter for numbering rows

        foreach ($data as $row) {
            if ($currentBatch !== $row->batch_number) {
                // Add a batch header with schedule and time
                $groupedData[] = [
                    'count' => '', // Empty for count
                    'fullname' => '', // Batch header with schedule and time
                    'phone' => '',
                    'email' => '',
                    'batch_number' => '',
                    'firstpriorty_desc' => '',
                    'secondpriority_desc' => '',
                    'thirdpriorty_desc' => '',
                    'college_name' => '',
                    'room_name' => '',
                    'schedule' => '',
                    'time' => '',
                ];
                $groupedData[] = [
                    'count' => '', // Empty for count
                    'fullname' => '', // Batch header with schedule and time
                    'phone' => '',
                    'email' => '',
                    'batch_number' => '',
                    'firstpriorty_desc' => '',
                    'secondpriority_desc' => '',
                    'thirdpriorty_desc' => '',
                    'college_name' => '',
                    'room_name' => '',
                    'schedule' => '',
                    'time' => '',
                ];

                $groupedData[] = [
                    'count' => '', // Empty for count
                    'fullname' => $row->batch_number . ' (' . $row->schedule . ' | ' . $row->time . ')', // Batch header with schedule and time
                    'phone' => '',
                    'email' => '',
                    'batch_number' => '',
                    'firstpriorty_desc' => '',
                    'secondpriority_desc' => '',
                    'thirdpriorty_desc' => '',
                    'college_name' => '',
                    'room_name' => '',
                    'schedule' => '',
                    'time' => '',
                ];

                $currentBatch = $row->batch_number;
                $currentRoom = null; // Reset room grouping for new batch
            }

            if ($currentRoom !== $row->room_name) {
                // Add a room header
                $groupedData[] = [
                    'count' => '', // Empty for count
                    'fullname' => '', // Batch header with schedule and time
                    'phone' => '',
                    'email' => '',
                    'batch_number' => '',
                    'firstpriorty_desc' => '',
                    'secondpriority_desc' => '',
                    'thirdpriorty_desc' => '',
                    'college_name' => '',
                    'room_name' => '',
                    'schedule' => '',
                    'time' => '',
                ];

                $groupedData[] = [
                    'count' => '', // Empty for count
                    'fullname' => $row->room_name, // Room header
                    'batch_number' => '',
                    'firstpriorty_desc' => '',
                    'secondpriority_desc' => '',
                    'thirdpriorty_desc' => '',
                    'phone' => '',
                    'email' => '',
                    'college_name' => '',
                    'room_name' => '',
                    'schedule' => '',
                    'time' => '',
                ];
                $currentRoom = $row->room_name;
                $counter = 1; // Reset counter for each new room
            }

            // Add individual rows
            $groupedData[] = [
                'count' => $counter++, // Increment counter for numbering
                'app_no' => $row->app_no,
                'fullname' => $row->fullname,
                'phone' => $row->phone,
                'email' => $row->email,
                'batch_number' => $row->batch_number,
                'firstpriorty_desc' => $row->firstpriorty_desc,
                'secondpriority_desc' => $row->secondpriority_desc,
                'thirdpriorty_desc' => $row->thirdpriorty_desc,
                'college_name' => $row->college_name,
                'room_name' => $row->room_name,
                'schedule' => $row->schedule,
                'time' => $row->time,
            ];
        }

        return collect($groupedData);
    }

    public function headings(): array
    {
        return [
            '#',
            'App No.',
            'Full Name',
            'Phone',
            'Email',
            'Batch',
            'First Priority',
            'Second Priority',
            'Third Priority',
            'Building',
            'Room Name',
            'Date',
            'Time'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Apply background color and bold font to the header row (row 1)
                $sheet->getStyle('A1:M1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'D9E1F2'], // Light blue background
                    ],
                ]);

                // Auto-size all columns
                foreach (range('A', $sheet->getHighestColumn()) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Apply bold styling only to batch and room headers dynamically
                foreach ($sheet->getRowIterator() as $row) {
                    $rowIndex = $row->getRowIndex();
                    $cellValue = $sheet->getCell('A' . $rowIndex)->getValue();

                    // Bold only batch and room headers
                    if ($cellValue == null) {
                        $sheet->getStyle(cellCoordinate: 'B' . $rowIndex . ':M' . $rowIndex)->applyFromArray([
                            'font' => [
                                'bold' => true,
                            ],
                            'fill' => [
                                'fillType' => 'solid',
                                'color' => ['rgb' => 'F0F0F0'], // Light grey background
                            ],
                        ]);
                    }

                }
            },
        ];
    }

    /**
     * Check if a cell value represents a room header.
     */
    private function isRoomHeader($value)
    {
        // Add logic to determine if it's a room header, e.g., specific room name formats
        return !empty($value) && strlen($value) <= 20; // Adjust conditions for room names
    }
}
