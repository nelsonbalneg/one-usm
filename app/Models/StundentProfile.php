<?php

namespace App\Models;

use App\Models\OperationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StundentProfile extends Model
{
    use HasFactory;

    protected $table = 'stundent_profiles';

    protected $fillable = [
        'student_type',
        'freshmen_type',
        'student_no',
        'user_id',
        'campus_id',
        'prog_id',
        'major_disc_id',
        'year_level_id',
        'app_no',
        'last_name',
        'middle_name',
        'first_name',
        'middle_initial',
        'ext_name',
        'date_of_birth',
        'place_of_birth',
        'civil_status_id',
        'religion_id',
        'gender',
        'nationality_id',
        'mobile_no',
        'email',
        'health_id',
        'height',
        'weight',
        'blood_type',
        'pwd_member',
        'pwd_member_id',
        'pwd_category',
        'solo_parent',
        'solo_parent_id',
        'ses',
        'tribe_id',
        'tribe',
        'ip_member',
        'ip_member_tribe',
        'father',
        'father_occupation',
        'father_company',
        'father_company_address',
        'father_tel_no',
        'father_email',
        'mother',
        'mother_occupation',
        'mother_company',
        'mother_company_address',
        'mother_tel_no',
        'mother_email',
        'father_birth_date',
        'mother_birth_date',
        'father_educ_attain',
        'mother_educ_attain',
        'father_income_from',
        'father_income_to',
        'mother_income_from',
        'mother_income_to',
        'guardian',
        'guardian_relationship',
        'guardian_address',
        'guardian_street',
        'guardian_barangay',
        'guardian_towncity',
        'guardian_province',
        'guardian_region',
        'guardian_zipcode',
        'guardian_occupation',
        'guardian_company',
        'guardian_telno',
        'guardian_email',
        'res_address',
        'res_street',
        'res_barangay',
        'res_towncity',
        'res_zipcode',
        'res_province',
        'res_region',
        'perm_address',
        'perm_street',
        'perm_barangay',
        'perm_towncity',
        'perm_zipcode',
        'perm_province',
        'perm_region',
        'emergency_contact',
        'emergency_address',
        'emergency_mobileno',
        'emergency_telno',
        'elem_school',
        'elem_address',
        'elem_incldates',
        'hs_school',
        'hs_address',
        'hs_incldates',
        'vocational',
        'vocational_address',
        'vocational_degree',
        'vocational_incldates',
        'shs_school',
        'shs_address',
        'shs_incldates',
        'college_school',
        'college_address',
        'college_degree',
        'college_incldates',
        'student_picture',
        'inactive',
        'status_id',
        'admitted_from_gs_to_hs',
        'status_remarks',
        'no_of_brothers',
        'no_of_sisters',
        'is_illegitimate_child',
        'is_illegitimate',
        'elem_award_honor',
        'hs_award_honor',
        'shs_award_honor',
        'applicant_profile_status',
        'prereg_status',
        'policyId',
        'current_step',
        'realCampusId',
        'collegeId',
        'termId',
        'campusName',
        'collegeName',
        'programName',
        'term',
        'majorDiscDesc',
        'programCode',
        'remarks',
        'date_confirmed',
        'date_enrolled',
        'date_denied',
        'date_cancelled',
        'nstp',
        'reg_no',
        'prereg_term_id',
        'added_by',
        'confirmation_batch',
        'date_program_selected',
        'nstp',
        'is_answered_nstp',
        'trial_program_id',
        'is_school_id_created'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function requirement()
    {
        return $this->hasOne(StudentRequirement::class, 'student_id', 'id');
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
