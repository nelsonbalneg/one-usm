<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requirement extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'requirements';

    // Allow mass assignment for the following fields
    protected $fillable = [
        'user_id',
        'psa',
        'tor',
        'shs_card',
        'enrolment_certification',
        'good_moral_char',
        'honorable_dismisal',
        'req_status',
        'hepa_b_test',
        'chest_x_ray',
        'preg_test',
        'signature',
        'photo',
        'additional_req_status',
        'unpost_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studentProfile()
    {
        return $this->belongsTo(StundentProfile::class, 'user_id', 'id');
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
