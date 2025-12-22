<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $fillable = [
        'user_id',
        'model',
        'action',
        'data',
    ];
}
