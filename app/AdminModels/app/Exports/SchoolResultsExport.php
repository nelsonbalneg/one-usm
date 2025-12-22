<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SchoolResultsExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('users as u')
            ->join('results as r', 'u.id', '=', 'r.user_id')
            ->join('cee_sessions as cs', 'r.cee_session_id', '=', 'cs.id')
            ->select(
                'u.shs_school',
                DB::raw('COUNT(DISTINCT u.id) as total_users_with_results'),
                DB::raw('ROUND(AVG(r.science), 2) as avg_science'),
                DB::raw('ROUND(AVG(r.math), 2) as avg_math'),
                DB::raw('ROUND(AVG(r.humanities), 2) as avg_humanities'),
                DB::raw('ROUND(AVG(r.inductive), 2) as avg_inductive'),
                DB::raw('ROUND(AVG(r.csa), 2) as avg_csa')
            )
            ->where('cs.status', 'active')
            ->groupBy('u.shs_school')
            ->orderByRaw('total_users_with_results DESC')
            ->get();
    }

    public function headings(): array
    {
        return [
            'SHS School',
            'Total Examinees',
            'Average Science',
            'Average Math',
            'Average Humanities',
            'Average Inductive',
            'Average CSA',
        ];
    }

    public function title(): string
    {
        return 'Result Summary Per Subject Area';
    }
}
