<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SessionPassFailExport implements FromArray, WithTitle, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $rows = [];

    public function __construct()
    {
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        $this->rows[] = []; // will be filled in `array()`

        foreach ($ceeSessions as $id => $name) {
            $passed = Result::where('cee_session_id', $id)
                ->where('csa', '>=', 25)
                ->count();

            $failed = Result::where('cee_session_id', $id)
                ->where('csa', '<', 25)
                ->count();

            $this->rows[] = [$name, $passed, $failed];
        }
    }

    public function title(): string
    {
        return 'CEE Session Pass/Fail Summary';
    }

    public function headings(): array
    {
        return ['CEE Session', 'Passed (≥ 25)', 'Failed (< 25)'];
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                $rowCount = count($this->rows);
                $dataSeriesLabels = [
                    new DataSeriesValues('String', "'{$this->title()}'!\$B\$1", null, 1),
                    new DataSeriesValues('String', "'{$this->title()}'!\$C\$1", null, 1),
                ];
                $xAxisTickValues = [
                    new DataSeriesValues('String', "'{$this->title()}'!\$A\$2:\$A\${$rowCount}", null, $rowCount - 1),
                ];
                $dataSeriesValues = [
                    new DataSeriesValues('Number', "'{$this->title()}'!\$B\$2:\$B\${$rowCount}", null, $rowCount - 1),
                    new DataSeriesValues('Number', "'{$this->title()}'!\$C\$2:\$C\${$rowCount}", null, $rowCount - 1),
                ];

                $series = new DataSeries(
                    DataSeries::TYPE_BARCHART,
                    DataSeries::GROUPING_CLUSTERED,
                    range(0, count($dataSeriesValues) - 1),
                    $dataSeriesLabels,
                    $xAxisTickValues,
                    $dataSeriesValues
                );
                $series->setPlotDirection(DataSeries::DIRECTION_COL);

                $plotArea = new PlotArea(null, [$series]);
                $legend = new Legend(Legend::POSITION_RIGHT, null, false);
                $title = new Title('Pass vs. Fail per CEE Session');

                $chart = new Chart(
                    'PassFailChart',
                    $title,
                    $legend,
                    $plotArea,
                    true,
                    0,
                    null,
                    null
                );

                $chart->setTopLeftPosition('E2');
                $chart->setBottomRightPosition('M20');

                $sheet->addChart($chart);
            },
        ];
    }
}
