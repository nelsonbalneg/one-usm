<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookletNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cee_term_id', // Make sure this matches your database column
        'app_no',
        'bookletNo',
        'envelopeNo',
        'revision_no',
        'added_by'
    ];


    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ceesession()
    {
        return $this->belongsTo(CeeSession::class, 'cee_term_id');
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
