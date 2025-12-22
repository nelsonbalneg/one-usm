<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class SiteSetting extends Model
{
    protected $fillable = [
        'utdc_head',
        'aro_head',
        'di_head',
        'vpaa',
        'footer_one',
        'footer_two',
        'endreservation',
        'openreservation',
        'status',
        'is_maintenance',
        'site_name',
        'endregistration',
        'start_prereg_second_batch',
        'end_prereg_second_batch',
        'start_enrollment',
        'end_enrollment',
        'enrollment_announcement',
        'enrollment_hy_reg_status',
        'enrollment_hy_ireg_status',
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
