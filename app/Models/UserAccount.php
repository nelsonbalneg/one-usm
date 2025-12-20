<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'suffix',
        'birthdate',
        'sex',
        'phone',
        'email',
        'isemailverified',
        'email_verified_at',
        'region',
        'province',
        'city',
        'brgy',
        'street',
        'zipcode',
        'track',
        'shs_school',
        'school_address',
        'yeargraduated',
        'photo',
        'role',
        'status',
        'remarks',
        'password',
        'remember_token',
        'lrn',
        'schoolid',
        'applicant_type',
        'is_jhs_grad',
        'last_seen',
        'exam_session_id',
        'is_allowed_to_rank',
        'employee_id',
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation: clearances cleared by this user
    public function clearedClearances()
    {
        return $this->hasMany(Clearance::class, 'cleared_by');
    }

    // Relation: clearances updated by this user
    public function updatedClearances()
    {
        return $this->hasMany(Clearance::class, 'updated_by');
    }
}
