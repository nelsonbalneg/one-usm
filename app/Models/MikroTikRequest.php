<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikroTikRequest extends Model
{
    use HasFactory;

    protected $table = 'mikrotik_requests';


    protected $fillable = [
        'student_no',
        'password',
        'semester',   // store active semester here
    ];
}
