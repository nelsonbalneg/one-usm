<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class NoRequirementsApplicantsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $results = DB::table('stundent_profiles as sp')
            ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
            ->where(function ($q) {
                $q->where('sp.status_id', 0)
                    ->orWhere('sp.status_id', 1)
                    ->orWhereNull('sp.status_id');
            })
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('sp.student_type', 1)
                        ->where(function ($s) {
                            $s->where(function ($x) {
                                $x->where('sr.goodmoral', 0)->orWhereNull('sr.goodmoral');
                            })->where(function ($x) {
                                $x->where('sr.psa', 0)->orWhereNull('sr.psa');
                            })->where(function ($x) {
                                $x->where('sr.card', 0)->orWhereNull('sr.card');
                            })->where(function ($x) {
                                $x->where('sr.affidavit', 0)->orWhereNull('sr.affidavit');
                            });
                        });
                })->orWhere(function ($sub) {
                    $sub->where('sp.student_type', 2)
                        ->where(function ($s) {
                            $s->where(function ($x) {
                                $x->where('sr.goodmoral', 0)->orWhereNull('sr.goodmoral');
                            })->where(function ($x) {
                                $x->where('sr.hdismissal', 0)->orWhereNull('sr.hdismissal');
                            })->where(function ($x) {
                                $x->where('sr.certificatetransfer', 0)->orWhereNull('sr.certificatetransfer');
                            })->where(function ($x) {
                                $x->where('sr.psa', 0)->orWhereNull('sr.psa');
                            })->where(function ($x) {
                                $x->where('sr.transcript', 0)->orWhereNull('sr.transcript');
                            })->where(function ($x) {
                                $x->where('sr.affidavit', 0)->orWhereNull('sr.affidavit');
                            });
                        });
                });
            })
             ->where('sp.prereg_status',  'pending')
            ->where('sp.campus_id', '!=', null)
            ->select(
                DB::raw("CONCAT(sp.last_name, ', ', sp.first_name, ' ', ISNULL(sp.middle_name, ''), ' ', ISNULL(sp.ext_name, '')) AS full_name"),
                'sp.email',
                'sp.mobile_no',
                'sp.programName',
                'sp.majorDiscDesc',
                'sp.collegeName',
                'sp.campusName',
                'sp.prereg_status'
            )
            ->orderByRaw("sp.last_name, sp.first_name, ISNULL(sp.middle_name, ''), ISNULL(sp.ext_name, '')")
            ->get();


        // Add row numbers and length column
        return $results->values()->map(function ($item, $index) {
            return [
                'No.' => $index + 1,
                'Full Name' => $item->full_name,
                'Email' => $item->email,
                'Mobile No.' => $item->mobile_no,
                'Campus' => $item->campusName,
                'College' => $item->collegeName,
                'Program' => $item->programName,
                'Major' => $item->majorDiscDesc,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No.',
            'Full Name',
            'Email',
            'Mobile No.',
            'College',
            'Campus',
            'Program',
            'Major',
        ];
    }
}
