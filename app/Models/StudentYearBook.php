<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentYearBook extends Model
{
     use HasFactory;

     protected $table = 'student_yearbook';

    protected $fillable = [
        'student_id',
        'motto',
        'awards',
        'hobbies',
        'organizations',
        'trainings',
        'ojt_experience',
        'memorable_experience',
        'career_goal',
        'favorite_quote',
        'facebook',
        'linkedin',
    ];

    protected $casts = [
        'awards' => 'array',
        'hobbies' => 'array',
        'organizations' => 'array',
        'trainings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
