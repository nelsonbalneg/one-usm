<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::user()->id; // Get the logged-in user's ID

        return [
            // Personal Information
            'student_type' => 'required|integer',
            'freshmen_type' => 'required|integer',
          //  'student_no' => 'nullable|string|max:15',  // Removed unique constraint
            'user_id' => 'required|exists:users,id',   // Removed unique constraint
            'campus_id' => 'nullable|integer',
            'prog_id' => 'nullable|integer',
            'major_disc_id' => 'nullable|integer',
            'year_level_id' => 'nullable|integer',
            'app_no' => 'required|string|max:50',
            'term_id' => 'nullable|integer',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:5',
            'ext_name' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:200',
            'civil_status_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'gender' => 'required|string|max:255',
            'nationality_id' => 'required|integer',
            'mobile_no' => 'required|string|max:20',
            'email' => 'required|email|max:50', 
            // 'email' => [
            //     'required',
            //     'email',
            //     'max:50',
            //     Rule::unique('stundent_profiles', 'email')->ignore($userId, 'user_id') // Ignore the current user's email
            // ],
            'health_id' => 'nullable|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_type' => 'required|string|max:3',

            // Parent Details
            'father_birth_date' => 'nullable|date|before:today',
            'mother_birth_date' => 'nullable|date|before:today',
            'father' => 'required|string|max:50',
            'father_occupation' => 'nullable|string|max:50',
            'father_company' => 'nullable|string|max:100',
            'father_company_address' => 'nullable|string|max:200',
            'father_tel_no' => 'nullable|string|max:20',
            'father_email' => 'nullable|email|max:50',
            'mother' => 'required|string|max:50',
            'mother_occupation' => 'nullable|string|max:50',
            'mother_company' => 'nullable|string|max:100',
            'mother_company_address' => 'nullable|string|max:200',
            'mother_tel_no' => 'nullable|string|max:20',
            'mother_email' => 'nullable|email|max:50',

            // Residence Address
            'res_address' => 'nullable|string|max:255',
            'res_street' => 'required|string|max:100',
            'barangay_text-res' => 'required|string|max:100',
            'city_text-res' => 'required|string|max:100',
            'res_zipcode' => 'nullable|integer',
            'province_text-res' => 'required|string|max:100',
            'region_text-res' => 'required|string|max:100',

            // Permanent Address
            'perm_address' => 'nullable|string|max:100',
            'perm_street' => 'required|string|max:100',
            'barangay_text-perm' => 'required|string|max:100',
            'city_text-perm' => 'required|string|max:100',
            'perm_zipcode' => 'required|integer',
            'province_text-perm' => 'required|string|max:60',
            'region_text-perm' => 'required|string|max:60',


            // Guardian Information
            'guardian' => 'required|string|max:100',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_address' => 'nullable|string|max:100',
            'guardian_street' => 'required|string|max:100',

            'barangay_text-guardian' => 'required|string|max:100',
            'city_text-guardian' => 'required|string|max:100',
            'province_text-guardian' => 'required|string|max:100',
            'region_text-guardian' => 'required|string|max:100',

            'guardian_zipcode' => 'nullable|integer',
            'guardian_occupation' => 'required|string|max:100',
            'guardian_company' => 'required|string|max:100',
            'guardian_telno' => 'nullable|string|max:100',
            'guardian_email' => 'nullable|email|max:100',

            // Emergency Contact
            'emergency_contact' => 'required|string|max:100',
            'emergency_address' => 'required|string|max:100',
            'emergency_mobileno' => 'required|string|max:60',
            'emergency_telno' => 'nullable|string|max:60',

            // Educational Background
            'elem_school' => 'required|string|max:100',
            'elem_address' => 'required|string|max:100',
            'elem_incldates' => 'required|string|max:60',
            'hs_school' => 'required|string|max:100',
            'hs_address' => 'required|string|max:100',
            'hs_incldates' => 'required|string|max:60',
            'vocational' => 'nullable|string|max:100',
            'vocational_address' => 'nullable|string|max:100',
            'vocational_degree' => 'nullable|string|max:100',
            'vocational_incldates' => 'nullable|string|max:60',
            'shs_school' => 'required|string|max:100',
            'shs_address' => 'required|string|max:100',
            'shs_incldates' => 'required|string|max:60',

            // College Information
            'college_school' => 'required|string|max:100',
            'college_address' => 'required|string|max:100',
            'college_degree' => 'required|string|max:100',
            'college_incldates' => 'required|string|max:60',
            'student_picture' => 'nullable|file',

            // Status Information
            'inactive' => 'sometimes|boolean',
            'status_id' => 'nullable|integer',
            'admitted_from_gs_to_hs' => 'nullable|string|max:15',
            'status_remarks' => 'nullable|string|max:100',

            // Parent Additional Details
            'father_educ_attain' => 'nullable|string|max:100',
            'mother_educ_attain' => 'nullable|string|max:100',
            'father_income_from' => 'nullable|integer',
            'father_income_to' => 'nullable|integer',
            'mother_income_from' => 'nullable|integer',
            'mother_income_to' => 'nullable|integer',

            // Family Background
            'no_of_brothers' => 'nullable|integer',
            'no_of_sisters' => 'nullable|integer',
            'is_illegitimate_child' => 'sometimes|boolean',
            'is_illegitimate' => 'sometimes|boolean',

            // Academic Awards
            'elem_award_honor' => 'nullable|string|max:100',
            'hs_award_honor' => 'nullable|string|max:100',
            'shs_award_honor' => 'nullable|string|max:100',

            // Social Affiliations
            'ses' => 'nullable|string|max:100',
            'tribe_id' => 'nullable|integer',
            'tribe' => 'nullable|string|max:50',
            'ip_member' => 'sometimes|boolean',
            'ip_member_tribe' => 'nullable|string|max:50',

            // Special Categories
            'pwd_member' => 'sometimes|boolean',
            'pwd_member_id' => 'nullable|string|max:50',
            'pwd_category' => 'nullable|string|max:50',
            'solo_parent' => 'sometimes|boolean',
            'solo_parent_id' => 'nullable|string|max:50',
            'applicant_profile_status' => 'sometimes|boolean',
        ];
    }
}
