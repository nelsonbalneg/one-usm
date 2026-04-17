<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationRequest extends Model
{
    protected $table = 'portal.evaluation_requests';
    protected $fillable = [
        'request_id',
        'student_id',
        'status',
        'remarks'
    ];
}
