<?php

namespace App\Imports;

use App\Models\Result;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCeeResult implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Result([
            'cee_session_id' => $row['cee_session_id'],
            'user_id' => $row['user_id'],
            'app_no' => $row['app_no'],
            'fullname' => $row['fullname'],
            'science' => $row['science'],
            'math' => $row['math'],
            'english' => $row['english'],
            'verbal' => $row['verbal'],
            'abstract' => $row['abstract'],
            'csa' => $row['csa'],
            'status' => $row['status'],
            'created_at' => isset($row['created_at']) ? Carbon::parse($row['created_at']) : now(),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.0' => 'required',  // cee_exam_session
            '*.1' => 'required',  // user_id
            '*.2' => 'required',  // app_no
            '*.3' => 'required',  // fullname
            '*.4' => 'required|numeric',  // science
            '*.5' => 'required|numeric',  // math
            '*.6' => 'required|numeric',  // english
            '*.7' => 'required|numeric',  // verbal
            '*.8' => 'required|numeric',  // abstract
            '*.9' => 'required|numeric',  // csa
            '*.10' => 'required|string',  // status
            '*.11' => 'nullable|date',  // created_at
        ];
    }
}
