<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PassingRateExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        return DB::table('results as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->select(
                'u.shs_school as school',
                DB::raw('COUNT(r.user_id) as total_examinees'),
                DB::raw('SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) as total_passed'),
                DB::raw('SUM(CASE WHEN r.csa < 25 THEN 1 ELSE 0 END) as total_failed'),
                DB::raw('CAST(100.0 * SUM(CASE WHEN r.csa > 25 THEN 1 ELSE 0 END) / COUNT(r.user_id) AS DECIMAL(5,2)) as passing_rate_percent')
            )
            ->groupBy('u.shs_school')
            ->orderByDesc('total_examinees')
            ->get();
    }

    public function headings(): array
    {
        return [
            'SHS School',
            'Total Examinees',
            'Total Passed',
            'Total Failed',
            'Passing Rate (%)',
        ];
    }

    public function title(): string
    {
        return 'Passing Rate per School';
    }
}
