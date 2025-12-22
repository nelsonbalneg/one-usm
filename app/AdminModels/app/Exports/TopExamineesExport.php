<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TopExamineesExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        return DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.fullname', 'users.shs_school', 'results.csa')
            ->orderByDesc('results.csa')
            ->limit(value: 100)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fullname',
            'SHS School',
            'CSA Score',
        ];
    }

    public function title(): string
    {
        return 'Top 100 Examinees';
    }
}
