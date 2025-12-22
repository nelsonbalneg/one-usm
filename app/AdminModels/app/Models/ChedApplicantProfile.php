<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChedApplicantProfile extends Model
{
    use HasFactory;
    protected $table = 'ched_applicant_profiles';

    protected $fillable = [
        'app_no',
        'user_id',

        // PERSONAL INFORMATION
        'student_category',
        'student_category_new_type',
        'student_category_old_type',

        'lrn',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'phone',
        'photo',

        'house_hould_no',
        'region',
        'province',
        'city',
        'brgy',
        'street',
        'zipcode',

        'sex',
        'birthdate',
        'birthplace',
        'civil_status',
        // 'civil_status_others',

        'religion',
        'citizenship',
        'first_generation_student',

        'is_4ps_beneficiary',
        'is_4ps_beneficiary_id',

        'is_solo_parent',
        'is_solo_parent_id',

        'is_raised_by_solo_parent',
        'is_pwd',
        'is_pwd_desc',
        'is_pwd_id',
        'is_gida',
        'is_gida_desc',
        'is_ip',
        'is_ip_type',
        'is_belong_to_farmer',
        'is_rebel_returnee',

        // Family Background - Father
        'father_name',
        'father_age',
        'father_citizenship',
        'father_highest_educational_attainment',
        // 'father_highest_educational_attainment_others',
        'father_employment_status',
        'father_occupation',


        // Family Background - Mother
        'mother_name',
        'mother_age',
        'mother_citizenship',
        'mother_highest_educational_attainment',
        // 'mother_highest_educational_attainment_others',
        'mother_employment_status',
        'mother_occupation',
        'family_size',
        'monthly_income',

        // Educational background
        'type_of_school',
        'school_name',
        'last_school_year_attended',

        'shs_track',
        'shs_school_year',
        'shs_school',

        'is_adm',
        'adm_school',
        'adm_school_year',

        'is_als',
        'als_school',
        'als_school_year',

        'i_agree',
        'status',
        'cee_term'
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
