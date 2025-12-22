<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class EvaluationRequest extends Model
{
    protected $table = 'evaluation_requests';

    protected $fillable = [
        'request_id',
        'status',
        'remarks',
        'student_id',
        'evaluated_by'
    ];

     protected static function booted()
    {
        static::created(function ($model) {
            $model->logOperation('created');
        });

        static::updated(function ($model) {
            $model->logOperation('updated');
        });

        static::deleted(function ($model) {
            $model->logOperation('deleted');
        });
    }
    public function logOperation($action)
    {
        OperationLog::create([
            'user_id' => Auth::id(),
            'model' => static::class,
            'action' => $action,
            'data' => $this->toJson()
        ]);
    }

}
