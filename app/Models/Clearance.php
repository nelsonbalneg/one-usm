<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $fillable = [
        'student_id',
        'lastname',
        'firstname',
        'middlename',
        'suffix',
        'status',
        'description',
        'remarks',
        'cleared_by',
        'updated_by',
        'updated_date_time',
        'settled_date',
        'school_year',
        'semester',
        'office_name',
        'office_id',
        'semester_id'
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
