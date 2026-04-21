<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $table = 'clearances';

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

    public function clearedByUser()
    {
        return $this->belongsTo(UserAccount::class, 'cleared_by', 'id');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(UserAccount::class, 'updated_by', 'id');
    }
}
