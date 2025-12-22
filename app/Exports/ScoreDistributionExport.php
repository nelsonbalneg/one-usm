<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
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

class ScoreDistributionExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithEvents
{
    protected $categories;
    protected $series;

    public function __construct()
    {
        $terms = Result::distinct()->pluck('cee_session_id')->toArray();

        $ceeSessions = DB::table('cee_sessions')
            ->whereIn('id', $terms)
            ->pluck('name', 'id')
            ->toArray();

        $scoreRanges = [];
        $scoreRangeIndexMap = [];
        for ($i = 0, $index = 0; $i <= 100; $i += 5, $index++) {
            $upper = min($i + 4, 100);
            $label = "{$i}-{$upper}";
            $scoreRanges[] = $label;
            $scoreRangeIndexMap[$i] = $index;
        }

        $allDataPerRange = array_fill(0, count($scoreRanges), 0);
        $series = [];

        foreach ($ceeSessions as $id => $name) {
            $distribution = Result::where('cee_session_id', $id)
                ->select(DB::raw('FLOOR(csa / 5) * 5 as score_range'), DB::raw('COUNT(*) as count'))
                ->groupBy(DB::raw('FLOOR(csa / 5) * 5'))
                ->pluck('count', 'score_range')
                ->toArray();

            $data = array_fill(0, count($scoreRanges), 0);
            foreach ($distribution as $range => $count) {
                if (isset($scoreRangeIndexMap[$range])) {
                    $index = $scoreRangeIndexMap[$range];
                    $data[$index] = $count;
                    $allDataPerRange[$index] += $count;
                }
            }

            $series[] = [
                'name' => $name,
                'data' => $data
            ];
        }

        // Filter unused score bins
        $filteredCategories = [];
        foreach ($scoreRanges as $index => $label) {
            if ($allDataPerRange[$index] > 0) {
                $filteredCategories[] = $label;
            }
        }

        $filteredSeries = [];
        foreach ($series as $s) {
            $filteredData = [];
            foreach ($scoreRanges as $index => $_) {
                if ($allDataPerRange[$index] > 0) {
                    $filteredData[] = $s['data'][$index];
                }
            }
            $filteredSeries[] = [
                'name' => $s['name'],
                'data' => $filteredData
            ];
        }

        $this->categories = $filteredCategories;
        $this->series = $filteredSeries;
    }

    public function title(): string
    {
        return 'CSA Score Distribution';
    }

    public function headings(): array
    {
        $headings = ['Score Range'];
        foreach ($this->series as $s) {
            $headings[] = $s['name'];
        }
        return $headings;
    }

    public function array(): array
    {
        $rows = [];
        foreach ($this->categories as $i => $label) {
            $row = [$label];
            foreach ($this->series as $s) {
                $row[] = $s['data'][$i];
            }
            $rows[] = $row;
        }
        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                $rowCount = count($this->categories) + 1;
                $colCount = count($this->series);

                // Setup axis labels and data
                $dataSeriesLabels = [];
                $dataSeriesValues = [];
                $xAxisTickValues = [
                    new DataSeriesValues('String', "'{$this->title()}'!A2:A{$rowCount}", null, $rowCount - 1),
                ];

                foreach (range(0, $colCount - 1) as $i) {
                    $colLetter = chr(66 + $i); // B, C, D, ...
                    $dataSeriesLabels[] = new DataSeriesValues('String', "'{$this->title()}'!\${$colLetter}\$1", null, 1);
                    $dataSeriesValues[] = new DataSeriesValues('Number', "'{$this->title()}'!\${$colLetter}\$2:\${$colLetter}\${$rowCount}", null, $rowCount - 1);
                }

                // Build chart
                $series = new DataSeries(
                    DataSeries::TYPE_BARCHART,
                    DataSeries::GROUPING_CLUSTERED,
                    range(0, $colCount - 1),
                    $dataSeriesLabels,
                    $xAxisTickValues,
                    $dataSeriesValues
                );
                $series->setPlotDirection(DataSeries::DIRECTION_COL);

                $plotArea = new PlotArea(null, [$series]);
                $legend = new Legend(Legend::POSITION_RIGHT, null, false);
                $title = new Title('CSA Score Distribution per CEE Session');

                $chart = new Chart(
                    'CSA_Score_Chart',
                    $title,
                    $legend,
                    $plotArea,
                    true,
                    0,
                    null,
                    null
                );

                // Position the chart (E2 is a good default)
                $chart->setTopLeftPosition('E2');
                $chart->setBottomRightPosition('N25');

                // Add chart to sheet
                $sheet->addChart($chart);
            },
        ];
    }
}
