<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersAssignedAcademicStatus extends Model
{
   use HasFactory;

    protected $table = 'users_assigned_academic_statuses';

    protected $fillable = [
        'user_id',
        'status',
    ];

    // Optional: Define relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
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
