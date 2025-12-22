<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CEEExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new SessionPassFailExport(),
            new PassingRateExport(),
            new SchoolResultsExport(),
            new TopExamineesExport(),
            new ScoreDistributionExport(),

        ];
    }
}
