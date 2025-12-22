<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class PortalUser extends Model
{
    protected $table = 'portal_users';

    protected $fillable = [
        'student_id',
        'birthdate',
        'email',
        'isemailverified',
        'email_verified_at',
        'photo',
        'role',
        'status',
        'remarks',
        'password',
        'firstname',
        'lastname',
        'last_seen',
        'middlename',
        'suffix',
        'gender',
        'campus_id',
        'tenant_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'birthdate',
        'email_verified_at',
        'last_seen',
        'created_at',
        'updated_at',
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
