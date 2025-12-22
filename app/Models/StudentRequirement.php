<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_type',
        'student_id',
        'goodmoral',
        'card',
        'psa',
        'hdismissal',
        'certificatetransfer',
        'transcript',
        'affidavit',
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

    public function student()
    {
        return $this->belongsTo(StundentProfile::class, 'student_id');
    }
}
