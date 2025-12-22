<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'cee_session_id',
        'app_no',
        'fullname',
        'science',
        'math',
        'humanities',
        'inductive',
        'abstract',
        'csa',
        'status',
        'created_at',
        'user_id',
        'added_by_id'
    ];

    public function ceesession()
    {
        return $this->belongsTo(CeeSession::class, 'cee_session_id');
    }

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
